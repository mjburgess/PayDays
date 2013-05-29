<?php
namespace mjburgess\paydays;

class PayDates {
    private $month;
    private $year;

    private $bonusDate;
    private $payDate;

    public function __construct($month, $year) {
        $this->month = $month;
        $this->year  = $year;
    }

    public function getMonth($timestamp = false) {
        return $timestamp ? mktime(0,0,0, $this->month, 1, $this->year) : $this->month;
    }

    public function getYear($timestamp = false) {
        return $timestamp ? mktime(0,0,0, $this->month, 1, $this->year) : $this->year;
    }

    /**
     * @param mixed $bonusDate
     */
    public function setBonusDate($bonusDate)
    {
        $this->bonusDate = $bonusDate;
    }

    /**
     * @param mixed $payDate
     */
    public function setPayDate($payDate)
    {
        $this->payDate = $payDate;
    }

    /**
     * @return mixed
     */
    public function getPayDate($format = false)
    {
        return $format ? date($format, $this->payDate) : $this->payDate;
    }

    /**
     * @return mixed
     */
    public function getBonusDate($format = false)
    {
        return $format ? date($format, $this->bonusDate) : $this->bonusDate;
    }
}