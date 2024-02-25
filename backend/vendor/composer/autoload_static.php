<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit612244f7d5cb020777273bdca73bc4a5
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Config\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit612244f7d5cb020777273bdca73bc4a5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit612244f7d5cb020777273bdca73bc4a5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit612244f7d5cb020777273bdca73bc4a5::$classMap;

        }, null, ClassLoader::class);
    }
}
