<?php

namespace Lynx\System\Routes;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Exception\LynxException;
use Lynx\System\Request\Request;
use App\Middleware\Handler;

class Route{

    protected static $routes = [];

    public static function get($uri, $action) {
        self::$routes[] = ['method' => 'GET', 'uri' => $uri, 'action' => $action];

        return new static();
    }

    public static function post($uri, $action) {
        self::$routes[] = ['method' => 'POST', 'uri' => $uri, 'action' => $action];

        return new static();
    }

    public function name($name = null) {
        if (is_null($name) && !is_string($name)) {
            throw new LynxException("LYNX788: Expected string passed ".gettype($name).".",'Lynx/Component/SyntaxException', 788);
        }

        $count = count(self::$routes);
        self::$routes[$count-1]['name'] = $name;

        return new static;
    }

    public static function dispatch($callback) {
        if (!is_callable($callback)) {
            throw new LynxException("LYNX788: Expected callback passed ".gettype($callback).".",'Lynx/Component/SyntaxException', 788);
        }

        $callback();

        return new static();
    }

    public function use() {
        self::execute();
    }

    public static function execute() {

        $currentRoute = $_SERVER['REQUEST_URI'];

        foreach (self::$routes as $route) {

            if ($_SERVER["REQUEST_METHOD"] !== $route['method']) {
                throw new LynxException("LYNX701: ".$route['method']." Method is not supported for this request.",'Lynx/Component/HttpException', 701);
            }

            if ($_SERVER["REQUEST_METHOD"] !== 'GET' && !isset($_POST['_token'])) {
                throw new LynxException("LYNX719: CSRF token not found.",'Lynx/Component/SecurityException', 719);
            }

            if ($_SERVER["REQUEST_METHOD"] !== 'GET' && isset($_POST['_token'])  && $_POST['_token'] !== $_SESSION['_token']) {
                throw new LynxException("LYNX720: CSRF token mismatched.",'Lynx/Component/SecurityException', 719);
            }
    
            if (!is_string($route['uri'])) {
                throw new LynxException("LYNX788: Expected string passed ".gettype($route['uri']).".",'Lynx/Component/SyntaxException', 788);
            }
    
            if (!is_array($route['action'])) {
                throw new LynxException("LYNX788: Expected array passed ".gettype($route['action']).".",'Lynx/Component/ArgumentException', 788);
            }
    
            if (count($route['action']) !== 2) {
                throw new LynxException("LYNX789: Expected 2 arguments passed ".count($route['action']).".",'Lynx/Component/SyntaxException', 789);
            }
    
            if (!class_exists($route['action'][0])) {
                throw new LynxException("LYNX707: Class ".($route['action'][0])." not found.",'Lynx/Component/AccessException', 707);
            }
    
            if (!method_exists($route['action'][0], $route['action'][1])) {
                throw new LynxException("LYNX707: Method ".($route['action'][1].'::'.$route['action'][1])." not found.",'Lynx/Component/AccessException', 707);
            }

            $explodeCurrentRoute = array_filter(explode('/', $currentRoute));
 
            $explodeRoute = array_filter(explode('/', $route['uri']));

            foreach ($explodeRoute as &$element) {
                $element = str_replace(array('{', '}'), '', $element);
            }

            $rootDirectory = explode('\\', root_path());

            $finalCurrentRoute = removeNeighbours($rootDirectory, $explodeCurrentRoute);

            $requestAble = array_combine($explodeRoute, $finalCurrentRoute);

            foreach ($requestAble as $key => $thisRequest) {
                $_REQUEST[$key] = $thisRequest;                
            }

            if (count($finalCurrentRoute)  ==  count($explodeRoute)) {
                $object = new $route['action'][0];
                $callableMethod = (string)$route['action'][1];
                return $object->$callableMethod(new Request($_REQUEST));
            }

        }

        throw new LynxException("LYNX707: Request ".($currentRoute)." not found.",'Lynx/Component/HttpException', 707);

    }

    // public static function name($name) {
    //     $count = count(self::$routes);
    //     self::$routes[$count-1]['name'] = $name;
    // }

    // public static function url($name, $params = array()) {
    //     foreach (self::$routes as $route) {
    //         if (isset($route['name']) && $route['name'] === $name) {
    //             $url = $route[1];

    //             foreach ($params as $key => $value) {
    //                 $url = str_replace('{' . $key . '}', $value, $url);
    //             }

    //             return $url;
    //         }
    //     }

    //     return null;
    // }

    

    public function route($name)
    {
        return $this;
    }
  
    public function group($prefix, $callback){
        $callback();
    }

    public static function middleware($middleware, $condition, $callback){

        $middlewaresList = new Handler();

        if(!in_array($middleware, $middlewaresList->group)){
            return new ApplicationException("Class App/Middlewares/$middleware::class not found.", "routes/routes.php", 404);
        }

        try {
            $middleware = new $middleware;
        } catch (\Throwable $th) {
            return new ApplicationException($th->getMessage(), "routes/routes.php", 404);
        }

    }

}