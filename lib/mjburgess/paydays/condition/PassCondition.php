<?php
namespace mjburgess\paydays\condition;

/**
 * Class PassCondition
 *
 *  casts a timestamp to its corresponding bool
 *
 *  For use with testing and Rules which apply to all non-zero $timestamps
 *
 * @package mjburgess\paydays\condition
 */
class PassCondition implements ICondition {
    /**
     * Returns (bool) $timestamp
     *
     * @param $timestamp
     * @return bool
     */
    public function tryDate($timestamp) {
        return (bool) $timestamp;
    }
}