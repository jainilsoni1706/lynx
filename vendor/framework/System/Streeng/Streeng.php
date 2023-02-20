<?php


namespace Lynx\System\Streeng;

use Lynx\System\Exception\ApplicationException;

class Streeng {

    public static function countChar($thisstr) {
        if (!is_string($thisstr)) {
           return new ApplicationException("Parameter must be string.", "Lynx/System/Streeng.php"); 
        }

        return strlen($thisstr);

    }

    public static function stringInto($thisstr, $count) {
        if (!is_string($thisstr)) {
            return new ApplicationException("Parameter must be string.", "Lynx/System/Streeng.php"); 
         }

         if (!is_integer($count)) {
            return new ApplicationException("Parameter must be integer.", "Lynx/System/Streeng.php"); 
         }

         $string = "";
         $iteration = 1;

         while ($iteration <= $count) {

            $string .= $thisstr;

            $iteration++;
         }

         return $string;
    }
}