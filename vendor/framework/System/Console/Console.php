<?php

namespace Lynx\System\Console;

class Console {

    public static $command;

    public static $name;

    public static function handle()
    {
        
    }

    public static function text($text,$color)
    {
        $colors = [
            'red' => '31',
            'green' => '32',
            'yellow' => '33',
            'blue' => '34',
            'magenta' => '35',
            'cyan' => '36',
            'light_gray' => '37',
            'dark_gray' => '90',
            'light_red' => '91',
            'light_green' => '92',
            'light_yellow' => '93',
            'light_blue' => '94',
            'light_magenta' => '95',
            'light_cyan' => '96',
            'white' => '97',
        ];

        if (array_key_exists($color, $colors)) {
            $color = $colors[$color];
        }

        echo  "\033[" . $color . "m" . $text . "\033[0m";
    }

}