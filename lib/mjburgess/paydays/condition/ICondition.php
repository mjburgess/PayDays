<?php
namespace mjburgess\paydays\condition;

/**
 * Class ICondition
 *
 * Applies a boolean test to a $timestamp
 *
 * @package mjburgess\paydays\condition
 */
interface ICondition {

    /**
     * Applies a boolean test to a $timestamp
     *
     * @param $timestamp
     * @return bool
     */
    public function tryDate($timestamp);
}
