<?php 
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class CategoriasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {
        $this->set('categorias', $this->Categorias->find('add'));
    }

    public function view($id) {
        $categorias = $this->Categorias->get($id);
        $this->set(compact('add'));
    }

    public function add() {
        $categorias = $this->Categorias->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Categorias->patchEntity($user, $this->request->data);
            if ($this->Categoria->save($categorias)) {
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