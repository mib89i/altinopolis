<?php 
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class CategoriasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event); 
        $this->Auth->deny(['index']);       
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {
        $this->set('lista_categoria', $this->Categorias->find('all'));
    }

    public function edit($id = NULL) {
        $categorias = $this->Categorias->get($id);
        $this->set(compact('categorias'));
        if ($this->request->is('post')) {
            $categorias = $this->Categorias->patchEntity($categorias, $this->request->data);
            if ($this->Categorias->update($categorias)) {
                $this->Flash->success(__('Categoria atualizada.'));
                return $this->redirect(['action' => 'edit']);
            }
            $this->Flash->error(__('Não foi possível salvar categoria.'));
		}
             
    }
    

    public function add() {
        $categorias = $this->Categorias->newEntity();
        if ($this->request->is('post')) {
            $categorias = $this->Categorias->patchEntity($categorias, $this->request->data);
            if ($this->Categorias->save($categorias)) {
                $this->Flash->success(__('Categoria inserida.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Não foi possível salvar categoria.'));
        }
        $this->set('categorias', $categorias);
    }
    
    public function delete($id = NULL) {
        $categorias = $this->Categorias->get($id);
        $this->set(compact('categorias'));
        if ($this->request->is('post')) {
            $categorias = $this->Categorias->patchEntity($categorias, $this->request->data);
            if ($this->Categorias->delete($categorias)) {
                $this->Flash->success(__('Categoria removida.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível salvar categoria.'));
		}
             
    }    

    public function painel() {

    }

}