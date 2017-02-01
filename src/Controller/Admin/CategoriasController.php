<?php 
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class CategoriasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $this->Auth->allow(['logout']);
        $this->Auth->deny(['index']);
    }

    public function isAuthorized($user) {
        return true;
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

        if ( $this->Auth->user() ) {
            echo 'aaa';
            return $this->redirect('/admin/users/painel');
        }
    }

    public function index() {
        $this->set('categorias', $this->Categorias->find('add'));
    }

    public function view($id) {
        $categorias = $this->Categorias->get($id);
        $this->set(compact('add'));
    }

    public function add() {
        $categorias = $this->Preferencia->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Categorias->patchEntity($user, $this->request->data);
            if ($this->Categorias->save($categorias)) {
                $this->Flash->success(__('Categoria inserida.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Não foi possível salvar categoria.'));
        }
        $this->set('categorias', $categorias);
    }

    public function painel() {

    }

}