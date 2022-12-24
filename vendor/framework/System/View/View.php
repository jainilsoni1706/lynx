<?php

namespace Lynx\System\View;

use Lynx\System\Exception\ApplicationException;

class View {
    
    public function __construct() {
        echo 'View';
    }
    
    public static function render($view, $data = []){
        $view = str_replace('.', '/', $view);
        $view = realpath("app/Views/{$view}.lynx.php");
        if (file_exists($view)) {
            extract($data);
            require_once $view;
        } else {
            return new ApplicationException("View Exception: View Not Found.");
        }
    }

    public static function view($view, $data = []){
        $view = str_replace('.', '/', $view);
        $view = realpath("app/Views/{$view}.lynx.php");
        if (file_exists($view)) {
            extract($data);
            require_once $view;
        } else {
            return new ApplicationException("View Exception: View Not Found.");
        }
    }

    public static function make($view, $data = []){
        $view = str_replace('.', '/', $view);
        $view = realpath("app/Views/{$view}.lynx.php");
        if (file_exists($view)) {
            extract($data);
            require_once $view;
        } else {
            return new ApplicationException("View Exception: View Not Found.");
        }
    }

    public static function compact($data = []){
        extract($data);
    }

}



 function render($view, $data = []){
    $view = str_replace('.', '/', $view);
    $view = realpath("app/Views/{$view}.lynx.php");
    if (file_exists($view)) {
        extract($data);
        require_once $view;
    } else {
        return new ApplicationException("View Exception: View Not Found.");
    }
}

function view($view, $data = []){
    $view = str_replace('.', '/', $view);
    $view = realpath("app/Views/{$view}.lynx.php");
    if (file_exists($view)) {
        extract($data);
        require_once $view;
    } else {
        return new ApplicationException("View Exception: View Not Found.");
    }
}

function make($view, $data = []){
    $view = str_replace('.', '/', $view);
    $view = realpath("app/Views/{$view}.lynx.php");
    if (file_exists($view)) {
        extract($data);
        require_once $view;
    } else {
        return new ApplicationException("View Exception: View Not Found.");
    }
}

function compact($data = []){
    extract($data);
}