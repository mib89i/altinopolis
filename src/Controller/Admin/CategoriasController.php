<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class CategoriasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']);

        $session = $this->request->session();
        $session->write('link_actived', 'categorias');
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {
        $this->set('lista_categoria', $this->Categorias->find('all')->contain(['Users']));
    }

    public function add() {
        $categoria = $this->Categorias->newEntity();
        if ($this->request->is('post')) {
            $categorias = $this->Categorias->patchEntity($categoria, $this->request->data);
            $categorias->user_id = $this->Auth->user('id');
            if ($this->Categorias->save($categorias)) {
                $this->Flash->success(__('Registro inserido.'));
                return $this->redirect(['action' => 'edit', $categorias->id]);
            }
            $this->Flash->error(__('Não foi possível inserir registro.'));
        }
        $this->set('categoria', $categoria);
    }

    public function edit($id = NULL) {
        $categoria = $this->Categorias->get($id);
        if ($this->request->is(['post', 'put'])) {
            $categoria = $this->Categorias->patchEntity($categoria, $this->request->data);
            if ($this->Categorias->save($categoria)) {
                $this->Flash->success(__('Registro atualizado.'));
                //return $this->redirect(['action' => 'edit'. DS . $categorias->id]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível atualizar registro.'));
        }
        $this->set(compact('categoria'));
    }

    public function delete($id = NULL) {
        $categoria = $this->Categorias->get($id);
        $this->set(compact('categoria'));
        if ($this->request->is(['post', 'delete'])) {
            $categoria = $this->Categorias->patchEntity($categoria, $this->request->data);
            if ($this->Categorias->delete($categoria)) {
                $this->Flash->success(__('Registro removido.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível remover registro.'));
        }
    }

}
