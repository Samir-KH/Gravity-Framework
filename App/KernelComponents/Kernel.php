<?php
/**
 * This file is a part of this mini framwork
 * This class is a part of of this mini framwork in another word the core
 * 
 */
namespace App\KernelComponents;



use \Exception;
use App\Router\Router;
use App\Resolver\JsonResolver;
use App\KernelComponents\Exceptions\FailedToExecuteMethodException;
use App\KernelComponents\Exceptions\FailedToLoadControllerException;
use App\KernelComponents\Exceptions\ControllerMustReturnResponseException;
use App\KernelComponents\Exceptions\UrlNotMatchException;
use App\Configuration\RouterConfig;
use App\Configuration\DataBaseConfig;
use App\DataBase\DataBaseConnectorManager;



class Kernel{

    private $JsonResolver;

    private $router;

    public function __construct()
    {
        $this->JsonResolver = new JsonResolver();
        $this->router = new Router();
    }

    private function getRoutes()
    {
        $routesContent = RouterConfig::getRoutesContent();
        $this->JsonResolver->prepare($routesContent, RouterConfig::$routes);
        return $this->JsonResolver->resolve();
    }
    private function getDatabases()
    {
        $dataBasesContent = DataBaseConfig::getRoutesContent();
        $this->JsonResolver->prepare($dataBasesContent, DataBaseConfig::$databases);
        return $this->JsonResolver->resolve();
    }
    function handleAndThrowExceptions($request)
    {
        $url = $request->getRequestUrl();
        $method = $request->getRequestMethod();
        $routes = $this->getRoutes();
        $this->router->prepare($method, $url, $routes);

        if ($this->router->urlHandle()){
            $result = $this->router->getResult();
            $databases = $this->getDatabases();
            $connectrorManager = new DataBaseConnectorManager($databases);
            $controller = $this->loadController($result["controller"],$request, $routes,$connectrorManager);
            $response = $this->executeController($controller, $result["method"],$result["parametres"]);

            if( gettype($response)!="object" or( get_parent_class($response) != "App\HttpComponents\Response" and get_class($response) != "App\HttpComponents\Response" ))
              throw new ControllerMustReturnResponseException($controller, $result["method"] ); 
            return $response;   
        }
        throw new UrlNotMatchException();
    }

    public function loadController($controller_name, $request, $routes,$connectrorManager)
    {
        try{
            $class = 'Controller\\'.$controller_name;
            return new $class($request, $routes,$connectrorManager,$connectrorManager);
        }
        catch (Exception $e ){
           throw new FailedToLoadControllerException($controller_name);
        }
    }

    public function executeController($controller, $method, $parametres)
    {
            $result = \call_user_func_array(array($controller,$method), $parametres);    
            if(!$result)
                throw new FailedToExecuteMethodException($controller, $method);
            return $result;
    }

    public function handle($request)
    {
        $array_callabe = array($this, "handleAndThrowExceptions");
        return KernelExceptionsHandler::run($array_callabe, array($request));
    }
}