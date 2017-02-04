<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class NoticiasTable extends Table {
    public function initialize(array $config) {
        $this->table('news');
        $this->primaryKey('id');
        
        $this->belongsTo('Users',[
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);        
    }

    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('title', 'Título requerido!') 
            ->notEmpty('title', 'Subtítulo requerido!')
            ->notEmpty('text', 'Texto requerido!'); 
    }
}