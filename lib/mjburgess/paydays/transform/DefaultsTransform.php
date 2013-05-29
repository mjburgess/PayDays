<?php

namespace mjburgess\paydays\transform;

use mjburgess\paydays\PayDates;

class DefaultsTransform implements  IPayDatesTransform {
    const LAST_DAY = 32;

    private $defaultBonusDate;
    private $defaultPayDate;

    public function __construct($bonusDate, $payDate = self::LAST_DAY) {
        $this->defaultBonusDate = $bonusDate;
        $this->defaultPayDate = $payDate;
    }

    public function getBonusDate($timestamp) {
        if($this->defaultBonusDate == self::LAST_DAY) {
            return  mktime(0,0,0,date('m', $timestamp), $this->getLastDay($timestamp), date('Y', $timestamp));
        } else {
            return mktime(0,0,0,date('m', $timestamp), $this->defaultBonusDate, date('Y', $timestamp));
        }
    }
    public function getPayDate($timestamp) {
        if($this->defaultPayDate == self::LAST_DAY) {
            return  mktime(0,0,0,date('m', $timestamp), $this->getLastDay($timestamp), date('Y', $timestamp));
        } else {
            return mktime(0,0,0,date('m', $timestamp), $this->defaultPayDate, date('Y', $timestamp));
        }
    }

    public function __invoke(PayDates $p) {
        $ts = mktime(0,0,0, $p->getMonth(), 1, $p->getYear());

        $p->setBonusDate($this->getBonusDate($ts));
        $p->setPayDate($this->getPayDate($ts));

        return $p;
    }

    private function getLastDay($timestamp) {
        return date('t', $timestamp);
    }
}
