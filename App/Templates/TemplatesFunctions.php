<?php
use App\Router\RouterRegex;
function provide($public_path){ 
    $Domain = "http://home.cenima/";
    echo $Domain.$public_path;
}

function addUrlRoute($routes, $route, $parametres =[] ){
    $url_route = $routes->$route->url;
    echo RouterRegex::prepareUrlFromRoute($url_route, $parametres);
}

