<?php
namespace mjburgess\paydays\transform;

/**
 * Class WeekdayDateTransform
 *
 * Generates a timestamp a weekday later or earlier,
 *  depending on the supplied criteria
 *
 * @package mjburgess\paydays\transform
 */
class WeekdayDateTransform implements IDateTransform {
    const MONDAY    = 'monday';
    const TUESDAY   = 'tuesday';
    const WEDNESDAY = 'wednesday';
    const THURSDAY  = 'thursday';
    const FRIDAY    = 'friday';

    const PREV = 'last';
    const NEXT = 'next';

    /**
     * @var self::MONDAY..self::FRIDAY
     */
    private $day;

    /**
     * @var self::PREV, self::NEXT
     */
    private $relation;

    /**
     * @param $day self::MONDAY..self::FRIDAY
     * @param $relation self::PREV, self::NEXT
     */
    public function __construct($day, $relation) {
        $this->day = $day;
        $this->relation = $relation;
    }

    /**
     * Return the next/previous ($this->relation) weekday ($this->day)
     *
     * @param int|timestamp $timestamp
     * @return int timestamp
     */
    public function apply($timestamp) {
        return strtotime($this->relation . ' ' . $this->day, $timestamp);
    }
}
