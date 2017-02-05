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

    public function index($q = NULL) {
        $query = $this->Noticias;
        if ($this->Auth->user('role') === 'admin') {
            $this->set('lista_noticias', $query->find('all')
                            ->order(['Noticias.title' => 'ASC', 'Noticias.created' => 'DESC'])
                            ->limit(200)
                            ->contain(['Users'])
            );
        } else {
            $this->set('lista_noticias', $query->find('all')
                            ->where(['user_id =' => $this->Auth->user('id')])
                            ->order(['Noticias.title' => 'ASC', 'Noticias.created' => 'DESC'])
                            ->limit(200)
                            ->contain(['Users'])
            );
        }
        echo $this->request->query('q');
        $noticias = $query;
        $this->set('noticias');
        $this->set('q');
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
            debug($noticias);
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

    public function view($id = NULL) {
        if ($id === NULL) {
            $this->Flash->e - rror(__('NOTÍCIA NÃO ENCONTRADA!'));
            return;
        }
        $noticias = $this->Noticias->get($id);
        $this->load_user($noticias->user_id);
        $this->load_categoria($noticias->category_id);
        $this->set(compact('noticias'));
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

    public function find($q = NULL) {
        $noticias = TableRegistry::get('Noticias');
        $lista_noticias = $noticias
                ->find('all')
                ->where([
                    'title LIKE' => "%{$q}%"
                ])
                ->andWhere([
                    'subtitle LIKE' => "%{$q}%"
                ])
                ->andWhere([
                    'Users.name LIKE' => "%{$q}%"
                ])
                ->order([
                    'Noticias.schedule' => 'DESC',
                    'Noticias.created' => 'DESC',
                    'Noticias.title' => 'ASC'
                ])
                ->contain(['Users', 'Categorias']);
        $this->set(compact('lista_noticias'));
    }

    public function load_user($user_id = NULL) {
        $usuario = TableRegistry::get('Users')->get($user_id);
        $this->set(compact('usuario'));
    }

    public function load_categoria($category_id = NULL) {
        $categoria = TableRegistry::get('Categorias')->get($category_id);
        $this->set(compact('categoria'));
    }

}
