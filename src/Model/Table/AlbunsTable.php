<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AlbunsTable extends Table {
    public function initialize(array $config) {
        $this->table('galleries');
        $this->entityClass('App\Model\Entity\Album');
    }
}