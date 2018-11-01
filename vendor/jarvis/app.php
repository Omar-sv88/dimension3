<?php

class App {

    /**
     * The argument's passing in console.
     *
     * @var array
     */

    private $_ARGUMENTS;

    /**
     * Construct's class
     *
     * @return string
     */

     public function __construct($argv){

        echo 'Welcome to Jarvis!'.PHP_EOL;
        echo "Loading App's Core...".PHP_EOL;
        $this->_ARGUMENTS = $this->arguments($argv);
        echo "App's Core loaded...".PHP_EOL.PHP_EOL;

     }

     /**
     * Destruct's class
     *
     * @return string
     */

     public function __destruct(){

        echo PHP_EOL."Removing App's Core...".PHP_EOL;
        unset($this->_ARGUMENTS);
        echo "Removed App's Core...".PHP_EOL;
        echo "Bye :)".PHP_EOL.PHP_EOL;

     }

    /**
     * Explode arguments passing by console.
     *
     * @param  $argv = array();
     * @return array
     */

    public function arguments($argv) {

        $_ARG = array();

        foreach ($argv as $i => $arg) {

            switch ($i){

                case 1:
                    $explode_action = explode(':', $arg);
                    $_ARG['command'] = $explode_action[0];
                    $_ARG['option'] = $explode_action[1];
                break;

                case 2:
                    $_ARG['name'] = $arg;
                break;

                case 3:
                    $_ARG['platform'] =  $arg;
                break;

            }

        }

        $_ARG['command'] = (empty($_ARG['command'])) ? '': $_ARG['command'];
        $_ARG['platform'] = (!isset($_ARG['platform'])) ? 'core': $_ARG['platform'];
        return $_ARG;

    }

    /**
     * Create controllers and models.
     *
     * @param  $component = string   controller/model;
     * @return string
     */

    public function create($component) {

        $name = $this->_ARGUMENTS['name'].ucwords($component).'.php';

        switch ($component) {

            case 'controller':
                echo 'Creating '. $name. ' ' .PHP_EOL;
                $dir = APP_CONTROLLER_DIR.$name;
                $fileToCreate = APP_CONTROLLER_DIR.$this->_ARGUMENTS['name'].'Controller.php';
                $changes = [
                    [
                        'search'    => "inputName",
                        'replace'   => $this->_ARGUMENTS['name']
                    ]
                ];
                if(file_exists($dir)){ $message = "File $name exists"; }
                else {

                    if (fopen($dir,'w+')){

                        if (copy(CONTROLLER_THEME, $fileToCreate)){
                            $file = fopen($fileToCreate, 'r');
                            while (!feof($file)){ $line[] = fgets($file); }
                            fclose($file);
                            $file = fopen($fileToCreate,'w+');
                            foreach ($line as $arg){

                                $arg = str_replace($changes[0]['search'], $changes['0']['replace'], $arg);
                                fwrite($file, $arg);

                            }

                            fclose($file);
                            $file = fopen(CONTROLLER_CHARGER, 'a');
                            fwrite($file, PHP_EOL.'    $_'. $this->_ARGUMENTS['name'] . ' = new '. $this->_ARGUMENTS['name'].ucwords($component) . ';'.PHP_EOL);
                            fclose($file);
                            $message = "File $name created";

                        }else { $message = "Error creating $name"; }
                    }else { $message = "Can't create file $name"; }
                }
                echo $message.PHP_EOL;
            break;

            case 'model':
                echo 'Creating '. $name. ' ' .PHP_EOL;
                $dir = APP_MODEL_DIR.$name;
                $fileToCreate = APP_MODEL_DIR.$this->_ARGUMENTS['name'].'Model.php';
                $changes = [
                    [
                        'search'    => "inputNameModel",
                        'replace'   => $this->_ARGUMENTS['name'].'Model'
                    ],
                ];
                if(file_exists($dir)){ $message = "File $name exists"; }
                else {

                    if (fopen($dir,'w+')){

                        if (copy(MODEL_THEME, $fileToCreate)){

                            $file = fopen($fileToCreate, 'r');
                            while (!feof($file)){ $line[] = fgets($file); }
                            fclose($file);
                            $file = fopen($fileToCreate,'w+');
                            foreach ($line as $arg){

                                $arg = str_replace($changes[0]['search'], $changes[0]['replace'], $arg);
                                fwrite($file, $arg);

                            }
                            fclose($file);
                            $message = "File $name created";
                        }else { $message = "Error creating $name"; }
                    }else { $message = "Can't create file $name"; }
                }
                echo $message.PHP_EOL;
            break;

            case 'api':
                echo 'Creando API '. $this->_ARGUMENTS['name'];
            break;

        }

    }

    /**
     * Remove controllers and models.
     *
     * @param  $component = string   controller/model;
     * @return string
     */

     public function remove($component) {

        $name = $this->_ARGUMENTS['name'].ucwords($component).'.php';
        $changes = [
            'search'    => '$_'. $this->_ARGUMENTS['name'] . ' = new '. $this->_ARGUMENTS['name'].ucwords($component) . ';'.PHP_EOL,
            'replace'   => null
        ];

        switch ($component){

            case 'controller':
                $dir = APP_CONTROLLER_DIR.$name;
            break;

            case 'model':
                $dir = APP_MODEL_DIR.$name;
            break;

        }

        if (file_exists($dir)) {

            if (unlink($dir)) {

                $file = fopen(CONTROLLER_CHARGER, 'r');
                while (!feof($file)){ $line[] = fgets($file); }
                fclose($file);
                $file = fopen(CONTROLLER_CHARGER,'w+');
                foreach ($line as $arg){

                    $arg = str_replace($changes['search'], $changes['replace'], $arg);
                    fwrite($file, $arg);

                }
                fclose($file);

                $message = "File $name removed";

            }
            else { $message = "File $name not removed!"; }

        }else { $message = "File $name not found!"; }

        echo $message.PHP_EOL;

     }

    /**
     * Add data to file in a default point.
     *
     * @param  $filePath = string
     * @param  $search = string
     * @param  $data = string
     * @return bool
     */

    public function addDataFile($filePath,$search,$data){

        $file = fopen($filePath, 'r');
        while (!feof($file)){ $buffer[] = fgets($file, 4096); }
        fclose($file);
        $file = fopen($filePath, 'w+');

        foreach ($buffer as $line){

            if (trim($line) == $search){

                fwrite($file, $search.PHP_EOL);
                fwrite($file, $data.PHP_EOL);

            }else { fwrite($file, $line); }

        }

        fclose($file);
        echo 'Added '.$data.' in '.$filePath.PHP_EOL;

    }

    /**
     * Print Copyright Information.
     *
     * @return string
     */

    public function getCopyritght(){

        $copyright = [
            FRAMEWORK_NAME.' '.FRAMEWORK_VERSION,
            'By '.DEVELOPER_FRAMEWORK
        ];
        foreach ($copyright as $textWrite) { echo $textWrite.PHP_EOL; }

    }

    /**
     * Manage htaccess's file.
     *
     * @return void
     */

    public function manageHtaccess($name){

        $explodeName = explode(':', $name);
        $name = $explodeName[0];
        $controller = $explodeName[1];
        unset($explodeName);

        if (empty($controller)) {
            echo 'No controller selected!'.PHP_EOL;
            exit;
        }

        $file = fopen(HTACCESS_ROUTE_THEME, 'r');
        while (!feof($file)){ $line = fgets($file); }
        fclose($file);
        $line = str_replace('nameInput', $name, $line);
        $this->addDataFile('./.htaccess', '### USER INSERT ###', $line);

    }

    /**
     * Manage views.
     *
     * @param $option = string
     * @param $name = string
     * @param $platform = string
     * @return void
     */

     public function view($option, $name, $platform){

        switch ($platform){

            case 'api':
                $file = API_VIEWS_DIR.$name.'.blade.php';
            break;

            case 'core':
                $file = VIEWS_DIR.$name.'.blade.php';
            break;

        }

        switch ($option){

            case 'create':
                if(file_exists($file)){ $message = "View $name exists"; }
                else {

                    if (fopen($file, 'w+')){ $message = "View $name created!"; }
                    else { $message = "Can't create view $name"; }

                }

                echo $message.PHP_EOL;
            break;

            case 'remove':
                if(file_exists($file)){
                    if (unlink($file)){ $message = "View $name removed"; }
                    else { $message = "Can't remove view $name"; }
                }
                else { $message = "View $name not exists"; }

                echo $message.PHP_EOL;
            break;

        }

     }

}
