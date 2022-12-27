<?php

namespace Lynx\System\Controller;

session_start();

use Lynx\System\Session\Session;

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