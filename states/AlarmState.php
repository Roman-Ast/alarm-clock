<?php

namespace Clock;

class AlarmState
{
    public $alarm_clock;

    public function __construct($alarm_clock)
    {
        $this->alarm_clock = $alarm_clock;
    }

    public function clickH()
    {
        $this->alarm_clock->alarm_hours = ($this->alarm_clock->alarm_hours + 1) % 24;
    }
    public function clickM()
    {
        $this->alarm_clock->alarm_minutes = ($this->alarm_clock->alarm_minutes + 1) % 60;
    }
}