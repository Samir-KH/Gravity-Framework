<?php
/**
 * This file is a part of this mini framwork
 * This class is the kernel of this mini framwork in another word the core
 * 
 */
namespace App\Configuration;

    /**
     * this class is use in the configurations's class for a component to get the content of configurations's files
     * first declare $component, $exthension
     */

class Config{


    public static function getContent($component, $file, $exthension)
    {
        $file = dirname(dirname(__DIR__)).'/config/'.$component.'/'.$file.'.'.$exthension;
         
        $content = file_get_contents($file);

        return $content;
    }

}