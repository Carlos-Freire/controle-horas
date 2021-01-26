<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3f15234347b0ea8ca198362ad02fc8ad
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Controle\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Controle\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Controle\\Controllers\\Controller' => __DIR__ . '/../..' . '/src/Controllers/Controller.php',
        'Controle\\Controllers\\IndexController' => __DIR__ . '/../..' . '/src/Controllers/IndexController.php',
        'Controle\\Controllers\\Router' => __DIR__ . '/../..' . '/src/Controllers/Router.php',
        'Controle\\Database\\Connection' => __DIR__ . '/../..' . '/src/Database/Connection.php',
        'Controle\\Database\\Database' => __DIR__ . '/../..' . '/src/Database/Database.php',
        'Controle\\Filters\\ControleFilter' => __DIR__ . '/../..' . '/src/Filters/ControleFilter.php',
        'Controle\\Models\\Controle' => __DIR__ . '/../..' . '/src/Models/Controle.php',
        'Controle\\Models\\Model' => __DIR__ . '/../..' . '/src/Models/Model.php',
        'Controle\\Repositories\\ControleRepository' => __DIR__ . '/../..' . '/src/Repositories/ControleRepository.php',
        'Controle\\Traits\\DateTrait' => __DIR__ . '/../..' . '/src/Traits/DateTrait.php',
        'Controle\\Views\\View' => __DIR__ . '/../..' . '/src/Views/View.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3f15234347b0ea8ca198362ad02fc8ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3f15234347b0ea8ca198362ad02fc8ad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3f15234347b0ea8ca198362ad02fc8ad::$classMap;

        }, null, ClassLoader::class);
    }
}
