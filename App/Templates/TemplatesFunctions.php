<?php

use App\Templates\Exceptions\NoSuchTemplateException;
use App\Router\RouterRegex;



function provide($public_path){ 
    //POUR LE MOMENT:
    $Domain = DOMAIN;
    // CAR APRES ON VA UTILISER htaccess pour rederiger vers .inex.php les requests qui ne sont pas
    // des fichiers
    echo $Domain."/".$public_path;
}

function addUrlRoute($routes, $route, $parametres =[] ){
    $url_route = $routes->$route->url;
    $Domain = DOMAIN;
    return $Domain."/index.php".RouterRegex::prepareUrlFromRoute($url_route, $parametres);
}

function importTemplate($name, $parametres = 0  ,$routes = [] , $path = PATH, $ext = EXTENTHION ){
    $template = $path.'/'.$name.'.'.$ext;
    if (file_exists($template)){
        ob_start();
        require_once($template);
        echo ob_get_clean();
    }
    else
        throw new NoSuchTemplateException($name.".".EXTENTHION);
}