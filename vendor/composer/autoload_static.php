<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit98b2ef19afb75cc0917be9f0cf7a94db
{
    public static $files = array (
        'a2b367f2334d982895d9139c6d353751' => __DIR__ . '/..' . '/framework/System/General/General.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
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
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
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
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
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
