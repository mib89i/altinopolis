<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

class UsersTable extends Table {
    public function initialize(array $config) {
        $this->addBehavior('Timestamp');
        
        $this->hasMany('Categorias', [
           'className' => 'Categorias'
        ]);

        $this->hasMany('Albuns', [
           'className' => 'Albuns'
        ]);
    }

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


    public function validationPassword(Validator $validator) {
        $validator
        ->add('old_password', 'custom', [
                'rule' => function ($value, $context){
                    $user = $this->get($context['data']['id']);
                    if ($user) {
                        if ((new DefaultPasswordHasher)->check($value, $user->password)) {
                            return true; 
                        } 
                    }
                    return false;
                },
                'message' => 'A senha antiga esta incorreta!'
            ])
        ->notEmpty('old_password', 'Digite a Senha antiga para alterar!');

        $validator
        ->add('new_password', [
                'length' => [
                    'rule' => ['minLength', '3'],
                    'message' => 'Digite uma senha válida!'
                ]
            ])        
        ->add('new_password', [
                'match' => [
                    'rule' => ['compareWith', 'confirm_password'],
                    'message' => 'Nova senha não corresponde com Confirme a Senha!'
                ]
            ])
        ->notEmpty('new_password', 'Digite a nova Senha para alterar!');

        $validator
        ->add('confirm_password', [
                'length' => [
                    'rule' => ['minLength', '3'],
                    'message' => 'Digite uma senha válida!'
                ]
            ])        
        ->add('confirm_password', [
                'match' => [
                    'rule' => ['compareWith', 'new_password'],
                    'message' => 'Confime a Senha não corresponde com Nova Senha!'
                ]
            ])
        ->notEmpty('confirm_password', 'Confirme a Senha para alterar!');

        return $validator;
    }   


    public function validationPasswordAdmin(Validator $validator) {
        $validator
        ->add('new_password', [
                'length' => [
                    'rule' => ['minLength', '3'],
                    'message' => 'Digite uma senha válida!'
                ]
            ])        
        ->add('new_password', [
                'match' => [
                    'rule' => ['compareWith', 'confirm_password'],
                    'message' => 'Nova senha não corresponde com Confirme a Senha!'
                ]
            ])
        ->notEmpty('new_password', 'Digite a nova Senha para alterar!');

        $validator
        ->add('confirm_password', [
                'length' => [
                    'rule' => ['minLength', '3'],
                    'message' => 'Digite uma senha válida!'
                ]
            ])        
        ->add('confirm_password', [
                'match' => [
                    'rule' => ['compareWith', 'new_password'],
                    'message' => 'Confime a Senha não corresponde com Nova Senha!'
                ]
            ])
        ->notEmpty('confirm_password', 'Confirme a Senha para alterar!');

        return $validator;
    }   
}