<?php
namespace mjburgess\paydays\transform;

/**
 * Class PassDateTransform
 *
 * Returns the timestamp it is given.
 * For use with testing, or with Rules which do not modify timestamps.
 *
 * @package mjburgess\paydays\transform
 */
class PassDateTransform implements IDateTransform {

    /**
     * Returns its argument
     *
     * @param int|timestamp $timestamp
     * @return timestamp
     */
    public function apply($timestamp) {
        return $timestamp;
    }
}