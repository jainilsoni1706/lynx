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

        $this->routeArray[$this->instance_key]['uri'] = func_get_args();

        return $this;
    }

    public function post()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = func_get_args();

        return $this;
    }

    public function put()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = func_get_args();

        return $this;
    }

    public function delete()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = func_get_args();

        return $this;
    }

    public function any()
    {
        if (empty(func_get_args())) {
            throw new LynxException("LYNX789: Expected at least an argument passed 0.",'Lynx/Component/SyntaxException', 789);
        }

        $this->routeArray[$this->instance_key]['uri'] = func_get_args();

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

        for ($i = count($this->routeArray) - 1; $i >= 0; $i--) {
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

        $dispatchable = ['parser' => false, 'request' => []];

        $currentRoute = $_SERVER['REQUEST_URI'];
        $explodeCurrentRoute = array_filter(explode('/', $currentRoute));

        $rootDirectory = explode('\\', root_path());
        $explodeCurrentRoute = array_values(removeNeighbours($rootDirectory, $explodeCurrentRoute));
        
        foreach ($this->routeArray as $route) {
            $readableURI = array_merge($route['uri'], $route['params']);

            if (count($readableURI) == count($explodeCurrentRoute)) {
                $isURICorrect = true;
                for ($i = 0; $i < count($route['uri']); $i++) {
                    if ($explodeCurrentRoute[$i] !== $readableURI[$i]) {
                        $isURICorrect = false;
                    }
                }

                if ($isURICorrect) {
                    if (count($readableURI) == count($explodeCurrentRoute)) {
                        $finalRequest = array_combine($readableURI, $explodeCurrentRoute);
                            foreach ($finalRequest as $requestKey => $requestValue) {
                                if ($requestKey == $requestValue) {
                                    unset($finalRequest[$requestKey]);
                                }
                            }
                        $dispatchable = ['parser' => true, 'request' => $finalRequest, 'class' => $route['class'], 'method' => $route['method']];
                    }                 
                }
            }
        }


        if ($dispatchable['parser']) {

        } else {
            throw new LynxException("LYNX701: ".$_SERVER['REQUEST_URI']." does not exist in your route collection.",'Lynx/Component/HttpException', 701);
        }
    }

    // protected static $routes = [];

    // public static function get($uri, $action) {
    //     self::executable(['method' => 'GET', 'uri' => $uri, 'action' => $action]);

    //     return new static();
    // }

    // public static function post($uri, $action) {
    //     self::executable(['method' => 'GET', 'uri' => $uri, 'action' => $action]);

    //     return new static();
    // }

    // public function name($name = null) {
    //     if (is_null($name) && !is_string($name)) {
    //         throw new LynxException("LYNX788: Expected string passed ".gettype($name).".",'Lynx/Component/SyntaxException', 788);
    //     }

    //     $count = count(self::$routes);
    //     self::$routes[$count-1]['name'] = $name;
    // }

    // public static function executable($route)
    // {
    //     $currentRoute = $_SERVER['REQUEST_URI'];

    //         if ($_SERVER["REQUEST_METHOD"] !== $route['method']) {
    //             throw new LynxException("LYNX701: ".$route['method']." Method is not supported for this request.",'Lynx/Component/HttpException', 701);
    //         }

    //         if ($_SERVER["REQUEST_METHOD"] !== 'GET' && !isset($_POST['_token'])) {
    //             throw new LynxException("LYNX719: CSRF token not found.",'Lynx/Component/SecurityException', 719);
    //         }

    //         if ($_SERVER["REQUEST_METHOD"] !== 'GET' && isset($_POST['_token'])  && $_POST['_token'] !== $_SESSION['_token']) {
    //             throw new LynxException("LYNX720: CSRF token mismatched.",'Lynx/Component/SecurityException', 719);
    //         }
    
    //         if (!is_string($route['uri'])) {
    //             throw new LynxException("LYNX788: Expected string passed ".gettype($route['uri']).".",'Lynx/Component/SyntaxException', 788);
    //         }
    
    //         if (!is_array($route['action'])) {
    //             throw new LynxException("LYNX788: Expected array passed ".gettype($route['action']).".",'Lynx/Component/ArgumentException', 788);
    //         }
    
    //         if (count($route['action']) !== 2) {
    //             throw new LynxException("LYNX789: Expected 2 arguments passed ".count($route['action']).".",'Lynx/Component/SyntaxException', 789);
    //         }
    
    //         if (!class_exists($route['action'][0])) {
    //             throw new LynxException("LYNX707: Class ".($route['action'][0])." not found.",'Lynx/Component/AccessException', 707);
    //         }
    
    //         if (!method_exists($route['action'][0], $route['action'][1])) {
    //             throw new LynxException("LYNX707: Method ".($route['action'][1].'::'.$route['action'][1])." not found.",'Lynx/Component/AccessException', 707);
    //         }

    //         $explodeCurrentRoute = array_filter(explode('/', $currentRoute));
 
    //         $explodeRoute = array_filter(explode('/', $route['uri']));

    //         foreach ($explodeRoute as &$element) {
    //             $element = str_replace(array('{', '}'), '', $element);
    //         }

    //         $rootDirectory = explode('\\', root_path());

    //         $finalCurrentRoute = removeNeighbours($rootDirectory, $explodeCurrentRoute);
    //         dd($explodeRoute, $finalCurrentRoute);
    //         $requestAble = array_combine($explodeRoute, $finalCurrentRoute);

    //         foreach ($requestAble as $key => $thisRequest) {
    //             $_REQUEST[$key] = $thisRequest;                
    //         }

    //         if (count($finalCurrentRoute)  ==  count($explodeRoute)) {
    //             $object = new $route['action'][0];
    //             $callableMethod = (string)$route['action'][1];
    //             return $object->$callableMethod(new Request($_REQUEST));
    //         }


    //     throw new LynxException("LYNX707: Request ".($currentRoute)." not found.",'Lynx/Component/HttpException', 707);
    // }

    // public function of($class)
    // {

    // }

    // public static function routes($callback){
    //     $callback();
    //     return new static();
    // }
  
    // public function group($prefix, $callback){
    //     $callback();
    // }

    // public static function middleware($middleware, $condition, $callback){

    //     $middlewaresList = new Handler();

    //     if(!in_array($middleware, $middlewaresList->group)){
    //         return new ApplicationException("Class App/Middlewares/$middleware::class not found.", "routes/routes.php", 404);
    //     }

    //     try {
    //         $middleware = new $middleware;
    //     } catch (\Throwable $th) {
    //         return new ApplicationException($th->getMessage(), "routes/routes.php", 404);
    //     }

    // }

}