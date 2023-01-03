<?php

namespace App\Commands;

use App\Commands\Spammer;

class Handler {

    public $register;

    public function __construct()
    {
        $this->register = [
            Spammer::class
        ];        
    }
    
}

