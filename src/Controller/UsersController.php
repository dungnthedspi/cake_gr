<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
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
            $this->Auth->allow(['logout', 'login']);
        }
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
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
        $user = $this->Users->get($this->Auth->user('id'), [
            'contain' => []
        ]);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function isAuthorized($user)
    {
        if (in_array($this->request->action, ['view'])) {
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
