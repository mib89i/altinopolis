<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NoticiasTable extends Table {
    public function initialize(array $config) {
        $this->table('news');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('name', 'Descrição Requerida'); 
    }
}