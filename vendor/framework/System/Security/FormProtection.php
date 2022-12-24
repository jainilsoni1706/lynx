<?php

namespace Lynx\System\Security;

class FormProtection {

    public static function generateToken()
    {
        $token = md5(uniqid(rand(), true));
        $_SESSION['token'] = $token;
        return $token;
    }

    public static function checkToken($token)
    {
        if (isset($_SESSION['token']) && $token === $_SESSION['token']) {
            unset($_SESSION['token']);
            return true;
        }
        return false;
    }

    public static function csrf_token()
    {
        if (!isset($_SESSION['_token'])) {
            $_SESSION['_token'] = bin2hex(random_bytes(32));
        }
        echo "<input type='hidden' name='_token' value='" . $_SESSION['_token'] . "'>";
    }
    
}



function csrf_token()
{
    if (!isset($_SESSION['_token'])) {
        $_SESSION['_token'] = bin2hex(random_bytes(32));
    }
    echo "<input type='hidden' name='_token' value='" . $_SESSION['_token'] . "'>";
}