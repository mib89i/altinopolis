<?php

namespace App\Controller;

use App\Controller\AppController;
use \Cake\ORM\TableRegistry;

class HomeController extends AppController {

    public function index() {
         $this->Auth->allow(['index']);
        $this->list_users();
    }

    public function list_users() {
        $query = TableRegistry::get('Users');
        $lista_usuarios = $query
                ->find('all')
                ->where(['active' => true])
                ->order(['Users.name' => 'ASC']);
        $this->set(compact('lista_usuarios'));
    }

}
