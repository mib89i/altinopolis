<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Database\Type;

// Habilita o parseamento de datas localizadas
// VER ISSO http://cauancabral.net/2015/02/15/cakephp-3-0-o-fim-do-locale/

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
        $search = "";
        if ($this->request->is('get')) {
            try {
                if(sizeof($this->request->query) > 0) {
                    $search = $this->request->query['search'];                    
                }
            } catch (Exception $ex) {
                $search = "";
            }            
        }
        
        $query = $this->Noticias;
        if ($this->Auth->user('role') === 'admin') {
            if (empty($search)) {
                $this->set('lista_noticias', $query->find('all')
                                ->order(['Noticias.title' => 'ASC', 'Noticias.created' => 'DESC'])
                                ->limit(200)
                                ->contain(['Users', 'Albuns'])
                );
            } else {
                $this->set('lista_noticias', $query
                                ->find('all')
                                ->where([
                                    'Noticias.title LIKE' => "%{$search}%"
                                ])
                                ->orWhere([
                                    'Noticias.subtitle LIKE' => "%{$search}%"
                                ])
                                ->orWhere([
                                    'Users.name LIKE' => "%{$search}%"
                                ])
                                ->order([
                                    'Noticias.schedule' => 'DESC',
                                    'Noticias.created' => 'DESC',
                                    'Noticias.title' => 'ASC'
                                ])
                                ->contain(['Users', 'Categorias', 'Albuns']));
                $this->set(compact('search'));
                $this->set(compact('lista_noticias'));
            }
        } else {
            if (empty($search)) {
                $this->set('lista_noticias', $query->find('all')
                                ->where(['Noticias.user_id =' => $this->Auth->user('id')])
                                ->order(['Noticias.title' => 'ASC', 'Noticias.created' => 'DESC'])
                                ->limit(200)
                                ->contain(['Users', 'Albuns'])
                );
            } else {
                $this->set('lista_noticias', $query
                                ->find('all')
                                ->where([
                                    'Noticias.title LIKE' => "%{$search}%"
                                ])
                                ->where(['user_id =' => $this->Auth->user('id')])
                                ->orWhere([
                                    'Noticias.subtitle LIKE' => "%{$search}%"
                                ])
                                ->orWhere([
                                    'Users.name LIKE' => "%{$search}%"
                                ])
                                ->order([
                                    'Noticias.schedule' => 'DESC',
                                    'Noticias.created' => 'DESC',
                                    'Noticias.title' => 'ASC'
                                ])
                                ->contain(['Users', 'Categorias', 'Albuns']));
                $this->set(compact('search'));
                $this->set(compact('lista_noticias'));
            }
        }
        echo $this->request->query('q');
        $noticias = $query;
        $this->set('noticias');
        $this->set('q');
    }

    public function add() {
        $noticias = $this->Noticias->newEntity();

        if ($this->request->session()->check('noticia_id_session')){
            $this->request->session()->delete('noticia_id_session');
        }

        if ($this->request->is('post')) {
            $noticias = $this->Noticias->patchEntity($noticias, $this->request->data);
            $noticias->user_id = $this->Auth->user('id');
            if ($this->Noticias->save($noticias)) {
                $this->Flash->success(__('Registro Inserido.'));
                return $this->redirect(['action' => 'edit', $noticias->id]);
            }
            $this->Flash->error(__('Não foi possível inserir registro.'));
        }
        $noticias->active = true;
        $this->list_categories();
        $this->lista_albuns();
        $this->set('noticias', $noticias);
    }

    public function edit($id = NULL) {
        $noticias = $this->Noticias->get($id, [
            'contain' => ['Albuns', 'Albuns.ImagemCapa']
        ]);
        
        if ($this->request->session()->check('noticia_id_session')){
            $this->request->session()->delete('noticia_id_session');
            return $this->redirect(['action' => 'edit/' . $id]);
        }

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
        $this->lista_albuns();
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
                ->order(['Categorias.name' => 'ASC']);
        $this->set(compact('lista_categoria'));
    }

    public function lista_albuns() {
        $albunsTable = TableRegistry::get('Albuns');
        $lista_albuns = $albunsTable
                ->find('list')
                ->where(['Albuns.user_id' => $this->Auth->user('id')])
                ->order(['Albuns.name' => 'ASC']);
        $this->set(compact('lista_albuns'));
    }    

    public function load_user($user_id = NULL) {
        $usuario = TableRegistry::get('Users')->get($user_id);
        $this->set(compact('usuario'));
    }

    public function load_categoria($category_id = NULL) {
        $categoria = TableRegistry::get('Categorias')->get($category_id);
        $this->set(compact('categoria'));
    }

    public function selecionarAlbumNoticia($noticia_id = NULL, $edit = NULL){
        $session = $this->request->session();
        $session->write('noticia_id_session', $noticia_id);
        if ($edit === NULL){
            return $this->redirect(['controller' => 'albuns', 'action' => 'index']);
        } else {
            $noticias = $this->Noticias->get($noticia_id, ['contain' => 'Albuns']);
            return $this->redirect(['controller' => 'albuns', 'action' => 'edit' . DS . $noticias->album->id]);
        }
        
    }

    public function excluirSessaoAlbumNoticia(){
        $session = $this->request->session();
        $session->delete('noticia_id_session');
        return $this->redirect($this->referer());
    }

    public function removerAlbumNoticia($id = NULL){
        $noticias = $this->Noticias->get($id);
        $noticias->gallery_id = NULL;

        $this->Noticias->save($noticias);

        return $this->redirect($this->referer());
    }    
}
