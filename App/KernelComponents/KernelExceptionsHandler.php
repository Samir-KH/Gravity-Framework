<?php
/**
 * This file is a part of this mini framwork
 * This class is a part of of this mini framwork in another word the core
 * 
 */
namespace App\KernelComponents;

use \Exception;
use App\HttpComponents\Response;

class KernelExceptionsHandler{


    public static function run ($array_callabe, $parametres){
        try{
            return \call_user_func_array($array_callabe, $parametres);
        }
        catch(Exception $e){
            $re = new Response ($e->getMessage());
            return $re;
        }
    }

}