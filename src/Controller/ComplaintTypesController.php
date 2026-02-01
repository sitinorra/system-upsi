<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ComplaintTypes Controller
 *
 * @property \App\Model\Table\ComplaintTypesTable $ComplaintTypes
 */
class ComplaintTypesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ComplaintTypes->find();
        $complaintTypes = $this->paginate($query);

        $this->set(compact('complaintTypes'));
    }

    /**
     * View method
     *
     * @param string|null $id Complaint Type id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $complaintType = $this->ComplaintTypes->get($id, contain: []);
        $this->set(compact('complaintType'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complaintType = $this->ComplaintTypes->newEmptyEntity();
        if ($this->request->is('post')) {
            $complaintType = $this->ComplaintTypes->patchEntity($complaintType, $this->request->getData());
            if ($this->ComplaintTypes->save($complaintType)) {
                $this->Flash->success(__('The complaint type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint type could not be saved. Please, try again.'));
        }
        $this->set(compact('complaintType'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complaint Type id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $complaintType = $this->ComplaintTypes->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complaintType = $this->ComplaintTypes->patchEntity($complaintType, $this->request->getData());
            if ($this->ComplaintTypes->save($complaintType)) {
                $this->Flash->success(__('The complaint type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint type could not be saved. Please, try again.'));
        }
        $this->set(compact('complaintType'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Complaint Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complaintType = $this->ComplaintTypes->get($id);
        if ($this->ComplaintTypes->delete($complaintType)) {
            $this->Flash->success(__('The complaint type has been deleted.'));
        } else {
            $this->Flash->error(__('The complaint type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
