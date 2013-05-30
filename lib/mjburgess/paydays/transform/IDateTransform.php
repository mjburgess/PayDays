<?php

namespace mjburgess\paydays\transform;

/**
 * Class IDateTransform
 *
 * Modifies a timestamp
 *
 *  timestamp -> timestamp'
 *
 * @package mjburgess\paydays\transform
 */
interface IDateTransform {
    /**
     * Takes a timestamp and returns a timestamp
     * (perhaps applying some operation to it)
     *
     * @param $timestamp
     */
    public function apply($timestamp);
}