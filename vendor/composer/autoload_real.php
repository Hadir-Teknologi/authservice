<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit18bb69a51a80621fee0723ff14b2cc6f
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

        spl_autoload_register(array('ComposerAutoloaderInit18bb69a51a80621fee0723ff14b2cc6f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit18bb69a51a80621fee0723ff14b2cc6f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit18bb69a51a80621fee0723ff14b2cc6f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
