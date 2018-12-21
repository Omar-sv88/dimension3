<?php

class Helper{

    /**
     * Date format.
     *
     * You can enter a date format and change it to dd.mm.yyyy with the
     * separator you can choose
     *
     * @param  $date = yyyy-mm-dd
     * @param  $separator = string
     * @return string
     */

    static function date($date, $separator){

        $date = explode('-', $date);
        $day = $date[2];
        $month = helperController::getMonth($date[1]);
        $year = $date[0];
        $date = [
            $day,
            $month,
            $year
        ];
        $return = implode(' '.$separator.' ', $date);
        unset($date, $day, $year, $month);
        return $return;

    }

    /**
     * Get month's name.
     *
     * You can enter month's number and returns the name
     * Default's name are in spanish
     *
     * @param  $month = number or string
     * @return string
     */

    static function getMonth($month){

        if ($month == "01" || $month == 1){ $month = "enero"; }
        else if ($month == "02" || $month == 2){ $month = "febrero"; }
        else if ($month == "03" || $month == 3){ $month = "marzo"; }
        else if ($month == "04" || $month == 4){ $month = "abril"; }
        else if ($month == "05" || $month == 5){ $month = "mayo"; }
        else if ($month == "06" || $month == 6){ $month = "junio"; }
        else if ($month == "07" || $month == 7){ $month = "julio"; }
        else if ($month == "08" || $month == 8){ $month = "agosto"; }
        else if ($month == "09" || $month == 9){ $month = "septiembre"; }
        else if ($month == "10" || $month == 10){ $month = "octubre"; }
        else if ($month == "11" || $month == 11){ $month = "noviembre"; }
        else if ($month == "12" || $month == 12){ $month = "diciembre"; }
        return $month;

    }

    /**
     * Sanitize texts.
     *
     * You can sanitize the texts from sql inyection and special chars
     *
     * @param  $data = string
     * @return string
     */

    static function sanitizeText($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }

    /**
     * Json formater.
     *
     * You can format an array in json
     *
     * @param  $data = string
     * @param  $mode = string  convert | deconvert
     * @return string
     */

    static function json($data,$mode){

        switch ($mode) {
                case 'convert':

                        $data = json_encode($data);

                break;

                case 'deconvert':

                break;
        }

        return $data;

    }

}
