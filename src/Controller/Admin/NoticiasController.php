<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class NoticiasController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->deny(['index']);

        $session = $this->request->session();
        $session->write('link_actived', 'noticias');
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {
        $query = $this->Noticias;
        if($this->Auth->user('role') === 'admin') {
            $this->set('lista_noticias', 
                    $query->find('all')
                    ->order(['Noticias.title' => 'ASC', 'Noticias.created' => 'DESC'])
                    ->limit(200)
                    ->contain(['Users'])
            );
        } else {
            $this->set('lista_noticias', 
                    $query->find('all')
                    ->where(['user_id =' => $this->Auth->user('id')])
                    ->order(['Noticias.title' => 'ASC', 'Noticias.created' => 'DESC'])
                    ->limit(200)
                    ->contain(['Users'])
            );
        }
    }

    public function add() {
        $noticias = $this->Noticias->newEntity();
        if ($this->request->is('post')) {
            $noticias = $this->Noticias->patchEntity($noticias, $this->request->data);
            $noticias->user_id = $this->Auth->user('id');
            if ($this->Noticias->save($noticias)) {
                $this->Flash->success(__('Registro inserido.'));
                return $this->redirect(['action' => 'edit', $noticias->id]);
             }
            $this->Flash->error(__('Não foi possível inserir registro.'));
        }
        $noticias->active = true;
        $this->list_categories();
        $this->set('noticias', $noticias);
    }

    public function edit($id = NULL) {
        $noticias = $this->Noticias->get($id);
        if ($this->request->is(['post', 'put'])) {
            $noticias = $this->Noticias->patchEntity($noticias, $this->request->data);
            if ($this->Noticias->save($noticias)) {
                $this->Flash->success(__('Registro atualizado.'));
                //return $this->redirect(['action' => 'edit'. DS . $noticias->id]);
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível atualizar registro.'));
        }
        $this->list_categories();
        $this->set(compact('noticias'));
    }

    public function delete($id = NULL) {
        $noticias = $this->Noticias->get($id);
        $this->set(compact('noticias'));
        if ($this->request->is(['post', 'delete'])) {
            $noticias = $this->Noticias->patchEntity($noticias, $this->request->data);
            if ($this->Noticias->delete($noticias)) {
                $this->Flash->success(__('Registro removido.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Não foi possível remover registro.'));
        }
    }

    public function list_categories() {
        $cat = TableRegistry::get('Categorias');
        $lista_categoria = $cat
                ->find('list')
                ->select(['Categorias.id', 'Categorias.name'])
                ->where(['user_id =' => $this->Auth->user('id')])
                ->order(['Categorias.name' => 'ASC']);
        $this->set(compact('lista_categoria'));
    }

}
