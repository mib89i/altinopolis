<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

// Habilita o parseamento de datas localizadas
// VER ISSO http://cauancabral.net/2015/02/15/cakephp-3-0-o-fim-do-locale/

class NoticiasController extends AppController {
    

    public function beforeFilter(Event $event) {
         $this->Auth->allow(['find']);
         $this->Auth->allow(['view']);
        parent::beforeFilter($event);        
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {
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
        $this->set(compact('noticias'));
        $this->set('title', 'Notícias');
        $this->set('meta_description', 'Notícias');
        $this->set('meta_keyworks', 'noticias');
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
        $this->set('title', $noticias->title);
        $this->set('meta_description', $noticias->subtitle);
        $this->set('meta_keyworks', 'noticias');        
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

    public function find() {
        $noticias = TableRegistry::get('Noticias');
        $search = $this->request->query['search'];
        $lista_noticias = $noticias
                ->find('all')
                ->where([
                    'title LIKE' => "%{$search}%"
                ])
                ->orWhere([
                    'subtitle LIKE' => "%{$search}%"
                ])
                ->orWhere([
                    'Users.name LIKE' => "%{$search}%"
                ])
                ->order([
                    'Noticias.schedule' => 'DESC',
                    'Noticias.created' => 'DESC',
                    'Noticias.title' => 'ASC'
                ])
                ->contain(['Users', 'Categorias']);
        $this->set(compact('search'));
        $this->set(compact('lista_noticias'));
        $this->set('title', "Pesquisar " + $search);
        $this->set('meta_description', "Pesquisar");
        $this->set('meta_keyworks', 'noticias');        
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