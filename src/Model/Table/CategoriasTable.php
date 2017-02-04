<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class CategoriasTable extends Table {

    public function initialize(array $config) {
        $this->table('categories');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users',[
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);
        
        $this->displayField('name');
      
    }

    public function validationDefault(Validator $validator) {
        return $validator
                        ->notEmpty('name', 'Descrição Requerida');
    }

}
