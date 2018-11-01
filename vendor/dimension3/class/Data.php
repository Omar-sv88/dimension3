<?php

class Data{

    /**
     * Obtain GET params.
     * 
     * You can obtain GET params
     *
     * @param  $name
     * @return string
     */

    public static function getParams($name = 'data'){

        $return = null;
        if (isset($_GET[$name])) { $return = $_GET[$name]; }           
        return $return;

    }

    /**
     * Obtain POST params.
     * 
     * You can obtain POST params
     *
     * @param  $name
     * @return string
     */

    public static function postParams($name){

        $return = null;
        if (isset($_POST[$name])) { $return = $_POST[$name]; }           
        return $return;

    }

    /**
     * Obtain REQUEST params.
     * 
     * You can obtain REQUEST params
     *
     * @param  $name
     * @return string
     */

    public static function requestParams($name){

        $return = null;
        if (isset($_REQUEST[$name])) { $return = $_REQUEST[$name]; }           
        return $return;

    }



}
