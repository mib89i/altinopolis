<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Filesystem\Folder;

class Album extends Entity {

	protected $_accessible = [
	    '*' => true
	];

    public function delete_gallery($album_id){
  		$folder = new Folder('img/albuns/' . $album_id);

		if (!$folder->delete()){
		    return false;
		} else {
		    return true;
		}

} /*
protected $_dirty = [
    'picture_id' => true
];
*/
}