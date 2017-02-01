<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Imagem extends Entity {
    
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    public $belongsTo = array('Gallery');
    
    public function crop_image($image, $path_name){
   		App::import('Vendor', 'WideImage/WideImage');  
  
        $img = WideImage::load($image['tmp_name']);    
  
        $min = $img->resize(200,200,'outside');    
        $min = $min->crop('50%-100','50%-100',200,200);  
  
        $min_slide = $img->crop('center','center', 700, 400);  

        $min->saveToFile($path_name.'thumb_'.$image['name']);  
  
        $min_slide->saveToFile($path_name.'thumb_slide_'.$image['name']); 
    }

    public function delete_images($imagem){
        $file = new File('img/albuns/'.$imagem['Gallery']['id'].'/'.$imagem['Imagem']['name']);
        $file_thumb = new File('img/albuns/'.$imagem['Gallery']['id'].'/thumb_'.$imagem['Imagem']['name']);

        $file_thumb_slide = new File('img/albuns/'.$imagem['Gallery']['id'].'/thumb_slide_'.$imagem['Imagem']['name']);

        if (!$file->delete() || !$file_thumb->delete() || !$file_thumb_slide->delete()) {
            return false;
        }else{
            return true;
        }
    }

    public function drop_images($path_name){
        $file = new File(WWW_ROOT . $path_name . $image['name']);
        if($file->delete()) {
           
        } 

        $file = new File($path_name.WWW_ROOT . 'thumb_'. $image['name']);
        if($file->delete()) {
           
        }

        $file = new File($path_name.WWW_ROOT . 'thumb_slide_'. $image['name']);
        if($file->delete()) {
           
        }
    }
}