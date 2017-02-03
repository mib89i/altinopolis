<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ImagensTable extends Table {
    public function initialize(array $config) {
        $this->table('pictures');
        $this->entityClass('App\Model\Entity\Imagem');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Albuns', [
        	'foreignKey' => 'gallery_id',
        	'propertyName' => 'album'
        	]
        );
    }
}