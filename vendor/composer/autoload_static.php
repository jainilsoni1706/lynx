<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit98b2ef19afb75cc0917be9f0cf7a94db
{
    public static $files = array (
        'a2b367f2334d982895d9139c6d353751' => __DIR__ . '/..' . '/framework/System/General/General.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Lynx\\System\\' => 12,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Lynx\\System\\' => 
        array (
            0 => __DIR__ . '/..' . '/framework/System',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Commands\\Handler' => __DIR__ . '/../..' . '/app/Commands/Handler.php',
        'App\\Commands\\Spammer' => __DIR__ . '/../..' . '/app/Commands/Spammer.php',
        'App\\Commands\\Tester' => __DIR__ . '/../..' . '/app/Commands/Tester.php',
        'App\\Controllers\\Controller' => __DIR__ . '/../..' . '/app/Controllers/Controller.php',
        'App\\Controllers\\HomeController' => __DIR__ . '/../..' . '/app/Controllers/HomeController.php',
        'App\\Controllers\\Routable' => __DIR__ . '/../..' . '/app/Controllers/Routable.php',
        'App\\Controllers\\TestController' => __DIR__ . '/../..' . '/app/Controllers/TestController.php',
        'App\\Middleware\\Authenticable' => __DIR__ . '/../..' . '/app/Middleware/Authenticable.php',
        'App\\Middleware\\Handler' => __DIR__ . '/../..' . '/app/Middleware/Handler.php',
        'App\\Models\\User' => __DIR__ . '/../..' . '/app/Models/User.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Lynx\\System\\Cache\\Cache' => __DIR__ . '/..' . '/framework/System/Cache/Cache.php',
        'Lynx\\System\\Closure\\Closure' => __DIR__ . '/..' . '/framework/System/Closure/Closure.php',
        'Lynx\\System\\Console\\Console' => __DIR__ . '/..' . '/framework/System/Console/Console.php',
        'Lynx\\System\\Controller\\Controller' => __DIR__ . '/..' . '/framework/System/Controller/Controller.php',
        'Lynx\\System\\Database\\Connection\\Connect' => __DIR__ . '/..' . '/framework/System/Database/Connection/Connect.php',
        'Lynx\\System\\Database\\SQL\\DATASET' => __DIR__ . '/..' . '/framework/System/Database/SQL/DATASET.php',
        'Lynx\\System\\Debug\\Debugger' => __DIR__ . '/..' . '/framework/System/Debug/Debugger.php',
        'Lynx\\System\\Exception\\ApplicationException' => __DIR__ . '/..' . '/framework/System/Exception/ApplicationException.php',
        'Lynx\\System\\Exception\\LynxException' => __DIR__ . '/..' . '/framework/System/Exception/LynxException.php',
        'Lynx\\System\\File\\File' => __DIR__ . '/..' . '/framework/System/File/File.php',
        'Lynx\\System\\Http\\HttpAgent' => __DIR__ . '/..' . '/framework/System/Http/HttpAgent.php',
        'Lynx\\System\\Inventor\\Commands\\Inventor' => __DIR__ . '/..' . '/framework/System/Inventor/Commands/Inventor.php',
        'Lynx\\System\\Localization\\Lang' => __DIR__ . '/..' . '/framework/System/Localization/Lang.php',
        'Lynx\\System\\Log\\Log' => __DIR__ . '/..' . '/framework/System/Log/Log.php',
        'Lynx\\System\\Mail\\Mail' => __DIR__ . '/..' . '/framework/System/Mail/Mail.php',
        'Lynx\\System\\Middleware\\Middleware' => __DIR__ . '/..' . '/framework/System/Middleware/Middleware.php',
        'Lynx\\System\\Model\\Model' => __DIR__ . '/..' . '/framework/System/Model/Model.php',
        'Lynx\\System\\Phtml\\Phtml' => __DIR__ . '/..' . '/framework/System/Phtml/Phtml.php',
        'Lynx\\System\\Request\\Request' => __DIR__ . '/..' . '/framework/System/Request/Request.php',
        'Lynx\\System\\Routes\\Route' => __DIR__ . '/..' . '/framework/System/Routes/Route.php',
        'Lynx\\System\\Security\\FormProtection' => __DIR__ . '/..' . '/framework/System/Security/FormProtection.php',
        'Lynx\\System\\Session\\Session' => __DIR__ . '/..' . '/framework/System/Session/Session.php',
        'Lynx\\System\\Set\\Set' => __DIR__ . '/..' . '/framework/System/Set/Set.php',
        'Lynx\\System\\Streeng\\Streeng' => __DIR__ . '/..' . '/framework/System/Streeng/Streeng.php',
        'Lynx\\System\\View\\View' => __DIR__ . '/..' . '/framework/System/View/View.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit98b2ef19afb75cc0917be9f0cf7a94db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit98b2ef19afb75cc0917be9f0cf7a94db::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit98b2ef19afb75cc0917be9f0cf7a94db::$classMap;

        }, null, ClassLoader::class);
    }
}
