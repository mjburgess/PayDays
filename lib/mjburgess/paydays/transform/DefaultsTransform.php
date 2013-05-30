<?php

namespace mjburgess\paydays\transform;

use mjburgess\paydays\PayDates;

/**
 * Class DefaultsTransform
 * When applied to a PayDate array, initializes bonus and payment dates.
 *
 * [PayDates(M,Y,0,0), ...] -> [PayDates(M,Y,default, default), ...]
 *
 * @package mjburgess\paydays\transform
 */
class DefaultsTransform implements  IPayDatesTransform {
    const LAST_DAY = 32;

    /**
     * @var int (0..31)
     */
    private $defaultBonusDate;

    /**
     * @var int (0..31)
     */
    private $defaultPayDate;

    /**
     * Default dates. Use self::LAST_DAY if the default should be
     * the last day of the month for a given PayDate
     *
     * @param int $bonusDate
     * @param int [$payDate = self::LAST_DAY]
     */
    public function __construct($bonusDate, $payDate = self::LAST_DAY) {
        $this->defaultBonusDate = $bonusDate;
        $this->defaultPayDate = $payDate;
    }

    /**
     * Returns the default bonus date for a $timestamp
     * with month/year information
     *
     * @param int|timestamp $timestamp
     * @return int timestamp
     */
    public function getBonusDate($timestamp) {
        if($this->defaultBonusDate == self::LAST_DAY) {
            return  mktime(0,0,0,date('m', $timestamp), $this->getLastDay($timestamp), date('Y', $timestamp));
        } else {
            return mktime(0,0,0,date('m', $timestamp), $this->defaultBonusDate, date('Y', $timestamp));
        }
    }

    /**
     * Returns the default payment date for a $timestamp
     * with month/year information
     *
     * @param int|timestamp $timestamp
     * @return int|timestamp
     */
    public function getPayDate($timestamp) {
        if($this->defaultPayDate == self::LAST_DAY) {
            return  mktime(0,0,0,date('m', $timestamp), $this->getLastDay($timestamp), date('Y', $timestamp));
        } else {
            return mktime(0,0,0,date('m', $timestamp), $this->defaultPayDate, date('Y', $timestamp));
        }
    }

    /**
     * Sets default bonus and payment dates on a PayDates
     *
     * @param PayDates $p
     * @return PayDates
     */
    public function __invoke(PayDates $p) {
        $ts = mktime(0,0,0, $p->getMonth(), 1, $p->getYear());

        $p->setBonusDate($this->getBonusDate($ts));
        $p->setPayDate($this->getPayDate($ts));

        return $p;
    }

    /**
     * Returns the last day of the month for a given $timestamp
     * with month information
     *
     * @param int|timestamp $timestamp
     * @return bool|string
     */
    private function getLastDay($timestamp) {
        return date('t', $timestamp);
    }
}
