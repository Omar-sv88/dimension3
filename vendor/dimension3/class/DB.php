<?php

class DB{

    /**
     * The db's driver.
     *
     * @var string
     */

    private $driver;

    /**
     * The mysql's host.
     *
     * @var string
     */
    
    private $host;

     /**
     * The mysql's db name.
     *
     * @var string
     */
    
    private $db;

     /**
     * The mysql's user.
     *
     * @var string
     */
    
    private $user;

     /**
     * The mysql's pass.
     *
     * @var string
     */
    
    private $pass;

     /**
     * The mysql's charset.
     *
     * @var string
     */
    
    private $charset;

     /**
     * The d3's perl.
     *
     * @var string
     */
    
    private $pl;

    /**
     * The d3's mode.
     *
     * @var string
     */

    private $mode;

    /**
     * The d3's function.
     *
     * @var string
     */
    
    private $function;

    /**
     * The token to authentify.
     *
     * @var string
     */
    
    private $token;

    /**
     * The user login on app.
     *
     * @var string
     */

    private $appUser;

    /**
     * The nri.
     *
     * @var string
     */

    private $nri;

    /**
     * The d3's params.
     *
     * @var array
     */
    
    private $params;

    /**
     * The d3's data search.
     *
     * @var string
     */

    private $search;

    /**
     * The d3's json encode and decode.
     *
     * @var number
     */

    private $json;

    public function __construct(){

        require_once DB_INCLUDES;
        $dbConfig           = require_once DB_CONFIG;
        $this->driver       = $dbConfig['driver'];
        $this->host         = $dbConfig['mysql']['host'];
        $this->db           = $dbConfig['mysql']['db'];
        $this->user         = $dbConfig['mysql']['user'];
        $this->pass         = $dbConfig['mysql']['pass'];
        $this->charset      = $dbConfig['mysql']['charset'];
        $this->pl           = $dbConfig['d3']['pl'];
        $this->function     = '';
        $this->token        = '';
        $this->mode         = '';
        $this->search       = '';
        $this->appUser      = '';
        $this->nri          = '';
        $this->params       = '';
        $this->json         = 0;

    }

    public function __destruct(){

        unset(
            $this->driver,
            $this->host,
            $this->db,
            $this->user,
            $this->pass,
            $this->charset,
            $this->conection,
            $this->pl,
            $this->function,
            $this->token,
            $this->mode,
            $this->search,
            $this->appUser,
            $this->nri,
            $this->json,
            $this->params
        );

    }

    /**
     * Mysql Conection.
     * 
     * We prepare the conection with the mysql server
     *
     * @return object
     */

    public function mysql(){

        $conection = new mysqli($this->host,$this->user,$this->pass,$this->db);
        $conection->query("SET NAMES '".$this->charset."'");
        $this->conection = $conection;
        return $conection;

    }

    /**
     * D3 Conection.
     * 
     * We connect to D3's db and make something you need
     *
     * @param  $prog = string
     * @param  $params = string  Separed with # Ej: data1#data2#data3#...
     * @param  $json = number   0 = no convert  1 = convert
     * @return array
     */

    public function d3($prog, $params, $json = 0){

        $command = $this->pl.' '.$prog.'#'.$params;
        echo $command.PHP_EOL;
        exit;
        $exec = exec($command,$result);
        if ($json == 1) { $result = Helper::json($result,'convert'); }
        return $result;

    }

    /**
     * Set mode on D3's db.
     * 
     * @param  $mode = string
     * @return void
     */

    public function mode($mode){

        $this->mode = $mode;
        return $this;

    }

    /**
     * Set token on D3's db.
     * 
     * @param  $token = string
     * @return void
     */

    public function token($token){

        $this->token = $token;
        return $this;

    }

    /**
     * Set param to search on D3's db.
     * 
     * @param  $data = string
     * @return void
     */

    public function search($data){

        $this->search = $data;
        return $this;

    }

    /**
     * Set function on D3's db.
     * 
     * @param  $function = string
     * @return void
     */

    public function function($function){

        $this->function = $function;
        return $this;

    }

    /**
     * Set json on D3's db.
     * 
     * @param  $json = number  0 = off 1 = on
     * @return void
     */

    public function json($json){

        $this->json = $json;
        return $this;

    }

     /**
     * Set params on D3's db.
     * 
     * @param  $params = array
     * @return void
     */

    public function params($params){

        $this->params = $params;
        return $this;

    }

    /**
     * Set app's user for D3's db.
     * 
     * @param  $params = array
     * @return void
     */

    public function user($appUser) {

        $this->appUser = $appUser;
        return $this;

    }

    /**
     * Set nri for D3's db.
     * 
     * @param  $params = array
     * @return void
     */

    public function nri($nri){

        $this->nri = $nri;
        return $this;

    }

    /**
     * Execute query on D3's db.
     * 
     * @return array
     */

    public function execute(){
        $sendParams = [
            $this->token,
            $this->appUser,
            $this->nri,
            $this->mode,
            $this->search
        ];
        $lock = 0;

        foreach ($this->params as $number => $param) {

            if (is_array($param)) {

                foreach ($param as $subparam) {
                    if ($lock == 0) { $subParam[] = $subparam; }
                }

                if ($lock == 0) {
                    $sendParams[$number + 5] = implode(chr(126), $subParam);
                }

                $lock = 1;
                unset($subParam);

            }
            else {

                $sendParams[] = $param;
                $lock = 0;

            }
        }

        $sendParams = implode('#', $sendParams);
        return $this->d3($this->function, $sendParams, $this->json);
        
    }

}
