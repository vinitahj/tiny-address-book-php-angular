<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit105ff9686800fa801d5aac984d8b7f86
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit105ff9686800fa801d5aac984d8b7f86', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit105ff9686800fa801d5aac984d8b7f86', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit105ff9686800fa801d5aac984d8b7f86::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
