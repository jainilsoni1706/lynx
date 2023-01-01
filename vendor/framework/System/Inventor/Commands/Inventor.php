<?php

namespace Lynx\System\Inventor\Commands;

use Lynx\System\File\File;

class Inventor {

    public static function make($args)
    {
        self::create($args);
    }

    public function create($args)
    {
        $commands = [
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
                'parentClass' => 'Lynx\System\Command\Command',
                'content' => "<?php \rnamespace App\Commands; \r\ruse Lynx\System\Command\Command; \r\rclass %s extends Command \r{ \r\tpublic function handle() \r\t{ \r\t} \r} \r",
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

                    foreach ($commands as $value)
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
}