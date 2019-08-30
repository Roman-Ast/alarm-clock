<?php

namespace Clock;

use Clock\AlarmState;
use Clock\BellState;
use Clock\ClockState;

require __DIR__ . '/vendor/autoload.php';


class AlarmClock
{
    public $current_state;
    public $alarm_on;
    public $hours;
    public $alarm_hours;
    public $minutes;
    public $alarm_minutes;

    public function __construct()
    {
        $this->alarm_on = false;
        $this->hours = 12;
        $this->alarm_hours = 6;
        $this->minutes = 0;
        $this->alarm_minutes = 0;
        $this->setState(ClockState::class);
    }
    public function setState($className)
    {
        $this->current_state = new $className($this);
    }
    public function clickMode()
    {
        if ($this->isAlarmTime() && $this->alarm_on) {
            $this->setState(ClockState::class);
            $this->alarm_on = false;
            return;
        }
        get_class($this->current_state) === 'ClockState' ?
        $this->setState(AlarmState::class) : 
        $this->setState(ClockState::class);
    }
    public function longClickMode()
    {
      $this->alarm_on = $this->alarm_on === false ? true : false;
    }
    public function clickH()
    {
        $this->current_state->clickH();
    }
    public function clickM()
    {   
        $this->current_state->clickM();
    }
    public function tick()
    {
        if ($this->minutes === 59) {
            $this->hours = ($this->hours + 1) % 24;
        }
        $this->minutes = ($this->minutes + 1) % 60;
        $this->isAlarmTime();
        if (get_class($this->current_state) === 'BellState') {
            $this->current_state->is_alarm_of();
        }
    }
    public function getCurrentMode()
    {
        $states = [
            'Clock\ClockState' => 'clock',
            'Clock\AlarmState' => 'alarm',
            'Clock\BellState' => 'bell'
        ];
        return $states[get_class($this->current_state)];
    }
    public function getMinutes()
    {
        return $this->minutes;
    }
    public function getHours()
    {
        return $this->hours;
    }
    public function getAlarmMinutes()
    {
        return $this->alarm_minutes;
    }
    public function getAlarmHours()
    {
        return $this->alarm_hours;
    }
    public function isAlarmOn()
    {
        return $this->alarm_on;
    }
    public function isAlarmTime()
    {
        if ($this->alarm_minutes === $this->minutes
        && $this->alarm_hours === $this->hours) {
            if ($this->alarm_on) {
                $this->setState(BellState::class); 
                return true;
            }
            return true;
        }
        return false;
    }
}







/*$clock = new AlarmClock();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");
print_r("\n");
$clock->clickMode();
$clock->tick();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");
print_r("\n");
$clock->clickMode();
$clock->tick();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");
print_r("\n");
$clock->longClickMode();
$clock->tick();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");
print_r("\n");
$clock->clickMode();
$clock->tick();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");
print_r("\n");
$clock->clickMode();
$clock->tick();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");
print_r("\n");
$clock->longClickMode();
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");*/

/*$clock = new AlarmClock();
$clock->clickMode();
print_r($clock->getCurrentMode()."\n");
for ($i = 0; $i < 18 * 60; $i++) {
    $clock->tick();
}
var_dump($clock->isAlarmTime());
var_dump($clock->isAlarmOn());
print_r($clock->getCurrentMode()."\n");

$clock->clickMode();
$clock->tick();
print_r($clock->getCurrentMode()."\n");*/

/*$clock = new AlarmClock();

$clock->clickH();
print_r($clock->getMinutes()."\n");
print_r($clock->getHours()."\n");
print_r($clock->getAlarmHours()."\n");
print_r($clock->getAlarmMinutes()."\n");

print_r("\n");

$clock->clickM();
print_r($clock->getMinutes()."\n");
print_r($clock->getHours()."\n");
print_r($clock->getAlarmHours()."\n");
print_r($clock->getAlarmMinutes()."\n");

print_r("\n");

$clock->clickMode();

$clock->clickH();
print_r($clock->getMinutes()."\n");
print_r($clock->getHours()."\n");
print_r($clock->getAlarmHours()."\n");
print_r($clock->getAlarmMinutes()."\n");

print_r("\n");

$clock->clickM();
print_r($clock->getMinutes()."\n");
print_r($clock->getHours()."\n");
print_r($clock->getAlarmHours()."\n");
print_r($clock->getAlarmMinutes()."\n");

for ($i = 0; $i < 60; $i++) {
    $clock->clickM();
}

print_r("\n");

print_r($clock->getAlarmHours()."\n");
print_r($clock->getAlarmMinutes()."\n");

print_r("\n");

for ($i = 0; $i < 17; $i++) {
    $clock->clickH();
}
print_r($clock->getAlarmHours()."\n");*/

$clock = new AlarmClock();
$clock->longClickMode();
for ($i = 0; $i < 18 * 60; $i++) {
    $clock->tick();
}
var_dump($clock->isAlarmTime());
print_r($clock->getCurrentMode()."\n");
$clock->clickM();
$clock->clickH();
$clock->tick();
print_r($clock->getCurrentMode()."\n");