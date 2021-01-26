<?php

namespace Controle\Traits;

class HourTrait
{
    public static function correctHour($hour)
    {
        if (strtotime($hour) === false)
        $hour = date("H:i:s");

        return $hour;
    }
}