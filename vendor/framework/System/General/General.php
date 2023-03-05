<?php

use Lynx\System\Exception\LynxException;
use Lynx\System\Localization\Lang;
use Lynx\System\File\File;
use Lynx\System\Set\Set;

    function error($message = "Exception",$path = __DIR__, $code = 500) {
        echo "<style>@import url('https://fonts.googleapis.com/css?family=Montserrat:400,400i,700');body {background-color: #330000;font-family: 'Montserrat', sans-serif;}article {display: flex;justify-content: center;align-items: center;height: 100vh;box-sizing: border-box;}aside {flex: 0 0 75vw;display: flex;flex-direction: column;align-items: center;justify-content: center;padding: 2em;box-sizing: border-box;}h1,p {color: #fff;font-size: 3em;padding: 0;margin: 0;}p {font-size: 1em;}#render_error {fill: none;stroke: #f00;stroke-width: 3;stroke-linecap: round;stroke-linejoin: round;stroke-miterlimit: 10;}svg {height: 300px;}</style><article><aside><p style='color:white;font-size:20px;'>Exception : <span style='font-weight: 900;'> $message </span> </p> <br><p style='color:white;font-size:20px;'>Exception For : <span style='font-weight: 900;'>$path</span> </p><br><br><br><svg onclick='render_error.reset().play();' id='render_error' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 809 375'><path d='M218 49H82l-14 92a192 192 0 0 1 29-2c27 0 55 6 77 19 28 16 51 47 51 92 0 70-55 122-133 122-39 0-72-11-89-22l12-37c15 9 44 20 77 20 45 0 84-30 84-78 0-46-31-79-103-79-20 0-36 2-49 4L47 9h171zM524 183c0 122-45 189-124 189-70 0-117-65-118-184C282 68 333 3 406 3c75 0 118 67 118 180zm-194 6c0 93 29 146 73 146 49 0 73-58 73-149 0-88-23-146-73-146-42 0-73 51-73 149zM806 183c0 122-45 189-124 189-70 0-117-65-118-184C564 68 615 3 688 3c75 0 118 67 118 180zm-194 6c0 93 29 146 73 146 49 0 73-58 73-149 0-88-23-146-73-146-42 0-73 51-73 149z'/></svg><br><br><br><h1>Lynx Application Exception</h1></aside></article><script src='FrameworkErrorPage.js'></script><script>render_error = new Vivus('render_error', {type: 'oneByOne', duration:500});</script>";
    }


    function dump()
    {
            echo '<style>
                body {
                    background: darkblue;
                } 
                .sfdump {
                    background: #000;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                    font-family: Consolas, monospace;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 20px auto;
                    max-width: 100%;
                    overflow: auto;
                    padding: 10px;
                    position: relative;
                    text-align: left;
                    color: #7CFC00!important;
                    z-index: 9999;
                }
                .sfdump .sfdump-header {
                    background: #000;
                    border-bottom: 1px solid #ccc;
                    border-radius: 5px 5px 0 0;
                    color: #FF5F1F!important;
                    font-size: 14px;
                    font-weight: bold;
                    padding: 5px 10px;
                }
                .sfdump .sfdump-body {
                    padding: 10px;
                }
                .sfdump .sfdump-body .sfdump-array {
                    margin: 0 0 10px 0;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-key {
                    color: #333;
                    font-weight: bold;
                    margin-right: 5px;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value {
                    color: #333;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array {
                    margin: 0;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-key {
                    color: #333;
                    font-weight: bold;
                    margin-right: 5px;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value {
                    color: #333;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array {
                    margin: 0;
                }
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-key {
                    color: #333;
                    font-weight: bold;
                    margin-right: 5px;
                }
    
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value {
                    color: #333;
                }
    
    
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array {
                    margin: 0;
                }
    
    
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-key {
                    color: #333;
                    font-weight: bold;
                    margin-right: 5px;
                }
    
    
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value {
                    color: #333;
                }
    
    
                .sfdump .sfdump-body .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array .sfdump-array-value .sfdump-array {
                    margin: 0;
                }
    
    
    
    
            </style>';
    
            echo '<div class="sfdump">';
            echo '<div class="sfdump-header">Dump</div>';
            echo '<div class="sfdump-body">';
            echo '<pre>';
            print_r(func_get_args());
            echo '</pre>';
            echo '</div>';
            echo '</div>';

            // create footer for debugger to show memory usage,, arguments and other
            echo '<div class="sfdump">';
            echo '<div class="sfdump-header">Debug</div>';
            echo '<div class="sfdump-body">';
            echo '<pre>';
            $debug = debug_backtrace();
            $file = $debug[0]['file'];
            $line = $debug[0]['line'];
            $memory = memory_get_usage();
            $memory_peak = memory_get_peak_usage();
            $memory = formatBytes($memory);
            $memory_peak = formatBytes($memory_peak);
            $time = date('Y-m-d H:i:s');    
            echo "<b>Debug:</b> {$time} <br>";
            echo "<b>File:</b> {$file} <br>";
            echo "<b>Line:</b> {$line} <br>";
            echo "<b>Memory:</b> {$memory} <br>";
            echo 'Memory Usage: ' . memory_get_usage() . ' bytes <br>';
            echo "<b>Memory Peak:</b> {$memory_peak} <br>";
            echo '</pre>';
            echo '</div>';
            echo '</div>';

            

    
            echo '<script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    document.addEventListener("click", function(event) {
                        if (event.target.classList.contains("sfdump")) {
                            event.target.style.display = "none";
                        }
                    });
                });
            </script>';
    
    
            die();
    
    
    }
    
    function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow)); 

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }

    function dd()
    {
        $var = func_get_args();
        dump($var);
    }

    function generateToken()
    {
        $token = md5(uniqid(rand(), true));
        $_SESSION['token'] = $token;
        return $token;
    }

    function csrf_token()
    {
        if (!isset($_SESSION['_token'])) {
            $_SESSION['_token'] = bin2hex(random_bytes(32));
        }
        echo "<input type='hidden' name='_token' value='" . $_SESSION['_token'] . "'>";
    }

    function url($url) {
        $projectUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        return $projectUrl.$url;
    }
    
    function redirect($url, $statusCode = 303) {
        $projectUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
        header('Location: ' . $projectUrl.$url, true, $statusCode);
        die();
    }

    function isJson() {
		if (isset($_SERVER['CONTENT_TYPE']) && $_SERVER['CONTENT_TYPE'] == "application/json") {
			return true;
		} else {
			return false;
		}
	}

	function back() {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		die();
	}

    function db_config($key) {    
        $config = require_once __DIR__ . '../../../../../config/database.php';
        return $config[$key];
    }

    function app_config($key) {
        $config = require_once __DIR__ . '../../../../../config/app.php';
        return $config[$key];
    }

    function mail_config($key) {
        $config = require_once __DIR__ . '../../../../../config/mail.php';
        return $config[$key];
    }

    function app_path($file = null) {
        if ($file == null) {
            $file = root_path() . '/app/';
        } else {
            $file = root_path() . '/app/' . $file;
        }
        return str_replace('/', '\\', $file);
    }

    function public_path($file = null) {
        if ($file == null) {
            $file = root_path() . '/public/';
        } else {
            $file = root_path() . '/public/' . $file;
        }
        return str_replace('/', '\\', $file);
    }

    function storage_path($file = null) {
        if ($file == null) {
            $file = root_path() . '/storage/';
        } else {
            $file = root_path() . '/storage/' . $file;
        }
        return str_replace('/', '\\', $file);
    }

    function root_path()
    {
        return dirname(dirname(dirname(dirname(dirname(__FILE__)))));
    }

    function env($key) {

        try {
            $env = file_get_contents(root_path() . '/.env');
            $env = explode(PHP_EOL, $env); 
            $env = array_filter($env, function($value) use ($key) {
                return strpos($value, $key) !== false;
            });
                
            $env = array_values($env);
            $env = explode('=', $env[0]);
            return $env[1];
        } catch (\Exception $e) {
            return error(".env file not found","Lynx/Framework/System/ApplicationException.php",404);
        }

    }
    function translate($key) {
        if ($key !== null) {
            return Lang::get($key);
        } else {
            return $key;
        }
    }

    function abort($code) {
        if ($code == 404) {
            return error("Page not found","Lynx/System/Exception/RequestException.php",404);
        } else if ($code == 401) {
            return error("Unauthorized Access","Lynx/System/Exception/RequestException.php",403);
        } else if ($code == 403) {
            return error("Forbidden","Lynx/System/Exception/RequestException.php",403);
        } else if ($code == 500) {
            return error("Internal Server Error","Lynx/System/Exception/RequestException.php",500);
        } else {
            return error("Unknown Error","Lynx/System/Exception/RequestException.php",500);
        }
    }

    function get($x)
    {
        if (isset($_GET[$x])) {
            return $_GET[$x];
        } else {
            return null;
        }
    }

    function post($x)
    {
        if (isset($_POST[$x])) {
            return $_POST[$x];
        } else {
            return null;
        }
    }

    function request($x)
    {
        if (isset($_REQUEST[$x])) {
            return $_REQUEST[$x];
        } else {
            return null;
        }
    }


    function collect($array)
    {
        return new Set($array);
    }
    
    function out($array = [])
    {
        print_r($array);
        exit;
    }

    function removeNeighbours($array_first, $array_second) {
        if (!(is_array($array_first) && is_array($array_second))) {
            return false;    
        }

        $array_first = array_values($array_first);
        $array_second = array_values($array_second);

        $temp_first = $array_first;
        $temp_second = $array_second;
        
        for ($i = 0; $i < count($array_first); $i++) {
            for ($j = 0; $j < count($array_second); $j++) {
             if ($array_first[$i] == $array_second[$j] && !(is_null($array_first[$i]) &&  is_null($array_second[$j]))) {
                unset($temp_second[$j]);
             } else {
                break;
             }
            }   
        }

        return $temp_second;

    }

    function view($view, $data = array())
    {
        $this_view = str_replace('\\', '/', app_path()) . 'Views/' . str_replace('.', '/', $view) . '.lynx.php';

        if (file_exists($this_view)) {
            extract($data);
            require_once $this_view;
        } else {
            throw new LynxException("$view View not found.","Lynx/ErrorComponents/AccessException",707);
        }
    }


    //not usable
    //not usable
    //not usable

    function getAllLanguages()
    {
        $files = File::getAllFiles(app_path('Localization'));
        $files = array_map(function ($file) {
            return str_replace('.json', '', $file);
        }, $files);

        $files = array_map(function ($file) {
            return str_replace(app_path('Localization') . '\\', '', $file);
        }, $files);

        define("LANGUAGES", $files);
    }

    function autoloader() {
        //functions
        getAllLanguages();

        //constants
        define("LYNX_VERSION", "1.0.0"); 
        
        if (env('APP_NAME') !== null) {
            define("APP_NAME", env('APP_NAME'));
        } else {
            define("APP_NAME", "Lynx");
        }

        if (env('CACHE_PATH') !== null) {
            define("CACHE_PATH", env('CACHE_PATH'));
        } else {
            define("CACHE_PATH", root_path() . '/storage/cache');
        }

        

    }

    autoloader();