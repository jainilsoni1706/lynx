<?php

namespace Lynx\System\Controller;
use Lynx\System\Session\Session;

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
        date_default_timezone_set(app_config('app_conf.timezone'));
    }
}