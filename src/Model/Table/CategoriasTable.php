<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriasTable extends Table {

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('descricao', 'Descrição requerida'); 
    }
}