<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Agencies Controller
 *
 * @property \App\Model\Table\AgenciesTable $Agencies
 */
class AgenciesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $agencies = $this->paginate($this->Agencies);

        $this->set(compact('agencies'));
        $this->set('_serialize', ['agencies']);
    }

    /**
     * View method
     *
     * @param string|null $id Agency id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $agency = $this->Agencies->get($id, [
            'contain' => []
        ]);

        $this->set('agency', $agency);
        $this->set('_serialize', ['agency']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $agency = $this->Agencies->newEntity();
        if ($this->request->is('post')) {
            $agency = $this->Agencies->patchEntity($agency, $this->request->data);
            if ($this->Agencies->save($agency)) {
                $this->Flash->success(__('The agency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The agency could not be saved. Please, try again.'));
        }
        $this->set(compact('agency'));
        $this->set('_serialize', ['agency']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Agency id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $agency = $this->Agencies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $agency = $this->Agencies->patchEntity($agency, $this->request->data);
            if ($this->Agencies->save($agency)) {
                $this->Flash->success(__('The agency has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The agency could not be saved. Please, try again.'));
        }
        $this->set(compact('agency'));
        $this->set('_serialize', ['agency']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Agency id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $agency = $this->Agencies->get($id);
        if ($this->Agencies->delete($agency)) {
            $this->Flash->success(__('The agency has been deleted.'));
        } else {
            $this->Flash->error(__('The agency could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['index', 'add'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }
}
