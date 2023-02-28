<?php 

 namespace App\Middleware; 

 use Lynx\System\Middleware\Middleware; 
 use Lynx\System\Request\Request; 

 class Testable extends Middleware { 

	public function handle(Request $request, $args) : bool 
	{ 
		dd($request->all(),$args);
	}  

 } 