<?php
/**
 * This file is a part of this mini framwork
 * This class is a par of the router of this mini framwork 
 * 
 * 
 * 
 * the handling with the bad definitions is almoste done  !!!!!!!!!
 * 
 * 
 * 
 */
namespace App\Router;

use App\Router\Exceptions\BadUrlDefinitionException;
use App\Router\Exceptions\BadTypeOfUrlParametreException;



class RouterRegex{

    public static function CheckBalancedParentheses($expression, $depth)
    {
        $len = strlen($expression);
        $stack = array();
        for( $i = 0; $i < $len; $i++){
            $letter =  substr($expression , $i,1);
            if ( $letter == "{"){
                if (count($stack) == $depth) return false;
                array_push($stack, $letter);
            }
            if ( $letter == "}"){
                if (count($stack) == 0) return false;
                array_pop($stack);
            }
        }
        if (count($stack) != 0) return false;
        return true;
    }

    private static function preg_callable($matches)
    {
        if($matches[1] == "n") return "([0-9]+)";
        elseif($matches[1] == "a") return "([A-Za-z]+)"; 
        elseif($matches[1] == "an") return "([0-9A-Za-z]+)"; 
        elseif($matches[1] == "ant") return "([0-9A-Za-z_-]+)"; 
        else throw new \Exception($matches[1]); 
    }

    private static function checkBadUrlDefinition($url_route)
    {
        //check bad url definition : 
        if( $url_route ==""  or !RouterRegex::CheckBalancedParentheses($url_route, 1)
        or preg_match("#{:?}#",$url_route)
        or preg_match("#{[^:]+}#",$url_route) 
        or preg_match("#{(.|[ ])+:}#",$url_route) 
        or preg_match("#{:(.|[ ])+}#",$url_route)){
            throw new BadUrlDefinitionException($url_route);
        }
    } 

    /**
     * Extract the parametres's names from the route url if there are and put them in $parametresNames 
     * prepare the regular expression of route url to match with url
     */    
    public static function prepareRegexAndGetparametresNames($url_route)
    {
        RouterRegex::checkBadUrlDefinition($url_route);
        //parametres names if there are
        $parametresNames = array();
        preg_match_all("#\{[a-z]+:([a-zA-z0-9_-]+)\}#i",$url_route, $parametresNames);
        if ( isset($parametresNames[1])){
            $parametresNames = $parametresNames[1];   
        }
        //it the route url contains a parametre definition so mybe the type is not defined 
        //the callable throw Exception to infome us about the bad type so we need to throw a BadTypeOfUrlParametreException
        try{
            
            $callable = array(__CLASS__, 'preg_callable');
            $url_routeRegex = preg_replace_callback("#\{([a-z]+):([a-zA-z0-9_-]+)\}#i", $callable, $url_route);
        }
        catch(\Exception $e){
            throw new BadTypeOfUrlParametreException($e->getMessage(), $url_route);
        }
        if ( $url_routeRegex )
        {
            $prepared = array(
                "regex" => "#^".$url_routeRegex."$#",
                "parametresNames" => $parametresNames
            );
            return $prepared; 
        }
        return false;
    }

    public static function matchUrlAndGetParametresValues($regex_url, $url,$parametresNames)
    {
        $Values = array();
        $nameValues = array();
        if (preg_match($regex_url, $url, $Values) )
        {
            //index 0 for all the url remembre $0 for all expression
            //maybe the values in the url are not compatible with the types in url route in this case
            //count($values) = 0;
            //so if $nameValues are empthy the url doesn't macth
            for( $i=1; $i< count($Values); $i++){
                $nameValues[ $parametresNames[$i-1] ] = $Values[$i] ;
            }
            return $nameValues;
        }
        return false;
    }
    public static function matchUrl($regex_url, $url)
    {
        if (preg_match($regex_url, $url)) return true;
        return false;
    }
    
    public static function prepareUrlFromRoute($url_route,$parametresValues)
    {
        RouterRegex::checkBadUrlDefinition($url_route);
        //parametres names if there are
        $parametresNames = array();
        preg_match_all("#\{[a-z]+:([a-zA-z0-9_-]+)\}#i",$url_route, $parametresNames);
        if ( isset($parametresNames[1])){
            $parametresNames = $parametresNames[1];   
        }
        if (array_keys($parametresValues) != $parametresNames)
        {
            throw new \Exception("parametres's names doesn't match"); //à définir 
        }
        try{
            $callable = function ($matches) use ($parametresValues){
                if( ($matches[1] == "n" and !preg_match("#^([0-9]+)$#",$parametresValues[$matches[2]]) )
                    or ($matches[1] == "a" and !preg_match("#^([A-Za-z]+)$#",$parametresValues[$matches[2]]) )
                    or ($matches[1] == "an" and !preg_match("#^([0-9A-Za-z]+)$#",$parametresValues[$matches[2]]) )
                    or ($matches[1] == "ant" and !preg_match("#^([0-9A-Za-z_-]+)$#",$parametresValues[$matches[2]]) ) )
                    throw new \Exception($matches[1]); 
                else 
                    return $parametresValues[$matches[2]];
                    
            };
            return preg_replace_callback("#\{([a-z]+):([a-zA-z0-9_-]+)\}#i", $callable, $url_route);
        }
        catch(\Exception $e){
            echo ("type ".$e->getMessage());
        }
    }
}
