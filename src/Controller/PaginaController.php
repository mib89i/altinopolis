<?php

namespace App\Controller;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class PaginaController extends AppController {
    
    public function beforeFilter(Event $event) {
        $this->Auth->allow(['index']);
        $this->Auth->allow(['parceiros']);
        $this->Auth->allow(['sobre']);
        parent::beforeFilter($event);
    }

    public function isAuthorized($user) {
        return true;
    }    

    public function index() {
        $this->set('title', 'Páginas');
        $this->set('meta_description', 'Páginas');
        $this->set('meta_keyworks', 'paginas');
        $this->Auth->allow(['index']);        
    }

    public function parceiros() {
        $this->set('title', 'Parceiros');
        $this->set('meta_description', 'Parceiros');
        $this->set('meta_keyworks', 'Parceiros');
    }
    
    public function sobre() {
        $this->set('title', 'Sobre');
        $this->set('meta_description', 'Sobre');
        $this->set('meta_keyworks', 'Sobre');
    }

}