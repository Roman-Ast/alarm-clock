<?php

namespace Clock;

class ClockState
{
    public $alarm_clock;

    public function __construct($alarm_clock)
    {
        $this->alarm_clock = $alarm_clock;
    }

    public function clickH()
    {
        $this->alarm_clock->hours = ($this->alarm_clock->hours + 1) % 24;
    }
    public function clickM()
    {
        if ($this->alarm_clock->minutes === 59) {
            $this->clickH();
        }
        $this->alarm_clock->minutes = ($this->alarm_clock->minutes + 1) % 60;
    }
}