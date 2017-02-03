<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Album extends Entity {
    
    protected $_accessible = [
        '*' => true
    ];
/*
    protected $_dirty = [
        'picture_id' => true
    ];
    */
}