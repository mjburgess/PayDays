<?php
namespace mjburgess\paydays\transform;

class WeekdayDateTransform implements IDateTransform {
    const MONDAY    = 'monday';
    const TUESDAY   = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY  = 'thursday';
    const FRIDAY    = 'friday';

    const PREV = 'last';
    const NEXT = 'next';

    private $day;
    private $relation;

    public function __construct($day, $relation) {
        $this->day = $day;
        $this->relation = $relation;
    }

    public function apply($timestamp) {
        return strtotime($this->relation . ' ' . $this->day, $timestamp);
    }
}
