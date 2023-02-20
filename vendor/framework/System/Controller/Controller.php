<?php

namespace Lynx\System\Controller;
use Lynx\System\Session\Session;
use Lynx\System\Database\Connection\Connect;

session_start();
error_reporting(~E_NOTICE);

class Controller
{
    public function __construct()
    {
        $this->setTimezone();
        Session::set("appLocale", "english");
    }

    private function setTimezone()
    {
        date_default_timezone_set(env('APP_TIMEZONE'));
    }
}