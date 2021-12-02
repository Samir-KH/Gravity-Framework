<?php
/**
 * this file is a part of this mini framwork
 * 
 * this class manage the templates.
 * 
 */
namespace App\Templates ;

use \Exception;
use App\Templates\Exceptions\NoSuchTemplateException;



define('PATH', dirname(__DIR__, 2)."/templates") ;
define("EXTENTHION",'php');


class TemplatesManager{

    
    
    
    public static function getTemplateContent($name, $parametres,$routes)
    {
        // you can use parametres in templates files
        require_once "TemplatesFunctions.php";
        $template = PATH.'/'.$name.'.'.EXTENTHION;
        if (file_exists($template)){
            ob_start();
            require_once($template);
            return ob_get_clean();
        }
        throw new NoSuchTemplateException($name.".".EXTENTHION);
    }
    
}
