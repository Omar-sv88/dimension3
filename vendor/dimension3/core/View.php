<?php

use Philo\Blade\Blade;

class View{

    /**
     * Create the view.
     *
     * This create the view and loads it
     *
     * @param  $viewName
     * @return void
     */

    public static function CreateView($viewName, $params = []) {

        if (isset($_REQUEST['api']) && !empty($_REQUEST['api'])){

            $blade = new Blade(API_VIEWS_DIR, CACHE_VIEWS_DIR);
            header('Content-Type: application/json');
            require_once './api/'.$viewName.'.view.php';

        }else {

            if (file_exists(VIEWS_DIR.'/'.$viewName.'.blade.php')) {

                $blade = new Blade(VIEWS_DIR, CACHE_VIEWS_DIR);
                echo $blade->view()->make($viewName, $params)->render();

            }else {

                echo "Error!! View no exists";
                exit;

            }

        }

    }

}
