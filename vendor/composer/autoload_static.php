<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit83c3466cffeeaea59739795e206e2c70
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Config' => __DIR__ . '/../..' . '/app/Config.php',
        'App\\Delivery' => __DIR__ . '/../..' . '/app/Delivery.php',
        'App\\Employee' => __DIR__ . '/../..' . '/app/Employee.php',
        'App\\Hangar' => __DIR__ . '/../..' . '/app/Hangar.php',
        'App\\SQLiteConnection' => __DIR__ . '/../..' . '/app/SQLiteConnection.php',
        'App\\SQLiteCreateTable' => __DIR__ . '/../..' . '/app/SQLiteCreateTable.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit83c3466cffeeaea59739795e206e2c70::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit83c3466cffeeaea59739795e206e2c70::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit83c3466cffeeaea59739795e206e2c70::$classMap;

        }, null, ClassLoader::class);
    }
}
