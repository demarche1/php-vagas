<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit450d6d3430ae0840a614bef0ab708d91
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Root\\Html\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Root\\Html\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit450d6d3430ae0840a614bef0ab708d91::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit450d6d3430ae0840a614bef0ab708d91::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit450d6d3430ae0840a614bef0ab708d91::$classMap;

        }, null, ClassLoader::class);
    }
}
