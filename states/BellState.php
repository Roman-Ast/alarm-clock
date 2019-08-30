<?php

namespace Clock;

class BellState
{
    public $alarm_clock;

    public function __construct($alarm_clock)
    {
        $this->alarm_clock = $alarm_clock;
    }
    public function clickH()
    {
        return null;
    }
    public function clickM()
    {
        return null;
    }
    public function is_alarm_of()
    {
        if ($this->alarm_clock->alarm_minutes !== $this->alarm_clock->minutes
        || $this->alarm_clock->alarm_hours !== $this->alarm_clock->hours) {
            $this->alarm_clock->setState(ClockState::class);
        }
    }
}