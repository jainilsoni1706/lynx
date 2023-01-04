<?php

namespace App\Commands;

use App\Commands\Spammer;
use App\Commands\Tester;

class Handler {

    public $register;

    public function __construct()
    {
        $this->register = [
            Tester::class,
            Spammer::class
        ];        
    }
    
}

