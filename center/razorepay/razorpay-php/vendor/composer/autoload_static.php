<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite5aa22905576b6bad8f51f91955e120f
{
    public static $files = array (
        '6bc45d0537e6858fd179bdbc31d62c79' => __DIR__ . '/..' . '/raveren/kint/Kint.class.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Razorpay\\Tests\\' => 15,
            'Razorpay\\Api\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Razorpay\\Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Razorpay\\Api\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'Requests' => 
            array (
                0 => __DIR__ . '/..' . '/rmccue/requests/library',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite5aa22905576b6bad8f51f91955e120f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite5aa22905576b6bad8f51f91955e120f::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInite5aa22905576b6bad8f51f91955e120f::$prefixesPsr0;
            $loader->classMap = ComposerStaticInite5aa22905576b6bad8f51f91955e120f::$classMap;

        }, null, ClassLoader::class);
    }
}
