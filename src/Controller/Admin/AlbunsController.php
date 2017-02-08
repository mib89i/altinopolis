<?php 
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

use Cake\ORM\TableRegistry;

class AlbunsController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);

        $session = $this->request->session();
        $session->write('link_actived', 'albuns');
    }

    public function isAuthorized($user) {
        return true;
    }

    public function index() {
        if ($this->Auth->user('role') === 'comum'){
            $this->set('lista_albuns', $this->Albuns->find('all')
                ->where(['Albuns.user_id' => $this->Auth->user('id')])
                ->order(['Albuns.created' => 'ASC'])
                ->contain(['ImagemCapa'])
            );
        } else {
            $usersTable = TableRegistry::get('Users');
            
            $this->set('lista_albuns_user', $usersTable->find('all')
                ->order(['Users.name' => 'ASC'])
                ->contain(['Albuns', 'Albuns.ImagemCapa'])
            );
            /*
            $this->set('lista_albuns', $this->Albuns->find('all')
                ->order(['Albuns.created' => 'ASC'])
                ->contain(['ImagemCapa'])
            );
            */    
        }
    }

    public function add($user_id = NULL) {
        $album = $this->Albuns->newEntity();
        $album = $this->Albuns->patchEntity($album, $this->request->data);
        $album->name = '_Sem Nome_';

        if ($user_id === NULL){
            $album->user_id = $this->Auth->user('id');
        } else {
            $album->user_id = $user_id;
        }
        

        if ($this->Albuns->save($album)) {
            $this->Flash->success(__('Digite um nome para o Álbum!'));
            return $this->redirect(array('action' => 'edit' . DS . $album->id));
        }

        $this->Flash->error(__('Não foi possível salvar Álbum.'));
    }
    /*
    -- OUTRA FORMA DE SALVAR QUE FUNCIONA!
    public function add() {
        -- use Cake\ORM\TableRegistry;
        $albunsTable = TableRegistry::get('Albuns');
        $album = $albunsTable->newEntity();
        $album->name = '_Sem Nome_';

        if ($albunsTable->save($album)) {
            $this->Flash->success(__('Digite um nome para o Álbum!'));
            return $this->redirect(array('action' => 'edit' . DS . $album->id));
        }

        $this->Flash->error(__('Não foi possível salvar Álbum.'));
    }
    */
    public function editGeneric($id = NULL){
        if ($this->request->session()->check('noticia_id_session')){
            $this->atualizaAlbumNoticia(true, $id);
        } else {
            return $this->redirect(['action' => 'edit' . DS . $id]);
        }
    }

    public function atualizaAlbumNoticia($redirect = false, $id_album = NULL){
        $noticiasTable = TableRegistry::get('Noticias');
        $noticia_session = $noticiasTable->get($this->request->session()->read('noticia_id_session'));
        $noticia_session->gallery_id = $id_album;
        $noticiasTable->save($noticia_session);
        if ($redirect){
            $this->request->session()->delete('noticia_id_session');
            return $this->redirect(['controller' => 'noticias', 'action' => 'edit' . DS . $noticia_session->id]);
        }
    }

    public function edit($id = NULL){
        $album = $this->Albuns->get($id, [
            'contain' => ['Imagens', 'ImagemCapa']
        ]);

        if ($this->request->is(['post', 'put'])) {
            $album = $this->Albuns->patchEntity($album, $this->request->data);
            if ($this->Albuns->save($album)) {

                $this->__upload($album);

                $this->Flash->success(__('Álbum atualizado com Sucesso!'));
                //return $this->redirect(array('action' => 'edit' . DS . $album->id));
                if ($this->request->session()->check('noticia_id_session')){
                    $this->atualizaAlbumNoticia(false, $album->id);
                }
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('Erro ao atualizar Álbum, tente novamente.'));
        }


        $this->set(compact('album'));
        $lista_imagens = $album->imagens;
        /*
        $lista_imagens = $this->Albuns->Imagens->find()->contain([
            'Albuns',
        ]);;
        */
        $this->set(compact('lista_imagens'));
    }


    public function delete($id = NULL) {
        $album = $this->Albuns->get($id, [
            'contain' => ['Imagens']
        ]);

        if ($this->request->is(['post', 'delete'])) {

            $lista_imagens =  $album->imagens;

            foreach ($lista_imagens as $imagem) {
                                
                if (!$this->Albuns->Imagens->delete($imagem)){
                    $this->Flash->error(__('Não foi possível deletar essa Imagem!'));
                    return $this->redirect(array('action' => 'index'));
                }
            }

            $drop_folder = $album->delete_gallery($album->id);

            if (!$drop_folder) {
            //    $this->Session->setFlash(__('Pasta do Álbum não foi deletada!'));
            //    return $this->redirect(array('action' => 'index'));
            }

            if ($this->Albuns->delete($album)) {
                $this->Flash->success(__('Álbum deletado!'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }    


    public function __upload($album = NULL) {
        $imagensTable = TableRegistry::get('Imagens');
        $albunsTable = TableRegistry::get('Albuns');

        $folder = new Folder();
        $dir =  WWW_ROOT .'img' . DS . 'albuns' . DS . $album->id;
        
        if (!$folder->create($dir)) {
            return false;
        }

        if (!empty($album->uploaded_file[0]['size'])) {
            foreach ($album->uploaded_file as $file) {
                // FILE NAME
                $info =  pathinfo($file['name']);
                $filename = md5($file['name']);
                $filename = $filename . '.'. $info['extension'];
                $file['name'] = $filename;
                // ---
                $imagem = $imagensTable->newEntity();

                $imagem->name = $filename;
                $imagem->gallery_id = $album->id;

                $imagem->crop_image($file, $dir . DS);

                if (!$imagensTable->save($imagem)) {
                    $this->Flash->error(__('Não foi possível salvar Imagem no Banco!'));
                    return $this->redirect(array('action' => 'edit' . DS . $album->id));
                }
                
                if ($album->picture_id == NULL){
                    $album->picture_id = $imagem->id;

                    if (!$albunsTable->save($album)) {
                        $this->Flash->error(__('Não foi possível salvar Imagem no Banco!'));
                        return $this->redirect(array('action' => 'edit' . DS . $album->id));
                    }
                }
                

                $tempPath = $file['tmp_name'];
                $uploadPath = $dir . DIRECTORY_SEPARATOR . $filename;
                move_uploaded_file($tempPath, $uploadPath);
            }
        } else {
            return false;
        }
    }


    public function deleteImg($id = NULL) {
        $imagensTable = TableRegistry::get('Imagens');
        $albunsTable = TableRegistry::get('Albuns');

        if ($this->request->is(['post', 'delete'])) {
            $imagem = $imagensTable->get($id);
/*
            $album = $albunsTable->find()->contain([
                'Imagens' => function ($q){

                }
            ])->first();
                
 */
            $imagem_delete = $imagem->delete_images($imagem);

            if (!$imagem_delete){
                $this->Flash->error(__('Imagem do Álbum não foi deletada!'));
                return $this->redirect(array('action' => 'edit/'.$imagem->gallery_id));
            }

            if (!$imagensTable->delete($imagem)){
                $this->Flash->error(__('Não foi possível deletar essa Imagem!'));
                return $this->redirect(array('action' => 'edit/'.$imagem->gallery_id));
            }

            $album = $albunsTable->get($imagem->gallery_id, [
                'contain' => 'Imagens'
            ]);

            // SE A IMAGEM FOR DE CAPA, ATUALIZA PARA NULL
            if ($album->picture_id == $imagem->id){
                if (!empty($album->imagens)) {
                    $album->picture_id = $album->imagens[0]['id'];
                } else {
                    $album->picture_id = NULL;
                }

                $albunsTable->save($album);
            }

            $this->Flash->success(__('Imagem deletada!'));
            return $this->redirect(array('action' => 'edit/'.$imagem->gallery_id));
        }
    } 

    public function capaImg($id = NULL) {
        $imagensTable = TableRegistry::get('Imagens');
        $albunsTable = TableRegistry::get('Albuns');

        if ($this->request->is(['post', 'put'])) {
            $imagem = $imagensTable->get($id);

            $album = $albunsTable->get($imagem->gallery_id);

            $album->picture_id = $imagem->id;

            if (!$albunsTable->save($album)) {
                $this->Flash->error(__('Não foi possível definir Capa de Álbum!'));
                return $this->redirect(array('action' => 'edit' . DS . $album->id));
            }

            $this->Flash->success(__('Álbum Atualizado!'));
            return $this->redirect(['action' => 'edit' . DS . $album->id]);
        }
    }  


    public function selecionaCapaImg($id = NULL) {
        if ($this->request->is(['post', 'put'])) {
            $imagensTable = TableRegistry::get('Imagens');
            $imagem = $imagensTable->get($id);

            $session = $this->request->session();
            $session->write('imagem_capa_selecionada', $imagem);
            //return $this->redirect(['action' => 'edit' . DS . 50]);
            //$this->set('imagem_capa_selecionada', $imagem);
        }
    }  
}