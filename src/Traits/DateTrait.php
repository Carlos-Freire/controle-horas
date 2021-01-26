<?php

namespace Controle\Traits;

trait DateTrait
{
    //garanto que o formato da data sempre seja o mesmo e a data seja válida
    public static function correctDate($date)
    {
        $newDate = date("d/m/Y");

        if (strrpos($date, "/")) {
            $tmp = explode("/",$date);
            $day = $tmp[0];
            $month = $tmp[1];
            $year = $tmp[2];
        }

        if (strrpos($date, "-")) {
            $tmp = explode("-",$date);
            $day = $tmp[2];
            $month = $tmp[1];
            $year = $tmp[0];
        }

        if (checkdate($month, $day, $year)) {
            $newDate = $day . '/' . $month . '/' . $year;
        }

        return $newDate;
    }

}