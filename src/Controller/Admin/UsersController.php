<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['logout', 'account']);
        $this->Auth->deny(['index']);

        $session = $this->request->session();
        $session->write('link_actived', 'users');
    }

    public function isAuthorized($user) {
        if ($this->request->params['prefix'] === 'admin') {
            return (bool)($user['role'] === 'admin');
        }
        return false;
    }

    public function login() {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Usuário ou Senha inválida, tente novamente'));
        }

        if ($this->Auth->user()) {
            return $this->redirect('/admin/painel');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->set('list_users', $this->Users->find('all'));
    }

    public function view($id) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    public function add() {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registro salvo.'));
                return $this->redirect(['action' => 'edit', $user->id]);
            }
            $this->Flash->error(__('Não foi possível inserir registro.'));
        }
        $this->set('user', $user);
    }

    public function edit($id = NULL) {
        $user = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registro Atualizado.'));
                //return $this->redirect(['action' => 'edit'. DS . $categorias->id]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível atualizar registro.'));
        }
        $this->set(compact('user'));
    }

    public function delete($id = NULL) {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
        if ($this->request->is(['post', 'delete'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->delete($user)) {
                $this->Flash->success(__('Registro removido.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível remover registro.'));
        }
    }
    
    public function account() {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registro Atualizado.'));
                //return $this->redirect(['action' => 'edit'. DS . $categorias->id]);
                //return $this->redirect(['action' => 'account']);
                return $this->render(['action' => 'account']);
            }
            $this->Flash->error(__('Não foi possível atualizar Registro.'));
        }
        $this->set(compact('user'));
    }
    
    public function alterarSenha($user_id = NULL){
        if (!empty($this->request->data)) {
            if ($user_id != NULL){
                $user = $this->Users->get($user_id);
                
                $user = $this->Users->patchEntity($user, [
                    'password' => $this->request->data['new_password'], 
                    'new_password' => $this->request->data['new_password'], 
                    'confirm_password' => $this->request->data['confirm_password']
                ], ['validate' => 'passwordadmin'] ); // referencia a validationPassword
                // if ['validate' => 'qualquercoisa'] // referencia a validationQualquerCoisa
            } else {
                $user = $this->Users->get($this->Auth->user('id'));   

                $user = $this->Users->patchEntity($user, [
                    'old_password' => $this->request->data['old_password'], 
                    'password' => $this->request->data['new_password'], 
                    'new_password' => $this->request->data['new_password'], 
                    'confirm_password' => $this->request->data['confirm_password']
                ], ['validate' => 'password'] ); // referencia a validationPassword
                // if ['validate' => 'qualquercoisa'] // referencia a validationQualquerCoisa

            }
            
            if ($user->errors()) {
                foreach ($user->errors() as $erro) {
                    if (isset($erro['custom'])){
                        $this->Flash->error($erro['custom']); 
                    }
                    if (isset($erro['match'])){
                        $this->Flash->error($erro['match']); 
                    }
                }
                return $this->redirect($this->referer()); 
            }

            if ($this->Users->save($user)) { 
                $this->Flash->success('Senha Alterada com Sucesso!'); 
                $this->redirect($this->referer()); 
            } else { 
                $this->Flash->error('Ocorreu um erro ao alterar a senha!'); 
            }
        }
        $this->redirect($this->referer()); 
    }

    public function painel() {
        
    }

}
