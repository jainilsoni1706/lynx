<?php

namespace Lynx\System\Cache;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Set\Set;

class Cache {

    public static function set($key, $value, $time = 0) {
        if (is_array($value)) {
            $value = serialize($value);
        }
        if ($time == 0) {
            $time = 3600;
        }
        $time = time() + $time;
        $file = fopen(CACHE_PATH . $key . ".cache", "w");
        fwrite($file, $time . PHP_EOL);
        fwrite($file, $value);
        fclose($file);
    }

    public static function get($key) {
        $file = fopen(CACHE_PATH . $key . ".cache", "r");
        $time = fgets($file);
        if ($time < time()) {
            fclose($file);
            self::delete($key);
            return false;
        } else {
            $value = fread($file, filesize(CACHE_PATH . $key . ".cache"));
            fclose($file);
            if (self::is_serialized($value)) {
                $value = unserialize($value);
            }
            return $value;
        }
    }
    
    public static function delete($key) {
        unlink(CACHE_PATH   . $key . ".cache");
    }



    public static function setArray($key, $value, $time = 0) {
        if (is_array($value)) {
            $value = serialize($value);
        }
        if ($time == 0) {
            $time = 3600;
        }
        $time = time() + $time;
        $file = fopen(CACHE_PATH . $key . ".cache", "w");
        fwrite($file, $time . PHP_EOL);
        fwrite($file, $value);
        fclose($file);
    }

    public static function getArray($key) {
        $file = fopen(CACHE_PATH . $key . ".cache", "r");
        $time = fgets($file);
        if ($time < time()) {
            fclose($file);
            self::delete($key);
            return false;
        } else {
            $value = fread($file, filesize(CACHE_PATH . $key . ".cache"));
            fclose($file);
            if (self::is_serialized($value)) {
                $value = unserialize($value);
            }
            return $value;
        }
    }

    public static function is_serialized($value, &$result = null) {
        // Bit of a give away this one
        if (!is_string($value)) {
            return false;
        }
        // Serialized false, return true. unserialize() returns false on an
        // invalid string or it could return false if the string is serialized
        // false, eliminate that possibility.
        if ('b:0;' === $value) {
            $result = false;
            return true;
        }
        $length = strlen($value);
        $end = '';
        switch ($value[0]) {
            case 's':
                if ('"' !== $value[$length - 2]) {
                    return false;
                }
            case 'b':
            case 'i':
            case 'd':
                // This looks odd but it is quicker than isset()ing
                $end .= ';';
            case 'a':
            case 'O':
                $end .= '}';
                if (':' !== $value[1]) {
                    return false;
                }
                switch ($value[2]) {
                    case 0:
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                    case 7:
                    case 8:
                    case 9:
                        break;
                    default:
                        return false;
                }
            case 'N':
                $end .= ';';
                if ($end !== substr($value, -strlen($end))) {
                    return false;
                }
                break;
            default:
                return false;
        }
        if (($result = @unserialize($value)) === false) {
            $result = null;
            return false;
        }
        return true;
    }

    

}