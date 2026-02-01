<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class StaffController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Require login
        $redirect = $this->requireAuth();
        if ($redirect) {
            return $redirect;
        }
        
        // Check if user is Staff
        if (!$this->isUserType('Staff')) {
            $this->Flash->error('Access denied. Staff only.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    
    public function dashboard()
{
    $userId = $this->request->getSession()->read('Auth.user_id');
    
    // Get staff info
    $StaffTable = TableRegistry::getTableLocator()->get('Staff');
    $staff = $StaffTable->find()
        ->contain(['ComplaintCategories'])
        ->where(['user_id' => $userId])
        ->first();
    
    // Initialize
    $complaints = [];
    $totalComplaints = 0;
    $pendingComplaints = 0;
    $inProgressComplaints = 0;
    $resolvedComplaints = 0;
    $search = $this->request->getQuery('search');
    
    if ($staff && $staff->categories) {
        $ComplaintsTable = TableRegistry::getTableLocator()->get('Complaints');
        
        // Get all complaints for this category
        $query = $ComplaintsTable->find()
            ->contain(['Student', 'ComplaintTypes', 'ComplaintCategories'])
            ->where(['Complaints.category_id' => $staff->categories]);
        
        $allComplaints = $query->order(['Complaints.created_at' => 'DESC'])->all();
        
        // Apply search filter
        if (!empty($search)) {
            $filtered = [];
            foreach ($allComplaints as $complaint) {
                $studentName = strtolower($complaint->student->full_name ?? '');
                $type = strtolower($complaint->complaint_type->type_name ?? '');
                $category = strtolower($complaint->complaint_category->category_name ?? '');
                $description = strtolower($complaint->description ?? '');
                $status = strtolower($complaint->status ?? '');
                $id = (string)$complaint->complaint_id;
                $searchLower = strtolower($search);
                
                if (
                    strpos($studentName, $searchLower) !== false ||
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
            $complaints = $allComplaints;
        }
        
        // Count statistics (from all, not filtered)
        $totalComplaints = $ComplaintsTable->find()
            ->where(['category_id' => $staff->categories])
            ->count();
            
        $pendingComplaints = $ComplaintsTable->find()
            ->where(['category_id' => $staff->categories, 'status' => 'Pending'])
            ->count();
            
        $inProgressComplaints = $ComplaintsTable->find()
            ->where(['category_id' => $staff->categories, 'status' => 'In Progress'])
            ->count();
            
        $resolvedComplaints = $ComplaintsTable->find()
            ->where(['category_id' => $staff->categories, 'status' => 'Resolved'])
            ->count();
    }
    
    $this->set(compact('staff', 'complaints', 'totalComplaints', 'pendingComplaints', 'inProgressComplaints', 'resolvedComplaints', 'search'));
}
    
    public function updateStatus($id = null)
{
    $this->request->allowMethod(['post', 'put']);
    
    // Load Complaints table
    $ComplaintsTable = TableRegistry::getTableLocator()->get('Complaints');
    
    // Get complaint
    $complaint = $ComplaintsTable->get($id, [
        'contain' => ['Student', 'ComplaintTypes', 'ComplaintCategories']
    ]);
    
    // Get new status from form
    $newStatus = $this->request->getData('status');
    
    if (!empty($newStatus)) {
        $complaint->status = $newStatus;
        
        if ($ComplaintsTable->save($complaint)) {
            // Reload complaint with relationships for email
            $complaint = $ComplaintsTable->get($id, [
                'contain' => ['Student', 'ComplaintTypes', 'ComplaintCategories']
            ]);
            
            // Send email notification (simulated)
            \App\Utility\EmailHelper::sendComplaintNotification(
                'status_updated',
                $complaint,
                $complaint->student->email_address,
                $complaint->student->full_name
            );
            
            $this->Flash->success('Complaint status updated successfully. Email notification sent to student.');
        } else {
            $this->Flash->error('Unable to update complaint status. Please try again.');
        }
    }
    
    return $this->redirect(['action' => 'dashboard']);
}

    public function addFeedback($complaintId = null)
{
    $this->request->allowMethod(['post']);
    
    $userId = $this->request->getSession()->read('Auth.user_id');
    
    // Get staff info
    $StaffTable = TableRegistry::getTableLocator()->get('Staff');
    $staff = $StaffTable->find()
        ->where(['user_id' => $userId])
        ->first();
    
    if (!$staff) {
        $this->Flash->error('Staff record not found.');
        return $this->redirect(['action' => 'dashboard']);
    }
    
    $feedbackText = $this->request->getData('feedback_text');
    $feedbackType = $this->request->getData('feedback_type');
    
    if (!empty($feedbackText)) {
        $FeedbackTable = TableRegistry::getTableLocator()->get('Feedback');
        
        $feedback = $FeedbackTable->newEmptyEntity();
        $feedback->complaint_id = $complaintId;
        $feedback->staff_id = $staff->staff_id;
        $feedback->department = 1; // Set default to USAU (dept_id = 1)
        $feedback->feedback_type = $feedbackType;
        $feedback->feedback_text = $feedbackText;
        
                if ($FeedbackTable->save($feedback)) {
                // Get complaint with student
                $ComplaintsTable = TableRegistry::getTableLocator()->get('Complaints');
                $complaint = $ComplaintsTable->get($complaintId, [
                    'contain' => ['Student', 'ComplaintTypes', 'ComplaintCategories']
                ]);
                
                // TAMBAH NI - Email notification (dummy)
                \App\Utility\EmailHelper::sendComplaintNotification(
                    'feedback_added',
                    $complaint,
                    $complaint->student->email_address,
                    $complaint->student->full_name
                );
                
        $this->Flash->success('Feedback added successfully. Email notification sent to student.');
        } else {
            $this->Flash->error('Unable to add feedback. Please try again.');
        }
    }
    
    return $this->redirect(['controller' => 'Complaints', 'action' => 'view', $complaintId]);
}
}
