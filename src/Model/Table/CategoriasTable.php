<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriasTable extends Table {
    public function initialize(array $config) {
        $this->table('categories');
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('name', 'Descrição Requerida'); 
    }
}