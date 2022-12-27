<?php

namespace Lynx\System\Routes;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Request\Request;
use App\Middleware\Handler;

class Route{

    public static function get($route, $array) {

            if (is_array($array)) {
                if (count($array) == 2) {
                    if (file_exists($array[0] . ".php")) {
                        if (method_exists($array[0], $array[1])) {
                            
                            $requestURI = explode('/', $_SERVER['REQUEST_URI']);
                            array_shift($requestURI);
                            array_shift($requestURI);
                            $requestURI = implode('/', $requestURI);

                            if ($requestURI == $route) {
                                if ($_SERVER['REQUEST_METHOD'] == "GET") {

                                    $app = new $array[0];
                                    $app->{$array[1]}(new Request);
                                    die;

                                } else {
                                    return new ApplicationException("Method not allowed.", "Lynx/routes/mapper.php");
                                }
                            } 
                        } else {
                            return new ApplicationException("$array[0]::$array[1] not found.", "Lynx/routes/mapper.php");
                        }
                    } else {
                        return new ApplicationException("Controller not found.", "Lynx/routes/mapper.php");
                    }
                } else {
                    return new ApplicationException("Second Parameter must has 2 value in an array.", "Lynx/routes/mapper.php");
                }
            } else {
                return new ApplicationException("Second parameter must be an array.", "Lynx/routes/mapper.php");
            }
    }

    public static function post($route, $array) {

            if (is_array($array)) {
                if (count($array) == 2) {
                    if (file_exists($array[0] . ".php")) {
                        if (method_exists($array[0], $array[1])) {
                            
                            $requestURI = explode('/', $_SERVER['REQUEST_URI']);
                            array_shift($requestURI);
                            array_shift($requestURI);
                            $requestURI = implode('/', $requestURI);

                            if ($requestURI == $route) {
                                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                    if (isset($_POST['_token'])) {
                                        if ($_POST['_token'] == $_SESSION['_token']) {

                                            $app = new $array[0];
                                            $app->{$array[1]}(new Request);
                                            die;
                                            
                                        } else {
                                            return new ApplicationException("CSRF token mismatch.", "Lynx/routes/mapper.php");
                                        }
                                    } else {
                                        return new ApplicationException("CSRF token not found.", "Lynx/routes/mapper.php", 419);
                                    }
                                } else {
                                    return new ApplicationException("Method not allowed.", "Lynx/routes/mapper.php");
                                }
                            } 
                        } else {
                            return new ApplicationException("$array[0]::$array[1] not found.", "Lynx/routes/mapper.php");
                        }
                    } else {
                        return new ApplicationException("Controller not found.", "Lynx/routes/mapper.php");
                    }
                } else {
                    return new ApplicationException("Second Parameter must has 2 value in an array.", "Lynx/routes/mapper.php");
                }
            } else {
                return new ApplicationException("Second parameter must be an array.", "Lynx/routes/mapper.php");
            }
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
            return new ApplicationException("Class $middleware not found.", "Lynx/System/Exception/ApplicationException.php");
        }

        try {
            $middleware = new $middleware;
        } catch (\Throwable $th) {
            return new ApplicationException($th->getMessage(), "Lynx/System/Exception/ApplicationException.php");
        }

        try {
            if($middleware->handle(new Request, $condition)){
                $callback();
            }
        } catch (\Throwable $th) {
            return new ApplicationException($th->getMessage(), "Lynx/System/Exception/ApplicationException.php");
        }



    }

}