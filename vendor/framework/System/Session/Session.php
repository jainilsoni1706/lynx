<?php

namespace Lynx\System\Session;

use Lynx\System\Exception\ApplicationException;

class Session {

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return new ApplicationException("Key not found.", "lynx/session/session.php");
        }
    }

    public static function all() {
        return $_SESSION;
    }

    public static function has($key) {
        if (isset($_SESSION[$key])) {
            return true;
        } else {
            return false;
        }
    }

    public static function remove($key) {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        } else {
            return new ApplicationException("Key not found.", "lynx/session/session.php");
        }
    }

    public static function destroy() {
        session_destroy();
    }

    public static function regenerate() {
        session_regenerate_id();
    }

    public static function flash($key, $value) {
        $_SESSION[$key] = $value;    
        $_SESSION['flash'] = $key;
    }

    public static function flashNow($key, $value) {
        $_SESSION   [$key] = $value;    
        $_SESSION   ['flash'] = $key;
        unset($_SESSION['flash']);
    }

    public static function flashExists() {
        if (isset($_SESSION['flash'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function flashGet() {
        if (isset($_SESSION['flash'])) {
            return $_SESSION[$_SESSION['flash']];
        } else {
            return new ApplicationException("Key not found.", "lynx/session/session.php");
        }
    }

    public static function flashRemove() {
        if (isset($_SESSION['flash'])) {
            unset($_SESSION[$_SESSION['flash']]);
            unset($_SESSION['flash']);
        } else {
            return new ApplicationException("Key not found.", "lynx/session/session.php");
        }
    }

    public static function flush() {
        session_unset();
    }

    public static function start() {
        session_start();
    }

    

}