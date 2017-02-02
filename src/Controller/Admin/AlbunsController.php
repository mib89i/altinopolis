<?php 
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

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

        $imagens = $this->Albuns->Imagens->find('all');
        echo debug($imagens);

        $this->set(compact('imagens'));
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