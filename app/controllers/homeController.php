<?php

require_once './app/models/homeModel.php';
use Dimension3\core\DB;

class homeController{

    public function __construct(){

    }

    public function __destruct(){

    }

    public function omar($name = null){

        $DB = new DB;
        $params = [
            'param 1',
            'param 2',
            [
                'subparam 3',
                'subparam 4'
            ]
        ];

        $query = $DB->function('Xlogin.5.support')
                    ->token('mytoken')
                    ->user('Omar')
                    ->nri('0000000000')
                    ->search('user')
                    ->mode('on')
                    ->params($params)
                    ->execute();

        return View::CreateView('home');

    }

}
