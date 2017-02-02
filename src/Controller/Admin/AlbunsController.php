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
        $this->set('lista_albuns', $this->Albuns->find('all'));
    }

    public function add() {
        $album = $this->Albuns->newEntity();
        $album = $this->Albuns->patchEntity($album, $this->request->data);
        $album->name = '_Sem Nome_';

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
    public function edit($id = NULL){
        $album = $this->Albuns->get($id);
        if ($this->request->is(['post', 'put'])) {
            $album = $this->Albuns->patchEntity($album, $this->request->data);
            if ($this->Albuns->save($album)) {

                $this->__upload($album);

                $this->Flash->success(__('Álbum atualizado com Sucesso!'));
                return $this->redirect(array('action' => 'edit' . DS . $album->id));
            }
            $this->Session->setFlash(
                    __('Erro ao atualizar Álbum, tente novamente.')
            );
        }
        $this->set(compact('album'));

        $lista_imagens = $this->Albuns->Imagens->find('all');
        
        $this->set(compact('lista_imagens'));
    }

    public function __upload($album = NULL) {
        $imagensTable = TableRegistry::get('Imagens');
        $folder = new Folder();
        $dir =  WWW_ROOT .'img' . DS . 'albuns' . DS . $album->id;
        
        if (!$folder->create($dir)) {
            return false;
        }

        if (!empty($album->uploaded_file[0]['size'])) {
            //foreach ($this->request->data['filename'] as $file) {
            foreach ($album->uploaded_file as $file) {
                $info =  pathinfo($file['name']);
                $filename = md5($file['name']);
                $filename = $filename . '.'. $info['extension'];
            
                $imagem = $imagensTable->newEntity();

                $imagem->name = $filename;
                $imagem->gallery_id = $album->id;

                $imagem->crop_image($file, $dir . DS);

                if (!$imagensTable->save($imagem)) {
                    $this->Flash->error(__('Não foi possível salvar Imagem no Banco!'));
                    return $this->redirect(array('action' => 'edit' . DS . $this->Album->id));
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
            //$this->request->onlyAllow('post');

            $imagem = $imagensTable->get($id);
            $album = $albunsTable->get($imagem->gallery_id);

            // SE A IMAGEM FOR DE CAPA, ATUALIZA PARA NULL
            if ($album->picture_id == $imagem->id){
                $album->picture_id = NULL;
                $albunsTable->save($album);
            }

            $imagem_delete = $imagem->delete_images($imagem);

            if (!$imagem_delete){
                $this->Flash->error(__('Imagem do Álbum não foi deletada!'));
                return $this->redirect(array('action' => 'edit/'.$imagem->gallery_id));
            }

            if (!$imagensTable->delete($imagem)){
                $this->Flash->error(__('Não foi possível deletar essa Imagem!'));
                return $this->redirect(array('action' => 'edit/'.$imagem->gallery_id));
            }
            
            $this->Flash->success(__('Imagem deletada!'));
            return $this->redirect(array('action' => 'edit/'.$imagem->gallery_id));
        }
    } 

    public function admin_capa_img($id = NULL) {
        $this->layout = 'default_admin';

        $this->Album->Imagem->id = $id;
        
        if (!$this->Album->Imagem->exists()) {
            $this->Session->setFlash(__('Imagem não existe!'));
            return $this->redirect(array('action' => 'index'));
        }

        $imagem = $this->Album->Imagem->read();
        $this->Album->id = $imagem['Gallery']['id'];
        $album = $this->Album->read();

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->request->onlyAllow('post');
            
            $album['Album']['picture_id'] = $id;

            $this->Album->create();

            if ($this->Album->save($album['Album'])) {
                $this->Session->setFlash(__('Imagem de Capa Alterada!'));
                return $this->redirect(array('action' => 'edit' . DS . $album['Album']['id']));
            }

            $this->Session->setFlash(__('Erro ao Alterar Álbum, tente novamente!'));
            return $this->redirect(array('action' => 'edit' . DS . $album['Album']['id']));
        }
    }  


}