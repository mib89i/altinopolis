<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table {
    
    public function validationDefault(Validator $validator) {
        return $validator
            ->notEmpty('name', 'Nome requerido')
            ->notEmpty('username', 'Usuário requerido')
            ->notEmpty('password', 'Senha requerida')
            ->notEmpty('role', 'Nível de permissão requerido')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'comum']],
                'message' => 'Entre com uma permissão válida'
            ]); 
    }
}