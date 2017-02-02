<?php 
namespace App\View\Helper;

use Cake\View\Helper;

class StringsHelper extends Helper {
	public function abreviar($text, $limit) {
        $size = strlen( $text );

        if ($size > $limit) {
            return substr ($text, 0, $limit) . '...';
        } else {
            return $text;
        }
    }  
}