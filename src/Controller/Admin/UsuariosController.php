<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class UsuariosController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['logout']);
        $this->Auth->deny(['index']);

        $session = $this->request->session();
        $session->write('link_actived', 'meu-painel');
    }

    public function isAuthorized($usuario) {
        return true;
    }

    public function login() {
        if ($this->request->is('post')) {
            $usuario = $this->Auth->identify();
            if ($usuario) {
                $this->Auth->setUser($usuario);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Usuário ou Senha inválida, tente novamente'));
        }

        if ($this->Auth->user()) {
            return $this->redirect('/admin/usuarios');
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->set('lista_usuarios', $this->Usuarios->find('all'));
    }

    public function view($id) {
        $usuario = $this->Usuarios->get($id);
        $this->set(compact('usuario'));
    }

    public function add() {
        $usuario = $this->Usuarios->newEntity();
        if ($this->request->is('post')) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Registro salvo.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Não foi possível inserir registro.'));
        }
        $this->set('usuario', $usuario);
    }

    public function edit($id = NULL) {
        $usuario = $this->Usuarios->get($id);
        if ($this->request->is(['post', 'put'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->save($usuario)) {
                $this->Flash->success(__('Registro atualizado.'));
                //return $this->redirect(['action' => 'edit'. DS . $categorias->id]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível atualizar registro.'));
        }
        $this->set(compact('usuario'));
    }

    public function delete($id = NULL) {
        $usuario = $this->Usuarios->get($id);
        $this->set(compact('user'));
        if ($this->request->is(['post', 'delete'])) {
            $usuario = $this->Usuarios->patchEntity($usuario, $this->request->data);
            if ($this->Usuarios->delete($usuario)) {
                $this->Flash->success(__('Registro removido.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível remover registro.'));
        }
    }

}
