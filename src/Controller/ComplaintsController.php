<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class ComplaintsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Require login
        $redirect = $this->requireAuth();
        if ($redirect) {
            return $redirect;
        }
    }
    
    public function add()
{
    $complaint = $this->Complaints->newEmptyEntity();
    
    if ($this->request->is('post')) {
        $data = $this->request->getData();
        
        // Get current student
        $userId = $this->request->getSession()->read('Auth.user_id');
        $StudentTable = TableRegistry::getTableLocator()->get('Student');
        $student = $StudentTable->find()
            ->where(['user_id' => $userId])
            ->first();
        
        if (!$student) {
            $this->Flash->error('Student record not found. Please contact admin.');
            return $this->redirect(['controller' => 'Student', 'action' => 'dashboard']);
        }
        
        // Set student_id and submission date
        $data['student_id'] = $student->student_id;
        $data['submission_date'] = date('Y-m-d');
        $data['status'] = 'Pending';
        
        // Handle confidential checkbox
        $data['is_confidential'] = isset($data['is_confidential']) ? 1 : 0;
        
        $complaint = $this->Complaints->patchEntity($complaint, $data);
        
        if ($this->Complaints->save($complaint)) {
            \App\Utility\EmailHelper::sendComplaintNotification(
                'new_complaint',
                $complaint,
                $student->email_address,
                $student->full_name
            );
    
        // Handle file uploads
        $files = $this->request->getData('attachments');
                // Handle file uploads
                $files = $this->request->getData('attachments');
            
            if (!empty($files)) {
                $AttachmentsTable = TableRegistry::getTableLocator()->get('Attachments');
                
                foreach ($files as $file) {
                    if ($file->getError() === UPLOAD_ERR_OK) {
                        $filename = $file->getClientFilename();
                        $filesize = $file->getSize();
                        
                        // Check file size (5MB max)
                        if ($filesize > 5242880) {
                            $this->Flash->error("File {$filename} is too large. Max 5MB.");
                            continue;
                        }
                        
                        // Generate unique filename
                        $extension = pathinfo($filename, PATHINFO_EXTENSION);
                        $uniqueFilename = uniqid() . '_' . time() . '.' . $extension;
                        
                        // Upload directory
                        $uploadPath = WWW_ROOT . 'uploads' . DS . 'complaints' . DS;
                        
                        // Create directory if not exists
                        if (!file_exists($uploadPath)) {
                            mkdir($uploadPath, 0777, true);
                        }
                        
                        // Move uploaded file
                        $destination = $uploadPath . $uniqueFilename;
                        $file->moveTo($destination);
                        
                        // Save to database
                        $attachment = $AttachmentsTable->newEmptyEntity();
                        $attachment->complaint_id = $complaint->complaint_id;
                        $attachment->file_name = $filename;
                        $attachment->file_path = 'uploads/complaints/' . $uniqueFilename;
                        $attachment->file_type = $extension;
                        
                        $AttachmentsTable->save($attachment);
                    }
                }
            }
            
            $this->Flash->success('Your complaint has been submitted successfully. A confirmation email has been sent to ' . $student->email_address);
            return $this->redirect(['controller' => 'Student', 'action' => 'dashboard']);
        }
        
        $this->Flash->error('Unable to submit your complaint. Please try again.');
    }
    
    // Get dropdown options
    $complaintTypes = $this->Complaints->ComplaintTypes->find('list', [
        'keyField' => 'type_id',
        'valueField' => 'type_name'
    ])->toArray();
    
    $complaintCategories = $this->Complaints->ComplaintCategories->find('list', [
        'keyField' => 'category_id',
        'valueField' => 'category_name'
    ])->toArray();
    
    $this->set(compact('complaint', 'complaintTypes', 'complaintCategories'));
}
    
    public function index()
{
    // Get current user
    $userId = $this->request->getSession()->read('Auth.user_id');
    
    // Get student info
    $StudentTable = TableRegistry::getTableLocator()->get('Student');
    $student = $StudentTable->find()
        ->where(['user_id' => $userId])
        ->first();
    
    if (!$student) {
        $this->Flash->error('Student record not found.');
        return $this->redirect(['controller' => 'Student', 'action' => 'dashboard']);
    }
    
    // Get ALL complaints for this student
    $allComplaints = $this->Complaints->find()
        ->contain(['ComplaintTypes', 'ComplaintCategories'])
        ->where(['Complaints.student_id' => $student->student_id])
        ->order(['Complaints.created_at' => 'DESC'])
        ->all();
    
    // Search functionality - PHP filtering
    $search = $this->request->getQuery('search');
    if (!empty($search)) {
        $filtered = [];
        $searchLower = strtolower($search);
        
        foreach ($allComplaints as $complaint) {
            // Get all searchable fields
            $type = strtolower($complaint->complaint_type->type_name ?? '');
            $category = strtolower($complaint->complaint_category->category_name ?? '');
            $description = strtolower($complaint->description ?? '');
            $status = strtolower($complaint->status ?? '');
            $id = (string)$complaint->complaint_id;
            
            // Check if search term matches any field
            if (
                strpos($type, $searchLower) !== false ||
                strpos($category, $searchLower) !== false ||
                strpos($description, $searchLower) !== false ||
                strpos($status, $searchLower) !== false ||
                strpos($id, $searchLower) !== false
            ) {
                $filtered[] = $complaint;
            }
        }
        $complaints = $filtered;
    } else {
        $complaints = $allComplaints->toArray();
    }
    
    $this->set(compact('complaints', 'student', 'search'));
}
    
   public function view($id = null)
{
    $complaint = $this->Complaints->get($id, [
        'contain' => ['Student', 'ComplaintTypes', 'ComplaintCategories']
    ]);
    
    // Get current user type
    $userType = $this->request->getSession()->read('Auth.user_type');
    $userId = $this->request->getSession()->read('Auth.user_id');
    
    // Check access based on user type
    if ($userType == 'Student') {
        // Students can only view their own complaints
        $StudentTable = TableRegistry::getTableLocator()->get('Student');
        $student = $StudentTable->find()
            ->where(['user_id' => $userId])
            ->first();
        
        if ($student && $complaint->student_id != $student->student_id) {
            $this->Flash->error('You can only view your own complaints.');
            return $this->redirect(['controller' => 'Student', 'action' => 'dashboard']);
        }
    } 
    elseif ($userType == 'Staff') {
        // Staff can view complaints in their category
        $StaffTable = TableRegistry::getTableLocator()->get('Staff');
        $staff = $StaffTable->find()
            ->where(['user_id' => $userId])
            ->first();
        
        if ($staff && $complaint->category_id != $staff->categories) {
            $this->Flash->error('You can only view complaints in your category.');
            return $this->redirect(['controller' => 'Staff', 'action' => 'dashboard']);
        }
    }
    // Admin can view all (no restriction)
    
    $this->set(compact('complaint'));
}

public function exportPdf($id = null)
{
    // Get complaint with all relations
    $complaint = $this->Complaints->get($id, [
        'contain' => ['Student', 'ComplaintTypes', 'ComplaintCategories']
    ]);
    
    // Get attachments
    $AttachmentsTable = TableRegistry::getTableLocator()->get('Attachments');
    $attachments = $AttachmentsTable->find()
        ->where(['complaint_id' => $id])
        ->all();
    
    // Get feedback
    $FeedbackTable = TableRegistry::getTableLocator()->get('Feedback');
    $feedbacks = $FeedbackTable->find()
        ->contain(['Staff'])
        ->where(['complaint_id' => $id])
        ->order(['created_at' => 'DESC'])
        ->all();
    
    // Create PDF
    $pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8');
    
    // Set document information
    $pdf->SetCreator('UPSI Complaint System');
    $pdf->SetAuthor('UPSI');
    $pdf->SetTitle('Complaint #' . $complaint->complaint_id);
    
    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // Add a page
    $pdf->AddPage();
    
    // Set font
    $pdf->SetFont('helvetica', '', 10);
    
    // Title
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->SetTextColor(4, 120, 87); // Emerald green
    $pdf->Cell(0, 10, 'UPSI Complaint System', 0, 1, 'C');
    
    $pdf->SetFont('helvetica', '', 12);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 8, 'Complaint Report', 0, 1, 'C');
    $pdf->Ln(5);
    
    // Complaint Details
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->SetFillColor(4, 120, 87);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 10, 'Complaint Details', 0, 1, 'L', true);
    $pdf->Ln(2);
    
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    
    // Details table
    $html = '<table border="0" cellpadding="5">
        <tr>
            <td width="30%"><strong>Complaint ID:</strong></td>
            <td width="70%">#' . $complaint->complaint_id . '</td>
        </tr>
        <tr>
            <td><strong>Type:</strong></td>
            <td>' . h($complaint->complaint_type->type_name ?? 'N/A') . '</td>
        </tr>
        <tr>
            <td><strong>Category:</strong></td>
            <td>' . h($complaint->complaint_category->category_name ?? 'N/A') . '</td>
        </tr>
        <tr>
            <td><strong>Submission Date:</strong></td>
            <td>' . ($complaint->submission_date ? $complaint->submission_date->format('d M Y') : 'N/A') . '</td>
        </tr>
        <tr>
            <td><strong>Status:</strong></td>
            <td>' . h($complaint->status) . '</td>
        </tr>
        <tr>
            <td><strong>Confidential:</strong></td>
            <td>' . ($complaint->is_confidential ? 'Yes' : 'No') . '</td>
        </tr>
    </table>';
    
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5);
    
    // Student Information
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->SetFillColor(4, 120, 87);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 10, 'Submitted By', 0, 1, 'L', true);
    $pdf->Ln(2);
    
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    
    $html = '<table border="0" cellpadding="5">
        <tr>
            <td width="30%"><strong>Name:</strong></td>
            <td width="70%">' . h($complaint->student->full_name ?? 'N/A') . '</td>
        </tr>
        <tr>
            <td><strong>Student No:</strong></td>
            <td>' . h($complaint->student->no_student ?? 'N/A') . '</td>
        </tr>
        <tr>
            <td><strong>Email:</strong></td>
            <td>' . h($complaint->student->email_address ?? 'N/A') . '</td>
        </tr>
    </table>';
    
    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Ln(5);
    
    // Description
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->SetFillColor(4, 120, 87);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(0, 10, 'Description', 0, 1, 'L', true);
    $pdf->Ln(2);
    
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->MultiCell(0, 5, $complaint->description, 0, 'L');
    $pdf->Ln(5);
    
    // Attachments
    if ($attachments->count() > 0) {
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetFillColor(4, 120, 87);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 10, 'Attachments (' . $attachments->count() . ')', 0, 1, 'L', true);
        $pdf->Ln(2);
        
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        
        foreach ($attachments as $attachment) {
            $pdf->Cell(10, 5, '•', 0, 0);
            $pdf->Cell(0, 5, h($attachment->file_name) . ' (' . strtoupper($attachment->file_type) . ')', 0, 1);
        }
        $pdf->Ln(5);
    }
    
    // Feedback History
    if ($feedbacks->count() > 0) {
        $pdf->SetFont('helvetica', 'B', 14);
        $pdf->SetFillColor(4, 120, 87);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(0, 10, 'Feedback History (' . $feedbacks->count() . ')', 0, 1, 'L', true);
        $pdf->Ln(2);
        
        $pdf->SetFont('helvetica', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        
        foreach ($feedbacks as $feedback) {
            $pdf->SetFont('helvetica', 'B', 10);
            $pdf->Cell(0, 5, $feedback->feedback_type . ' - ' . $feedback->created_at->format('d M Y, H:i'), 0, 1);
            $pdf->SetFont('helvetica', '', 10);
            $pdf->MultiCell(0, 5, $feedback->feedback_text, 0, 'L');
            $pdf->Cell(0, 5, 'By: ' . h($feedback->staff->staff_name ?? 'Staff'), 0, 1);
            $pdf->Ln(3);
        }
    }
    
    // Footer
    $pdf->Ln(10);
    $pdf->SetFont('helvetica', 'I', 8);
    $pdf->SetTextColor(128, 128, 128);
    $pdf->Cell(0, 5, 'Generated on ' . date('d M Y, H:i:s'), 0, 1, 'C');
    $pdf->Cell(0, 5, 'UPSI Complaint System - Confidential Document', 0, 1, 'C');
    
    // Output PDF
    $this->response = $this->response->withType('application/pdf');
    $this->response = $this->response->withDownload('complaint_' . $complaint->complaint_id . '.pdf');
    $this->response = $this->response->withStringBody($pdf->Output('complaint_' . $complaint->complaint_id . '.pdf', 'S'));
    
    return $this->response;
}

}