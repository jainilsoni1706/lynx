<?php


namespace Lynx\System\Log;

use Lynx\System\File\File;
use Lynx\System\Streeng\Streeng;

class Log {

    public static function listen($errorName, $errorDirectory, $errorCode) {
        $timestamp = date('d-m-Y H:i:s');

        if (File::exists("storage/lynx.log") === false) {
            File::create("storage/lynx.log");
        }

        $line = Streeng::stringInto('_',Streeng::countChar($errorName.$errorDirectory.$errorCode) + 32);

        if (Streeng::countChar((string)File::read("storage/lynx.log")) > 0) {
            $line = "";
        }

        $line .= "\n| $timestamp | $errorCode | $errorName | $errorDirectory |\n";
        $line .= Streeng::stringInto('_',Streeng::countChar($errorName.$errorDirectory.$errorCode) + 32);

        File::write("storage/lynx.log",$line, true);

    }
}