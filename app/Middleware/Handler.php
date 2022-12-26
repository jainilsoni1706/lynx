<?php

namespace App\Middleware;

use App\Middleware\Authenticable;

class Handler {

    public $group;

    public function __construct()
    {
        $this->group = [
            Authenticable::class
        ];        
    }
    
}

