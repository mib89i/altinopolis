<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Categoria extends Entity {
    
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}