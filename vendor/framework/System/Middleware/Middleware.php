<?php

namespace Lynx\System\Middleware;

class Middleware{

    public function __construct(){
        require_once realpath("vendor/autoload.php");
    }

    public function handle(){

    }

    function __destruct() {
        if (self::handle() === false) {
            die("Middleware Exception: Middleware Handler Returned Failure.");
        }
    }

}