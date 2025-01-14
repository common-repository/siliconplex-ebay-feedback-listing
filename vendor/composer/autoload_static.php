<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5574fdaa2f1aab7f80cf671a22591bca
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SpEFLInc\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SpEFLInc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5574fdaa2f1aab7f80cf671a22591bca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5574fdaa2f1aab7f80cf671a22591bca::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
