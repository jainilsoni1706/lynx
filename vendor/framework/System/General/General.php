<?php

use Lynx\System\Localization\Lang;
use Lynx\System\File\File;

    function error($message = "Exception",$path = __DIR__, $code = 500) {
        echo "<style>@import url('https://fonts.googleapis.com/css?family=Montserrat:400,400i,700');body {background-color: #330000;font-family: 'Montserrat', sans-serif;}article {display: flex;justify-content: center;align-items: center;height: 100vh;box-sizing: border-box;}aside {flex: 0 0 75vw;display: flex;flex-direction: column;align-items: center;justify-content: center;padding: 2em;box-sizing: border-box;}h1,p {color: #fff;font-size: 3em;padding: 0;margin: 0;}p {font-size: 1em;}#render_error {fill: none;stroke: #f00;stroke-width: 3;stroke-linecap: round;stroke-linejoin: round;stroke-miterlimit: 10;}svg {height: 300px;}</style><article><aside><p style='color:white;font-size:20px;'>Exception : <span style='font-weight: 900;'> $message </span> </p> <br><p style='color:white;font-size:20px;'>Exception For : <span style='font-weight: 900;'>$path</span> </p><br><br><br><svg onclick='render_error.reset().play();' id='render_error' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 809 375'><path d='M218 49H82l-14 92a192 192 0 0 1 29-2c27 0 55 6 77 19 28 16 51 47 51 92 0 70-55 122-133 122-39 0-72-11-89-22l12-37c15 9 44 20 77 20 45 0 84-30 84-78 0-46-31-79-103-79-20 0-36 2-49 4L47 9h171zM524 183c0 122-45 189-124 189-70 0-117-65-118-184C282 68 333 3 406 3c75 0 118 67 118 180zm-194 6c0 93 29 146 73 146 49 0 73-58 73-149 0-88-23-146-73-146-42 0-73 51-73 149zM806 183c0 122-45 189-124 189-70 0-117-65-118-184C564 68 615 3 688 3c75 0 118 67 118 180zm-194 6c0 93 29 146 73 146 49 0 73-58 73-149 0-88-23-146-73-146-42 0-73 51-73 149z'/></svg><br><br><br><h1>Lynx Application Exception</h1></aside></article><script src='FrameworkErrorPage.js'></script><script>render_error = new Vivus('render_error', {type: 'oneByOne', duration:500});</script>";
    }


    function dump($var, $die = false)
    {
        echo "<pre style='background-color: #000;color:#00ff00;padding:10px;font-size:20px;'>";
        print_r($var);
        echo "</pre>";
        if ($die) {
            die();
        }
    }


    function dd($var)
    {
        dump($var, true);
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
            return dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '\app';
        } else {
            $file = str_replace('/', '\\', $file);
            return dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '\app\\' . $file;
        }
    }

    function public_path($file = null) {
        if ($file == null) {
            return __DIR__ . '../../../../../public/';
        } else {
            $file = str_replace('/', '\\', $file);
            return __DIR__ . '../../../../../public/' . $file;
        }
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
        getAllLanguages();
    }

    autoloader();