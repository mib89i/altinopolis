<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

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
        return $validator->notEmpty('name', 'Descrição Requerida');
    }

    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->isUnique(array('name'), 'Esta categoria já existe!'));
        return $rules;
    }

}
