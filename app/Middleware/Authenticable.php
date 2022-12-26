<?php

namespace App\Middleware;

use Lynx\System\Exception\ApplicationException;
use Lynx\System\Middleware\Middleware;
use Lynx\System\Request\Request;

class Authenticable extends Middleware {


    public function handle(Request $request, $args) : bool
    {
        if (true) {
            return true;
        } else {
            abort(401);
        }

    }

}