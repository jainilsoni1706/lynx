<?php

namespace Lynx\System\Routes;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Exception\LynxException;
use Lynx\System\Request\Request;
use App\Middleware\Handler;

class Route{

    public $routeArray = [];

    protected static $_instance;

    protected $instance_key;

    protected $instance_key_old;

    public function __construct()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->instance_key = uniqid();        
    }

    public static function getInstance()
    {
        $class = get_called_class();

        if(!isset(self::$_instance))
        {
            self::$_instance = new $class;
        }

        return self::$_instance;
    }

    public static function collection($callableFunction)
    {
        if (!is_callable($callableFunction)) {
            throw new LynxException("LYNX788: Expected function passed ".gettype($callableFunction).".",'Lynx/Component/SyntaxException', 788);
        }

        $callableFunction(self::getInstance());

        return self::getInstance();
    }    

    public function get()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = [func_get_args(), 'GET'];

        return $this;
    }

    public function post()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = [func_get_args(), "POST"];

        return $this;
    }

    public function put()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = [func_get_args(), "PUT"];

        return $this;
    }

    public function delete()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = [func_get_args(), 'DELETE'];

        return $this;
    }

    public function any()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = [func_get_args(), "ANY"];

        return $this;
    }

    public function method($method)
    {
        if (!is_string($method)) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['method'] = $method;

        return $this;
    }

    public function alias($name)
    {
        if (!is_string($name)) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['alias'] = $name;

        return $this;
    }

    public function params()
    {

        $params = func_get_args();

        if (empty($params)) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['params'] = $params;

        return $this;
    }

    public function end()
    {
        $this->instance_key_old = $this->instance_key;        
        $this->instance_key = uniqid();        

        return;
    }

    public function terminate()
    {
        $this->instance_key_old = $this->instance_key;        
        $this->instance_key = uniqid();        

        return;
    }

    public function prefix($prefix)
    {
        if (!is_string($prefix)) {
            throw new LynxException("LYNX788: Expected string passed ".gettype($prefix).".",'Lynx/Component/SyntaxException', 788);            
        }

        $this->routeArray[$this->instance_key_old]['prefix'] = $prefix;

        return $this;
    }

    public function middleware()
    {

        $middlewares = func_get_args();

        if (empty($middlewares)) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key_old]['middlewares'] = $middlewares;

        return $this;
    }

    public function of($class)
    {
        if (!class_exists($class)) {
            throw new LynxException("LYNX707: Class ".($class)." not found.",'Lynx/Component/AccessException', 707);
        }

        $this->routeArray[$this->instance_key_old]['class'] = $class;

    }

    public function __destruct()
    {
        $this->routeArray = array_values($this->routeArray);

        for ($i = @count($this->routeArray) - 1; $i >= 0; $i--) {
            if ($this->routeArray[$i]['class'] == null) {
                $this->routeArray[$i]['class'] = $this->routeArray[$i + 1]['class'];

                if ($this->routeArray[$i + 1]['prefix'] !== null) {
                    $this->routeArray[$i]['prefix'] = $this->routeArray[$i + 1]['prefix'];
                }

                if ($this->routeArray[$i + 1]['middleware'] !== null) {
                    $this->routeArray[$i]['middleware'] = $this->routeArray[$i + 1]['middleware'];
                }
            }
        }

        $dispatchable = ['parser' => false, 'request' => [], 'middlware' => []];

        $currentRoute = $_SERVER['REQUEST_URI'];
        $explodeCurrentRoute = array_filter(explode('/', $currentRoute));

        try {
            $rootDirectory = explode('\\', root_path());
            $explodeCurrentRoute = array_values(removeNeighbours($rootDirectory, $explodeCurrentRoute));
            
            foreach ($this->routeArray as $route) {
                $readableURI = @array_merge($route['uri'][0], $route['params']);

                if (empty($route['params'])) {
                    $readableURI = array_values($route['uri'][0]);
                } 


                if (@count($readableURI) == @count($explodeCurrentRoute)) {
                    
                    $isURICorrect = true;
                    for ($i = 0; $i < @count($route['uri'][0]); $i++) {
                        if ($explodeCurrentRoute[$i] !== $readableURI[$i]) {
                            $isURICorrect = false;
                        }
                    }
    
                    if ($isURICorrect) {
                        if (@count($readableURI) == @count($explodeCurrentRoute)) {
                            $finalRequest = @array_combine($readableURI, $explodeCurrentRoute);
                                foreach ($finalRequest as $requestKey => $requestValue) {
                                    if ($requestKey == $requestValue) {
                                        unset($finalRequest[$requestKey]);
                                    }
                                }
                            $dispatchable = ['parser' => true, 'request' => $finalRequest, 'class' => $route['class'], 'method' => $route['method'], 'http_method' => $route['uri'][1], 'middleware' => $route['middlewares']];
                        }                 
                    }
                }
            }
    
    
            if ($dispatchable['parser']) {
    
            if ($_SERVER["REQUEST_METHOD"] !== $dispatchable['http_method']) {
                throw new LynxException("LYNX701: ".$dispatchable['http_method']." Method is not supported for this request.",'Lynx/Component/HttpException', 701);
            }

            if ($_SERVER["REQUEST_METHOD"] !== 'GET' && !isset($_POST['_token'])) {
                throw new LynxException("LYNX719: CSRF token not found.",'Lynx/Component/SecurityException', 719);
            }

            if ($_SERVER["REQUEST_METHOD"] !== 'GET' && isset($_POST['_token'])  && $_POST['_token'] !== $_SESSION['_token']) {
                throw new LynxException("LYNX720: CSRF token mismatched.",'Lynx/Component/SecurityException', 719);
            }

            Request::requestifier($dispatchable['request']);

            if (!empty($dispatchable['middleware'])) {

                $middlewareHandler = new Handler();

                foreach ($dispatchable['middleware'] as $eachMiddlware) {
                    if (@count($eachMiddlware) !== 2) {
                        throw new LynxException("LYNX789: Expected two argument passed ".(@count($eachMiddlware)).".",'Lynx/Component/SyntaxException', 789);
                    }

                    if(!in_array($eachMiddlware[0], $middlewareHandler->group)){
                        throw new LynxException("LYNX707: Class ".($eachMiddlware[0])." not found or not registered.",'Lynx/Component/AccessException', 707);
                    }

                    try {
                        $middlewareObject = new $eachMiddlware[0]();
                        $middlewareObject->handle(new Request(), $eachMiddlware[1]);

                    } catch (\Exception $e) {
                        throw new LynxException($e->getMessage(), 'Lynx/Component/ExceptionException', 000);
                    }
                }

            }

                $object = new $dispatchable['class']();
                $stringableMethod = strval($dispatchable['method']);
                $object->$stringableMethod(new Request());
    
            } else {
                throw new LynxException("LYNX701: ".$_SERVER['REQUEST_URI']." does not exist in your route collection.",'Lynx/Component/HttpException', 701);
            }

        } catch (\Exception $e) {
                throw new LynxException("LYNX000: ".$e->getMessage().".",'Lynx/Component/ExceptionException', 000);
        }

    }

}