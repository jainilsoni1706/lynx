<?php 
namespace App\Commands; 

use Lynx\System\Console\Console; 

class Tester extends Console 
{ 
	public static $command = 'add:product';

	public static $name = "add-product"; 

	public static function handle() 
	{
		for($i = 10; $i >=1;  $i--) {
			echo $i;
		}		
	} 
} 
