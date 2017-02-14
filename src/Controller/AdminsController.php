<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class AdminsController extends AppController
{

    /**
     * initialize method
     */
    public function initialize()
    {
        parent::initialize();
        // Add logout to the allowed actions list.
        if ($this->Auth->user()){
            $this->Auth->allow(['logout']);
        }
        else{
            $this->Auth->allow(['register', 'logout', 'login']);
        }
    }

    public function register()
    {
        $this->Admins = TableRegistry::get('Users');
        $user = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Admins->patchEntity($user, $this->request->data);
            if ($this->Admins->save($user)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The login could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function listAgency()
    {
        $this->Admins = TableRegistry::get('Users');
        $users = $this->paginate($this->Admins->find('all', ['conditions' => ['Users.role' => '1']]));

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect(['action' => 'listAgency']);
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->Admins = TableRegistry::get('Users');
        $user = $this->Admins->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addAgency()
    {
        $this->Admins = TableRegistry::get('Users');
        $user = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Admins->patchEntity($user, $this->request->data);
            $user->role = "1";
            if ($this->Admins->save($user)) {
                $this->Flash->success(__('The Agency has been saved.'));

                return $this->redirect(['action' => 'addAgency']);
            }
            $this->Flash->error(__('The Agency could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function listExpert()
    {
        $this->Admins = TableRegistry::get('Users');
        $users = $this->paginate($this->Admins->find('all', ['conditions' => ['Users.role' => '2']]));

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function addExpert()
    {
        $this->Admins = TableRegistry::get('Users');
        $user = $this->Admins->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Admins->patchEntity($user, $this->request->data);
            $user->role = "2";
            if ($this->Admins->save($user)) {
                $this->Flash->success(__('The Expert has been saved.'));

                return $this->redirect(['action' => 'addExpert']);
            }
            $this->Flash->error(__('The Expert could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function delete($id = null)
    {
        $this->Admins = TableRegistry::get('Users');
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Admins->get($id);
        if ($this->Admins->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['addAgency', 'listAgency', 'addExpert', 'listExpert', 'delete'])) {
            return true;
        }
        return parent::isAuthorized($user);
    }

    public function logout()
    {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }
}
