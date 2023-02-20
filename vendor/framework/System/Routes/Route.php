<?php

namespace Lynx\System\Routes;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Request\Request;
use App\Middleware\Handler;

class Route{

    public static function get($route, $array)
    {
        self::registerRoute($route, $array, "GET");
    }

    public static function post($route, $array)
    {
        self::registerRoute($route, $array, "POST");
    }

    public static function registerRoute($route, $array, $method)
    {
        if (!is_string($route)) {
            return new ApplicationException("First parameter must be string.", "routes/routes.php", 402);
        }

        if (!is_array($array) || count($array) !== 2) {
            return new ApplicationException("Second parameter must be an array with two values.", "routes/routes.php", 402);
        }
        $controller = $array[0];
        $action = $array[1];
    
        if (!class_exists($controller)) {
            return new ApplicationException("Class App/Controllers/$controller::class not found.", "routes/routes.php", 404);
        }
    
        if (!method_exists($controller, $action)) {
            return new ApplicationException("Method App/Controllers/$controller::$action Method not found.", "routes/routes.php", 404);
        }
    
        $requestURI = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];
    
        if ($requestMethod !== $method) {
            return new ApplicationException("Method not allowed.", "routes/routes.php",407);
        }
    
        if ($method === "POST" && (!isset($_POST['_token']) || $_POST['_token'] !== $_SESSION['_token'])) {
            if (!isset($_POST['_token'])) {
                return new ApplicationException("CSRF token not found.", "routes/routes.php", 419);
            } else {
                return new ApplicationException("CSRF token mismatched.", "routes/routes.php", 420);
            }
        }
    
        $escapedRoute = preg_quote($route, '/');
        
        $paramPattern = '/\{([^}]*)\}/';
        $paramReplacement = '(?P<$1>[^/]+)';
        $regexRoute = preg_replace($paramPattern, $paramReplacement, $escapedRoute);
    
        $regexRoute = '/^' . $regexRoute . '$/';
    
        $match = [];
        if (preg_match($regexRoute, $requestURI, $match) !== 1) {
            return null;
        }
    
        $params = array_filter($match, 'is_string', ARRAY_FILTER_USE_KEY);

        $app = new $controller;
        $app->$action(new Request($params));

        return;
    }

    

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