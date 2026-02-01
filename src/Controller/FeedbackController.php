<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Feedback Controller
 *
 * @property \App\Model\Table\FeedbackTable $Feedback
 */
class FeedbackController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Feedback->find()
            ->contain(['Complaints', 'Staffs']);
        $feedback = $this->paginate($query);

        $this->set(compact('feedback'));
    }

    /**
     * View method
     *
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $feedback = $this->Feedback->get($id, contain: ['Complaints', 'Staffs']);
        $this->set(compact('feedback'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $feedback = $this->Feedback->newEmptyEntity();
        if ($this->request->is('post')) {
            $feedback = $this->Feedback->patchEntity($feedback, $this->request->getData());
            if ($this->Feedback->save($feedback)) {
                $this->Flash->success(__('The feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
        }
        $complaints = $this->Feedback->Complaints->find('list', limit: 200)->all();
        $staffs = $this->Feedback->Staffs->find('list', limit: 200)->all();
        $this->set(compact('feedback', 'complaints', 'staffs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $feedback = $this->Feedback->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $feedback = $this->Feedback->patchEntity($feedback, $this->request->getData());
            if ($this->Feedback->save($feedback)) {
                $this->Flash->success(__('The feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The feedback could not be saved. Please, try again.'));
        }
        $complaints = $this->Feedback->Complaints->find('list', limit: 200)->all();
        $staffs = $this->Feedback->Staffs->find('list', limit: 200)->all();
        $this->set(compact('feedback', 'complaints', 'staffs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Feedback id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $feedback = $this->Feedback->get($id);
        if ($this->Feedback->delete($feedback)) {
            $this->Flash->success(__('The feedback has been deleted.'));
        } else {
            $this->Flash->error(__('The feedback could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
