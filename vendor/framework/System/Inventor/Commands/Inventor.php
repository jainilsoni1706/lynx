<?php

namespace Lynx\System\Inventor\Commands;

use Lynx\System\Console\Console;
use Lynx\System\File\File;
use App\Commands\Handler;

class Inventor extends Console  
{

    public static $commands = [];

    public static function make($args)
    {
        self::registerCommand();
        self::create($args);
    }

    public static function initializeStaticCommands()
    {
        self::$commands[] = [
            'controller' => [
                'path' => app_path('Controllers/'),
                'namespace' => 'App\Controllers',
                'name' => 'make:controller',
                'parentClass' => 'App\Controllers\Controller',
                'content' => "<?php \r namespace App\Controllers; \r\r use App\Controllers\Controller; \r\r class %s extends Controller { \r \r } \r",
                'type' => 'Controller',
            ],
            'model' => [
                'path' => app_path('Models/'),
                'namespace' => 'App\Models',
                'name' => 'make:model',
                'parentClass' => 'Lynx\System\Model\Model',
                'content' => "<?php \r namespace App\Models; \r\r use Lynx\System\Model\Model; \r\r class %s extends Model { \r \r } \r",
                'type' => 'Model',
            ],
            'middleware' => [
                'path' => app_path('Middleware/'),
                'namespace' => 'App\Middleware',
                'name' => 'make:middleware',
                'parentClass' => 'Lynx\System\Middleware\Middleware',
                'content' => "<?php \r\r namespace App\Middleware; \r\r use Lynx\System\Middleware\Middleware; \r use Lynx\System\Request\Request; \r\r class %s extends Middleware { \r\r\tpublic function handle(Request ".'$request, $args'.") : bool \r\t{ \r \t\treturn true; \r\t}  \r\r } ",
                'type' => 'Middleware',
            ],
            'view' => [
                'path' => app_path('Views/'),
                'namespace' => '',
                'name' => 'make:view',
                'parentClass' => '',
                'content' => '',
                'type' => 'View',
            ],
            'command' => [
                'path' => app_path('Commands/'),
                'namespace' => 'App\Commands',
                'name' => 'make:command',
                'parentClass' => 'Lynx\System\Console\Console',
                'content' => "<?php \rnamespace App\Commands; \r\ruse Lynx\System\Console\Console; \r\rclass %s extends Console \r{ \r\tpublic static ".'$command'." = 'add:product';\r\r\tpublic static ".'$name = "add-product";'." \r\r\tpublic static function handle() \r\t{\r \r\t} \r} \r",
                'type' => 'Command',
            ],
            'schema' => [
                'path' => app_path('Schemas/'),
                'namespace' => 'App\Schemas',
                'name' => 'make:schema',
                'parentClass' => 'Lynx\System\Schema\Schema',
                'content' => '<?php \r namespace App\Schemas; \r use Lynx\System\Schema\Schema; \r class %s extends Schema { \r public function handle() { \r } \r } \r',
                'type' => 'Schema',
            ],
            'seeder' => [
                'path' => app_path('Seeders/'),
                'namespace' => 'App\Seeders',
                'name' => 'make:seeder',
                'parentClass' => 'Lynx\System\Seeder\Seeder',
                'content' => '<?php \r namespace App\Seeders; \r use Lynx\System\Seeder\Seeder; \r class %s extends Seeder { \r public function handle() { \r } \r } \r',
                'type' => 'Seeder',
            ],
            'localization' => [
                'path' => app_path('Localization/'),
                'namespace' => '',
                'name' => 'make:localization',
                'parentClass' => '',
                'content' => "{\r}",
                'type' => 'Localization',
            ],
        ];
    }

    public static function initializeDynamicCommands()
    {
        $handler = new Handler();

        foreach($handler->register as $registered) {

            if(class_exists($registered)) {
                $commands[] = [
                    (string)$registered::$name => [
                        'path' => "",
                        'namespace' => "",
                        'name' => $registered::$command,
                        'parentClass' => "",
                        'content' => "",
                        'type' => 'CustomCommand',
                    ]
                ];
            } else {
                echo "\033[31m";
                echo "Lynx-Inventor Says: Class $registered does not exists.";
                echo "\033[0m";
                echo "\n";
                exit;
            }
        }
    }

    public function registerCommand()
    {
        self::initializeStaticCommands();
        self::initializeDynamicCommands();
    }

    public function create($args)
    {
        $countArguments = count($args);

        if ($countArguments == 2 || $countArguments == 3) {
            
            if ($args[0] == "inventor") {

                print_r(self::$commands);

            } else {
                self::text('Lynx-Inventor: could not open '.$args[0].'.','red');
            }

        } else {
            self::text('Lynx-Inventor: Invalid number of arguments in command.','red');
        }
    }








    public function create1($args)
    {
        

        

        if (count($args) == 3) {
 
            try {
                $alias = $args[0];
                $command = $args[1];
                $filename = ucfirst($args[2]);      
                $path = null;
                $namespace = null;
                $name = null;
                $content = null;
                $fileType = null;

                if ($alias === 'inventor') {

                    self::registerCommand();

                    foreach (self::$commands as $value)
                    {
                        if ($command === $value['name']) {
                            $path = $value['path'];
                            $namespace = $value['namespace'];
                            $name = $value['name'];
                            $content = sprintf($value['content'],$filename);
                            $fileType = $value['type'];
                        }
                    }

                    if ($path !== null && $namespace !== null && $name !== null && $content !== null && $fileType !== null) {

                        if ($fileType === 'View') {
                            $filename = strtolower($filename) . ".lynx.php";
                        } else if($fileType === 'Localization') {
                            $filename = strtolower($filename) . ".json";
                        } else {
                            $filename = $filename . ".php";
                        }

                        if (File::exists($path.$filename)) {
                            echo "\033[31m";
                            echo "Lynx-Inventor Says: File already exists: ".$path.$filename.".php.";
                            echo "\033[0m";
                            echo "\n";
                            exit;
                        } else {
                            File::createAndWrite($path.$filename,$content);
                            echo "\033[32m";
                            echo "$fileType created successfully.";
                            echo "\033[0m";
                        }

                    } else {
                        echo "\033[31m";
                        echo "Lynx-Inventor Says: Command you've entered is not valid.";
                        echo "\033[0m";
                        echo "\n";
                        echo "\033[33m";
                        echo "Lynx-Inventor Says: Did you mean one of these?";
                        echo "\033[0m";
                        echo "\n";
                        foreach ($commands as $key => $value) {
                                echo "\033[32m";
                                echo $value['name'];
                                echo "\033[0m";
                                echo "\n";
                        }
                        exit;
                    }
                  

                } else {
                    echo "\033[31m";
                    echo "Lynx-Inventor Says: Could not open input file: ".$args[0].".";
                    echo "\033[0m";
                    echo "\n";
                    exit;
                }

            }   catch (\Exception $e) {
                echo "\033[31m";
                echo "Lynx-Inventor Says: Command you've entered is not valid.";
                echo "\033[0m";
                echo "\n";
                exit;
            }
 
        } else {
            echo "\033[31m";
            echo "Lynx-Inventor Says: Command you've entered is not valid.";
            echo "\033[0m";
            echo "\n";
            exit;
        }
       

    }

    public static function registerCommand1()
    {
        $handler = new Handler();
        
        foreach($handler->register as $registered) {
            if(class_exists($registered)) {
                $commands[] = array(
                    'class' => $registered,
                    'name' => $registered::$name,
                    'command' => $registered::$command,
                    'custom' => true
                );
            } else {
                echo "\033[31m";
                echo "Lynx-Inventor Says: Class $registered does not exists.";
                echo "\033[0m";
                echo "\n";
                exit;
            }
        }
    }

    public function commands()
    {
         $middlewaresList = new Handler();

        if(!in_array($middleware, $middlewaresList->register)){
            return new ApplicationException("Class $middleware not found.", "Lynx/System/Exception/ApplicationException.php");
        }

        try {
            $middleware = new $middleware;
        } catch (\Throwable $th) {
            return new ApplicationException($th->getMessage(), "Lynx/System/Exception/ApplicationException.php");
        }

        try {
            if($middleware->handle(new Request, $condition)){
                $callback();
            }
        } catch (\Throwable $th) {
            return new ApplicationException($th->getMessage(), "Lynx/System/Exception/ApplicationException.php");
        }
    }
}