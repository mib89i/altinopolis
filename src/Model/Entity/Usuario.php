<?php 

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

class Usuario extends Entity {
    // Make all fields mass assignable except for primary key field "id".
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    protected function _setPassword($password) {
        return (new DefaultPasswordHasher)->hash($password);
    }
}