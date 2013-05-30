<?php
namespace mjburgess\paydays;

/**
 * Class PayDates
 * Model (Month, Year, PayDate, BonusDate)
 *
 * @package mjburgess\paydays
 */
class PayDates {
    /**
     * @var int (0..12)
     */
    private $month;
    /**
     * @var int %d%d%d%d
     */
    private $year;

    /**
     * @var timestamp
     */
    private $bonusDate;

    /**
     * @var timestamp
     */
    private $payDate;

    /**
     * @param $month
     * @param $year
     */
    public function __construct($month, $year) {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * If $timestamp > 0, returns the first of the month
     * otherwise returns the month (int 0 - 12) unmodified.
     *
     * @param int|bool $timestamp
     * @return int
     */
    public function getMonth($timestamp = false) {
        return $timestamp ? mktime(0,0,0, $this->month, 1, $this->year) : $this->month;
    }

    /**
     * If $timestamp > 0, return a date within $this->year
     * otherwise return the year (eg. 2013) unmodified.
     *
     * @param int|bool $timestamp
     * @return int
     */
    public function getYear($timestamp = false) {
        return $timestamp ? mktime(0,0,0, $this->month, 1, $this->year) : $this->year;
    }

    /**
     * @param int|timestamp $bonusDate
     */
    public function setBonusDate($bonusDate)
    {
        $this->bonusDate = $bonusDate;
    }

    /**
     * @param int|timestamp $payDate
     */
    public function setPayDate($payDate)
    {
        $this->payDate = $payDate;
    }

    /**
     * @param bool|string $format date() format string
     * @return timestamp
     */
    public function getPayDate($format = false)
    {
        return $format ? date($format, $this->payDate) : $this->payDate;
    }

    /**
     * @param bool|string $format date() format string
     * @return timestamp
     */
    public function getBonusDate($format = false)
    {
        return $format ? date($format, $this->bonusDate) : $this->bonusDate;
    }
}