<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class StudentController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        
        // Require login for all actions
        $redirect = $this->requireAuth();
        if ($redirect) {
            return $redirect;
        }
        
        // Check if user is Student
        if (!$this->isUserType('Student')) {
            $this->Flash->error('Access denied. Students only.');
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
    
    public function dashboard()
    {
        $userId = $this->request->getSession()->read('Auth.user_id');
        
        // Get student info
        $StudentTable = TableRegistry::getTableLocator()->get('Student');
        $student = $StudentTable->find()
            ->where(['user_id' => $userId])
            ->first();
        
        // Get student's complaints
        $ComplaintsTable = TableRegistry::getTableLocator()->get('Complaints');
        $complaints = $ComplaintsTable->find()
            ->contain(['ComplaintTypes', 'ComplaintCategories'])
            ->where(['Complaints.student_id' => $student ? $student->student_id : null])
            ->order(['Complaints.created_at' => 'DESC'])
            ->limit(5)
            ->all();
        
        // Count statistics
        $totalComplaints = $ComplaintsTable->find()
            ->where(['student_id' => $student ? $student->student_id : null])
            ->count();
            
        $pendingComplaints = $ComplaintsTable->find()
            ->where([
                'student_id' => $student ? $student->student_id : null,
                'status' => 'Pending'
            ])
            ->count();
            
        $resolvedComplaints = $ComplaintsTable->find()
            ->where([
                'student_id' => $student ? $student->student_id : null,
                'status' => 'Resolved'
            ])
            ->count();
        
        $this->set(compact('student', 'complaints', 'totalComplaints', 'pendingComplaints', 'resolvedComplaints'));
    }
}