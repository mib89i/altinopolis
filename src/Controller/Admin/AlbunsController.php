<?php 
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

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
        $this->set('albuns', $this->Albuns->find('all'));
    }

    public function add() {
        $album = $this->Albuns->newEntity();
        $this->request->data['Album']['name'] = '_Sem Nome_';
        $album = $this->Albuns->patchEntity($album, $this->request->data);
        if ($this->Albuns->save($album)) {
            $this->Session->setFlash(__('Digite um nome para o Álbum!'));
            return $this->redirect(array('action' => 'edit' . DS . $this->Albuns->id));
        }

        $this->Flash->error(__('Não foi possível salvar Álbum.'));
    }

    public function edit($id = NULL){
        $this->Album->id = $id;
        if (!$this->Album->exists()) {
            $this->Session->setFlash(__('Álbum não existe!'));
            return $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Album->save($this->request->data)) {

                $this->__upload($this->Album);

                $this->Session->setFlash(__('Álbum atualizado com Sucesso! '));
                return $this->redirect(array('action' => 'edit' . DS . $this->Album->id));
            }
            $this->Session->setFlash(
                    __('Erro ao atualizar Álbum, tente novamente.')
            );
        } else {
            $this->request->data = $this->Album->read(null, $id);
            $this->set('album', $this->request->data);
        }
    }

    public function __upload($album = NULL) {
        $folder = new Folder();
        $dir = NULL;
        if (!$folder->create('img' . DS . 'albuns'. DS . $album->id)) {
            return false;
        }

        if (!empty($this->request->data['Album']['filename'][0]['size'])) {
        //if (!empty($_FILES)) {
            $dir = 'img' . DIRECTORY_SEPARATOR . 'albuns' . DIRECTORY_SEPARATOR . $album->id;
            $dir = WWW_ROOT . $dir . DS;

            foreach ($this->request->data['Album']['filename'] as $file) {
                $info =  pathinfo($file['name']);
                $filename = md5($file['name']);
                $filename = $filename . '.'. $info['extension'];
            
                $this->request->data['Album']['Imagem']['gallery_id'] = $album->id;
                $this->request->data['Album']['Imagem']['name'] = $filename;
                $file['name'] = $filename;

                $this->Album->Imagem->create();

                $this->Album->Imagem->crop_image($file, $dir);

                if (!$this->Album->Imagem->save($this->request->data['Album']['Imagem'])) {
                    $this->Session->setFlash(__('Não foi possível salvar Imagem no Banco!'));
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

}