<?php 

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

require_once(ROOT . DS . 'vendor' . DS . "WideImage" . DS . "WideImage.php");
use WideImage;

class Imagem extends Entity {
    
    protected $_accessible = [
        '*' => true
    ];

    public function crop_image($image, $path_name){
   		//App::import('Vendor', 'WideImage/WideImage');  
        //Plugin::load('WideImage/WideImage');

        $img = WideImage::load($image['tmp_name']);    
  
        $min = $img->resize(200,200,'outside');    
        $min = $min->crop('50%-100','50%-100',200,200);  
  
        $min_slide = $img->crop('center','center', 700, 400);  

        $min->saveToFile($path_name.'thumb_'.$image['name']);  
  
        $min_slide->saveToFile($path_name.'thumb_slide_'.$image['name']); 
    }

    public function delete_images($imagem){
        $file = new File(WWW_ROOT . 'img/albuns/' . $imagem->gallery_id . '/' . $imagem->name);
        $file_thumb = new File(WWW_ROOT . 'img/albuns/' . $imagem->gallery_id . '/thumb_' . $imagem->name);
        $file_thumb_slide = new File(WWW_ROOT . 'img/albuns/' . $imagem->gallery_id . '/thumb_slide_' . $imagem->name);
        
        if ($file->exists() && !$file->delete()){
            return false;
        }

        if ($file_thumb->exists() && !$file_thumb->delete()){
            return false;
        }

        if ($file_thumb_slide->exists() && !$file_thumb_slide->delete()){
            return false;
        }

        return true;
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