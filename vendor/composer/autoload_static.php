<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce559b9fbd0e097bccee77e6c3cc8be1
{
    public static $files = array (
        'e8aa6e4b5a1db2f56ae794f1505391a8' => __DIR__ . '/..' . '/amphp/amp/lib/functions.php',
        '76cd0796156622033397994f25b0d8fc' => __DIR__ . '/..' . '/amphp/amp/lib/Internal/functions.php',
        '6cd5651c4fef5ed6b63e8d8b8ffbf3cc' => __DIR__ . '/..' . '/amphp/byte-stream/lib/functions.php',
        '8dc56fe697ca93c4b40d876df1c94584' => __DIR__ . '/..' . '/amphp/process/lib/functions.php',
        '3da389f428d8ee50333e4391c3f45046' => __DIR__ . '/..' . '/amphp/serialization/src/functions.php',
        'bcb7d4fc55f4b1a7e10f5806723e9892' => __DIR__ . '/..' . '/amphp/sync/src/functions.php',
        'e187e371b30897d6dc51cac6a8c94ff6' => __DIR__ . '/..' . '/amphp/sync/src/ConcurrentIterator/functions.php',
        '445532134d762b3cbc25500cac266092' => __DIR__ . '/..' . '/daverandom/libdns/src/functions.php',
        '7ebf029ad4b246f1e3f66192b40a932f' => __DIR__ . '/..' . '/amphp/dns/lib/functions.php',
        'e1e8b49c332434256b5df11b0f0c2a62' => __DIR__ . '/..' . '/league/uri-parser/src/functions_include.php',
        'd4e415514e4352172d58f02433fa50e4' => __DIR__ . '/..' . '/amphp/socket/src/functions.php',
        '1c2dcb9d6851a7abaae89f9586ddd460' => __DIR__ . '/..' . '/amphp/socket/src/Internal/functions.php',
        '73cfe662a9f753fb79cdfcb7b4206d43' => __DIR__ . '/..' . '/amphp/mysql/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LibDNS\\' => 7,
            'League\\Uri\\' => 11,
        ),
        'K' => 
        array (
            'Kelunik\\Certificate\\' => 20,
        ),
        'A' => 
        array (
            'Amp\\WindowsRegistry\\' => 20,
            'Amp\\Sync\\' => 9,
            'Amp\\Sql\\Common\\' => 15,
            'Amp\\Sql\\' => 8,
            'Amp\\Socket\\' => 11,
            'Amp\\Serialization\\' => 18,
            'Amp\\Process\\' => 12,
            'Amp\\Parser\\' => 11,
            'Amp\\Mysql\\' => 10,
            'Amp\\Dns\\' => 8,
            'Amp\\Cache\\' => 10,
            'Amp\\ByteStream\\' => 15,
            'Amp\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LibDNS\\' => 
        array (
            0 => __DIR__ . '/..' . '/daverandom/libdns/src',
        ),
        'League\\Uri\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/uri-parser/src',
        ),
        'Kelunik\\Certificate\\' => 
        array (
            0 => __DIR__ . '/..' . '/kelunik/certificate/src',
        ),
        'Amp\\WindowsRegistry\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/windows-registry/lib',
        ),
        'Amp\\Sync\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/sync/src',
        ),
        'Amp\\Sql\\Common\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/sql-common/src',
        ),
        'Amp\\Sql\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/sql/src',
        ),
        'Amp\\Socket\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/socket/src',
        ),
        'Amp\\Serialization\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/serialization/src',
        ),
        'Amp\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/process/lib',
        ),
        'Amp\\Parser\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/parser/src',
        ),
        'Amp\\Mysql\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/mysql/src',
        ),
        'Amp\\Dns\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/dns/lib',
        ),
        'Amp\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/cache/lib',
        ),
        'Amp\\ByteStream\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/byte-stream/lib',
        ),
        'Amp\\' => 
        array (
            0 => __DIR__ . '/..' . '/amphp/amp/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce559b9fbd0e097bccee77e6c3cc8be1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce559b9fbd0e097bccee77e6c3cc8be1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce559b9fbd0e097bccee77e6c3cc8be1::$classMap;

        }, null, ClassLoader::class);
    }
}