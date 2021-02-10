<?php

namespace Controle\Report;

class CalcDays
{
    protected $hours;
    protected $minutes;
    protected $seconds;
    protected $days;
    protected $explode;

    public function __construct($hours)
    {
        $this->explode = explode(":",$hours);
        $this->hours = '00';
        $this->minutes = '00';
        $this->seconds = '00';
        $this->days = 0;
    }

    public function getDays(): array
    {
        if (count($this->explode) > 0) {
            $this->hours = $this->explode[0];
            $this->minutes = $this->explode[1];
            $this->seconds = $this->explode[2];
            $this->days = round($this->hours/24);


            if ($this->days > 0 ) {
                $h_left = (24 * $this->days) - $this->hours;

                if ($h_left < 10)
                    $this->hours = '0' . $h_left;
            }
        }
        return array(
            'days' => $this->days,
            'hours' => $this->hours,
            'minutes' => $this->minutes,
            'seconds' => $this->seconds
        );
    }
}