<?php

    /**
     * Dimension 3 - PHP Framework
     *
     * @package  Dimension3
     * @author   Developer CloudXData <dev@cloudxdata.com>
     */

    define('DIMENSION3_START', microtime(true));

    /*
    |--------------------------------------------------------------------------
    | Include config file
    |--------------------------------------------------------------------------
    |
    | We need to include some config for work correctly
    |
    */

    require_once './vendor/dimension3/config/config.php';

    /*
    |--------------------------------------------------------------------------
    | Include app's config file
    |--------------------------------------------------------------------------
    |
    | We need to include the app's config for work correctly
    |
    */

    require_once CONFIG_APP;

    require_once './vendor/autoload.php';

    require_once './vendor/middleware/index.php';

    require_once './vendor/ctoken_library/index.php';

    /*
    |--------------------------------------------------------------------------
    | Class Autoload
    |--------------------------------------------------------------------------
    |
    | We provide an autoload for all the class. This load all the
    | class automatically
    |
    */

    spl_autoload_register (function($class){
        if(file_exists(CLASS_DIR.$class.'.php')){
            require_once CLASS_DIR.$class.'.php';
        }
    });

    /*
    |--------------------------------------------------------------------------
    | App's Controllers Autoload
    |--------------------------------------------------------------------------
    |
    | We provide an autoload the app's controllers. This load all the
    | controllers automatically
    |
    */

    spl_autoload_register (function($controller){
        if(file_exists(APP_CONTROLLER_DIR.$controller.'.php')){
            require_once APP_CONTROLLER_DIR.$controller.'.php';
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Include core's routes file
    |--------------------------------------------------------------------------
    |
    | We need to load the core's routes file to manage all the routes
    |
    */

    require_once CORE_ROUTES_DIR;

    /*
    |--------------------------------------------------------------------------
    | Include routes file
    |--------------------------------------------------------------------------
    |
    | We need to load the routes file to manage all the routes
    |
    */

    require_once API_ROUTES_DIR;

    require_once './vendor/middleware/include.php';
