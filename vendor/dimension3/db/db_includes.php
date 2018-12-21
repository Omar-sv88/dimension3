<?php

    /*
    |--------------------------------------------------------------------------
    | Know host name
    |--------------------------------------------------------------------------
    |
    | We need to know the host name for connect to mysql host
    |
    */

    if (!defined(PHP_VERSION)) {

        //define('PHP_VERSION', phpversion());

        if (PHP_VERSION < 5.3) { define('NAME_HOST', php_uname('n')); }
        else { define('NAME_HOST', gethostname()); }

        if (NAME_HOST ==' morfeo.serverforisp.com') { define('DB_HOST', 'localhost'); }
        else { define('DB_HOST', '146.255.102.244'); }

    }
