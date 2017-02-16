<?php

namespace App\Controller;

use App\Controller\AppController;
use \Cake\ORM\TableRegistry;

class HomeController extends AppController {

    public function index() {
        $this->set('title', 'Cidade de Altinópolis');
        $this->set('meta_description', 'Cidade de Altinópolis');
        $this->set('meta_keyworks', 'cidade, altinopolis');
        $this->Auth->allow(['index']);
        $this->lista_destaques();
        $this->lista_destaques_img();
        $this->lista_noticias();
        $this->lista_users();
    }

    public function lista_users() {
        $query = TableRegistry::get('Users');
        $lista_usuarios = $query
                ->find('all')
                ->where(['active' => true])
                ->order(['Users.name' => 'ASC']);

        $this->set(compact('lista_usuarios'));
    }

    public function lista_destaques() {
        $query = TableRegistry::get('Noticias');
        $lista_destaques = $query
                ->find('all')
                ->where(['Noticias.active' => true])
                ->andWhere(['Noticias.main' => true])
                ->andWhere(['Noticias.gallery_id IS NULL'])
                ->limit(3)
                ->order(['Noticias.schedule' => 'DESC']);

        $this->set(compact('lista_destaques'));
    }

    public function lista_destaques_img() {
        $query = TableRegistry::get('Noticias');
        $lista_destaques_img = $query
                ->find('all')
                ->where(['Noticias.active' => true])
                ->andWhere(['Noticias.main' => true])
                ->andWhere(['Noticias.gallery_id IS NOT NULL'])
                ->limit(4)
                ->contain(['Albuns', 'Albuns.ImagemCapa'])
                ->order(['Noticias.schedule' => 'DESC']);
        $this->set(compact('lista_destaques_img'));
    }

    public function lista_noticias() {
        $query = TableRegistry::get('Noticias');
        $lista_noticias = $query
                ->find('all')
                ->where(['Noticias.active' => true])
                ->andWhere(['Noticias.main' => false])
                ->limit(12)
                ->order(['Noticias.schedule' => 'DESC'])
                ->contain(['Albuns', 'Albuns.ImagemCapa']);
        $this->set(compact('lista_noticias'));
    }

}
