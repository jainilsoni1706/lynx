<?php 
 namespace App\Controllers; 

 use App\Controllers\Controller; 

 class Routable extends Controller { 
 
    protected $moduleName;

    public function __construct()
    {
        $this->moduleName = "Route Checker Class";        
    }

    public function index()
    {
        dd($this->moduleName);
    }

 } 
