<?php

class Flow{

    static function redirect($name) {
        header('Location: '. $name . '/');
    }

}
