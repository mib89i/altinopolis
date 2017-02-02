<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;

class PainelController extends AppController {

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        
        $this->Auth->deny(['index']);

        $session = $this->request->session();
        $session->write('link_actived', 'painel');
    }

    public function isAuthorized($user) {
        return true;
    }
   
    public function index() {
        
    }

}
