<?php 
namespace App\Commands; 

use Lynx\System\Console\Console; 

class Spammer extends Console 
{ 
	public static $command = 'start:spamming';

	public static $name = "add-product"; 

	public static function handle() 
	{
		for($i = 1; $i <=10;  $i++) {
			echo $i;
		}		
	} 
} 
