<?php

namespace Lynx\System\Debug;

class Debugger {

    public static function dump($var, $die = false)
    {
        echo "<pre style='background-color: #000;color:#00ff00;padding:10px;font-size:20px;'>";
        print_r($var);
        echo "</pre>";
        if ($die) {
            die();
        }
    }


    public static function dd($var)
    {
        self::dump($var, true);
    }



}

function dd($array = [])
{
    echo "<pre style='background-color: #000;color:#00ff00;padding:10px;font-size:20px;'>";
    print_r($array);
    echo "</pre>";
    die();
}