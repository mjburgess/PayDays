<?php
namespace mjburgess\paydays\transform;

use mjburgess\paydays\PayDates;

interface IPayDatesTransform {
    public function getBonusDate($timestamp);
    public function getPayDate($timestamp);

    public function __invoke(PayDates $p);
}
