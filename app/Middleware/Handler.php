<?php

namespace App\Middleware;

use App\Middleware\Authenticable;
use App\Middleware\Testable;
use App\Middleware\PreventionGate;

class Handler {

    public $group;

    public function __construct()
    {
        $this->group = [
            Authenticable::class,
            Testable::class,
            PreventionGate::class
        ];        
    }
    
}

