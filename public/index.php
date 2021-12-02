<?php 

use App\KernelComponents\Kernel;
use App\HttpComponents\Request;
use App\Router\RouterRegex;
require_once  dirname(__DIR__).'/App/autoloader/Autoload.php' ;


$request = Request::createFromGlobales();

$kernel = new Kernel();
$response =  $kernel->handle($request);
$response->send();
