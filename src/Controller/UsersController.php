<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

class UsersController extends AppController
{
    public function login()
    {
        
        if ($this->isLoggedIn()) {
            $userType = $this->request->getSession()->read('Auth.user_type');
            return $this->redirect($this->getRedirectUrl($userType));
        }
        
        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = $this->request->getData('password');
            
            
            $UsersTable = TableRegistry::getTableLocator()->get('Users');
            $user = $UsersTable->find()
                ->where(['username' => $username])
                ->first();
            
            
            if ($user && password_verify($password, $user->password)) {
                
                $this->request->getSession()->write('Auth', [
                    'user_id' => $user->user_id,
                    'username' => $user->username,
                    'user_type' => $user->user_type,
                    'email' => $user->email
                ]);
                
                $this->Flash->success('Welcome back, ' . $user->username . '!');
                
                
                return $this->redirect($this->getRedirectUrl($user->user_type));
            } else {
                $this->Flash->error('Invalid username or password. Please try again.');
            }
        }
    }

    public function logout()
    {
        $this->request->getSession()->delete('Auth');
        $this->Flash->success('You have been logged out successfully.');
        return $this->redirect(['action' => 'login']);
    }
    
    private function getRedirectUrl($userType)
    {
        switch ($userType) {
            case 'Student':
                return ['controller' => 'Student', 'action' => 'dashboard'];
            case 'Staff':
                return ['controller' => 'Staff', 'action' => 'dashboard'];
            case 'Admin':
                return ['controller' => 'Admin', 'action' => 'dashboard'];
            default:
                return ['controller' => 'Pages', 'action' => 'display', 'home'];
        }
    }
}