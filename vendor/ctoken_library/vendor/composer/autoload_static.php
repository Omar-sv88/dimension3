<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba817b3469d4b0a5e5fb9a4e4c738290
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitba817b3469d4b0a5e5fb9a4e4c738290::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba817b3469d4b0a5e5fb9a4e4c738290::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
