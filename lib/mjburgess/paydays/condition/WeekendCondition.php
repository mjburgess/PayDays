<?php

namespace mjburgess\paydays\condition;


/**
 * Class WeekendCondition
 *
 * Tests to see if a timestamp is on a weekday
 *
 * @package mjburgess\paydays\condition
 */
class WeekendCondition implements ICondition {

    /**
     * Returns true if $timestamp is a weekday
     *
     * @param $timestamp
     * @return bool
     */
    public function tryDate($timestamp) {
        return !in_array(date('D', $timestamp), ['Sat', 'Sun']);
    }
}