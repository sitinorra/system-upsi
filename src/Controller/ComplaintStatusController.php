<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ComplaintStatus Controller
 *
 * @property \App\Model\Table\ComplaintStatusTable $ComplaintStatus
 */
class ComplaintStatusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->ComplaintStatus->find()
            ->contain(['Complaints', 'ChangedByStaffs']);
        $complaintStatus = $this->paginate($query);

        $this->set(compact('complaintStatus'));
    }

    /**
     * View method
     *
     * @param string|null $id Complaint Status id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $complaintStatus = $this->ComplaintStatus->get($id, contain: ['Complaints', 'ChangedByStaffs']);
        $this->set(compact('complaintStatus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $complaintStatus = $this->ComplaintStatus->newEmptyEntity();
        if ($this->request->is('post')) {
            $complaintStatus = $this->ComplaintStatus->patchEntity($complaintStatus, $this->request->getData());
            if ($this->ComplaintStatus->save($complaintStatus)) {
                $this->Flash->success(__('The complaint status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint status could not be saved. Please, try again.'));
        }
        $complaints = $this->ComplaintStatus->Complaints->find('list', limit: 200)->all();
        $changedByStaffs = $this->ComplaintStatus->ChangedByStaffs->find('list', limit: 200)->all();
        $this->set(compact('complaintStatus', 'complaints', 'changedByStaffs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Complaint Status id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $complaintStatus = $this->ComplaintStatus->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $complaintStatus = $this->ComplaintStatus->patchEntity($complaintStatus, $this->request->getData());
            if ($this->ComplaintStatus->save($complaintStatus)) {
                $this->Flash->success(__('The complaint status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The complaint status could not be saved. Please, try again.'));
        }
        $complaints = $this->ComplaintStatus->Complaints->find('list', limit: 200)->all();
        $changedByStaffs = $this->ComplaintStatus->ChangedByStaffs->find('list', limit: 200)->all();
        $this->set(compact('complaintStatus', 'complaints', 'changedByStaffs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Complaint Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $complaintStatus = $this->ComplaintStatus->get($id);
        if ($this->ComplaintStatus->delete($complaintStatus)) {
            $this->Flash->success(__('The complaint status has been deleted.'));
        } else {
            $this->Flash->error(__('The complaint status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
