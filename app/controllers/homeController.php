<?php

require_once './app/models/homeModel.php';

class homeController{

    public function __construct(){
        
    }

    public function __destruct(){
        
    }

    public function omar($name){
        return View::CreateView('home',[
            'name' => $name,
            'title' => 'Título'
        ]);
    }



}
