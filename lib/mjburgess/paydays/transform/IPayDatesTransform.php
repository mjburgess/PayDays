<?php
namespace mjburgess\paydays\transform;

use mjburgess\paydays\PayDates;

/**
 * Class IPayDatesTransform
 *
 * Modifies a PayDates
 *
 *  PayDates -> PayDates'
 *
 * @package mjburgess\paydays\transform
 */
interface IPayDatesTransform {
    /**
     * Return a bonus date for a given $timestamp
     * encoding month/year information
     *
     * @param $timestamp
     * @return timestamp
     */
    public function getBonusDate($timestamp);

    /**
     * Return a pay date for a given $timestamp,
     * encoding month/year information
     *
     * @param $timestamp
     * @return timestamp
     */
    public function getPayDate($timestamp);

    /**
     * Set Bonus/Payment dates on a PayDates using
     * the corresponding getters on $this
     *
     * @param PayDates $p
     * @return PayDates
     */
    public function __invoke(PayDates $p);
}
