<?php
/**
 * This file is a part of this mini framwork
 * This class is the kernel of this mini framwork in another word the core
 * 
 */
namespace App\Resolver;

use App\Resolver\Exceptions\JsonResolverException;

class JsonResolver {

    private $jsonContent;
    private $config_name;

    public function prepare( $jsonContent, $config_name)
    {
        $this->jsonContent = $jsonContent;
        $this->config_name = $config_name;
    }
    
    public function resolve()
    {
        try{
            $content = json_decode($this->jsonContent);
            return $content;
        }
        catch(Exception $e){
            throw new JsonResolverException($config_name);
        }   
    }

}