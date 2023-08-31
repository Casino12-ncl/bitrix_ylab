<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit53aed5382dc0ecde93b4daeb1d4be938
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit53aed5382dc0ecde93b4daeb1d4be938::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit53aed5382dc0ecde93b4daeb1d4be938::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit53aed5382dc0ecde93b4daeb1d4be938::$classMap;

        }, null, ClassLoader::class);
    }
}
