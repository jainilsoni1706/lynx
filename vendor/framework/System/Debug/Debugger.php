<?php

namespace Lynx\System\Debug;

class Debugger {

    public static function dd() {
        $args = func_get_args();
        dd($args);
    }

    
}