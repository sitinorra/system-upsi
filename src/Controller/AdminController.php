<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class AdminController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Require login
        $redirect = $this->requireAuth();
        if ($redirect) {
            return $redirect;
        }
        
        // Check if user is Admin
        if (!$this->isUserType('Admin')) {
            $this->Flash->error('Access denied. Admin only.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    
    public function dashboard()
{
    $userId = $this->request->getSession()->read('Auth.user_id');
    
    // Get admin info
    $AdminTable = TableRegistry::getTableLocator()->get('Admin');
    $admin = $AdminTable->find()
        ->contain(['Users'])
        ->where(['Admin.user_id' => $userId])
        ->first();

    // Get department separately if admin has one
    if ($admin && $admin->department) {
        $DepartmentsTable = TableRegistry::getTableLocator()->get('Departments');
        $department = $DepartmentsTable->find()
            ->where(['dept_id' => $admin->department])
            ->first();
        $admin->departmentName = $department ? $department->dept_name : 'N/A';
    } else {
        $admin->departmentName = 'N/A';
    }
    
    // Get ALL complaints (admin can see everything)
    $ComplaintsTable = TableRegistry::getTableLocator()->get('Complaints');
    
    $query = $ComplaintsTable->find()
        ->contain(['Student', 'ComplaintTypes', 'ComplaintCategories']);
    
    // Search functionality
    $search = $this->request->getQuery('search');
    if (!empty($search)) {
        $allComplaints = $query->all();
        
        $filtered = [];
        $searchLower = strtolower($search);
        
        foreach ($allComplaints as $complaint) {
            $studentName = strtolower($complaint->student->full_name ?? '');
            $type = strtolower($complaint->complaint_type->type_name ?? '');
            $category = strtolower($complaint->complaint_category->category_name ?? '');
            $description = strtolower($complaint->description ?? '');
            $status = strtolower($complaint->status ?? '');
            $id = (string)$complaint->complaint_id;
            
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
        $complaints = $query->order(['Complaints.created_at' => 'DESC'])->all()->toArray();
    }
    
    // Count statistics
    $totalComplaints = $ComplaintsTable->find()->count();
    $pendingComplaints = $ComplaintsTable->find()->where(['status' => 'Pending'])->count();
    $inProgressComplaints = $ComplaintsTable->find()->where(['status' => 'In Progress'])->count();
    $resolvedComplaints = $ComplaintsTable->find()->where(['status' => 'Resolved'])->count();
    
    $this->set(compact('admin', 'complaints', 'totalComplaints', 'pendingComplaints', 'inProgressComplaints', 'resolvedComplaints', 'search'));
}
    
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $ComplaintsTable = TableRegistry::getTableLocator()->get('Complaints');
        $complaint = $ComplaintsTable->get($id);
        
        if ($ComplaintsTable->delete($complaint)) {
            $this->Flash->success('Complaint #' . $id . ' has been deleted successfully.');
        } else {
            $this->Flash->error('Unable to delete complaint. Please try again.');
        }
        
        return $this->redirect(['action' => 'dashboard']);
    }

    public function students()
{
    $StudentsTable = TableRegistry::getTableLocator()->get('Student');
    $students = $StudentsTable->find()
        ->contain(['Users'])
        ->order(['Student.created_at' => 'DESC'])
        ->all();
    
    $this->set(compact('students'));
}

public function staff()
{
    $StaffTable = TableRegistry::getTableLocator()->get('Staff');
    $staff = $StaffTable->find()
        ->contain(['Users', 'ComplaintCategories'])
        ->order(['Staff.staff_id' => 'DESC'])
        ->all();
    
    $this->set(compact('staff'));
}

public function addStudent()
{
    $StudentTable = TableRegistry::getTableLocator()->get('Student');
    $UsersTable = TableRegistry::getTableLocator()->get('Users');
    
    if ($this->request->is('post')) {
        $data = $this->request->getData();
        
        // Create user account first
        $user = $UsersTable->newEmptyEntity();
        $userData = [
            'username' => $data['username'],
            'password' => $data['password'],
            'user_type' => 'Student',
            'email' => $data['email_address']
        ];
        $user = $UsersTable->patchEntity($user, $userData);
        
        if ($UsersTable->save($user)) {
            // Use direct SQL insert for student (to bypass strict validation)
            $connection = $StudentTable->getConnection();
            
            try {
                $connection->insert('student', [
                'user_id' => $user->user_id,
                'full_name' => $data['full_name'] ?? '',
                'no_student' => $data['no_student'] ?? '',
                'gender' => $data['gender'] ?? 'Male',
                'semester' => $data['semester'] ?? 1,
                'email_address' => $data['email_address'] ?? '',
                'phone_number' => $data['phone_number'] ?? '',
                'address_1' => $data['address'] ?? 'N/A',
                'address_2' => '',
                'posscode' => $data['posscode'] ?? '00000',
                'state' => $data['state'] ?? 'Selangor'
            ], ['user_id' => 'integer', 'semester' => 'integer']);
                
                $this->Flash->success('Student registered successfully! Username: ' . $user->username);
                return $this->redirect(['action' => 'students']);
                
            } catch (\Exception $e) {
                // Delete user if student creation fails
                $UsersTable->delete($user);
                $this->Flash->error('Unable to create student record: ' . $e->getMessage());
            }
        } else {
            // Show user creation errors
            $errors = $user->getErrors();
            $errorMsg = 'Unable to create user account: ';
            foreach ($errors as $field => $error) {
                $errorMsg .= $field . ' - ' . implode(', ', $error) . '; ';
            }
            $this->Flash->error($errorMsg);
        }
    }
    
    // Get list of Malaysian states for dropdown
    $states = [
        'Johor' => 'Johor',
        'Kedah' => 'Kedah',
        'Kelantan' => 'Kelantan',
        'Melaka' => 'Melaka',
        'Negeri Sembilan' => 'Negeri Sembilan',
        'Pahang' => 'Pahang',
        'Perak' => 'Perak',
        'Perlis' => 'Perlis',
        'Pulau Pinang' => 'Pulau Pinang',
        'Sabah' => 'Sabah',
        'Sarawak' => 'Sarawak',
        'Selangor' => 'Selangor',
        'Terengganu' => 'Terengganu',
        'WP Kuala Lumpur' => 'WP Kuala Lumpur',
        'WP Labuan' => 'WP Labuan',
        'WP Putrajaya' => 'WP Putrajaya'
    ];
    
    $student = $StudentTable->newEmptyEntity();
    $this->set(compact('student', 'states'));
}
}