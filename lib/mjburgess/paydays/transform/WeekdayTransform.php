<?php
namespace mjburgess\paydays\transform;

use mjburgess\paydays\PayDates;

class WeekdayTransform implements IPayDatesTransform {
    private $bonusDayTransform;
    private $payDayTransform;

    public function __construct(IDateTransform $bdT, IDateTransform $pdT) {
        $this->bonusDayTransform = $bdT;
        $this->payDayTransform   = $pdT;
    }

    public function getPayDate($timestamp) {
        return $this->payDayTransform->apply($timestamp);
    }

    public function getBonusDate($timestamp) {
        return $this->bonusDayTransform->apply($timestamp);
    }

    public function __invoke(PayDates $p) {
        $p->setBonusDate($this->getBonusDate($p->getBonusDate()));
        $p->setPayDate($this->getPayDate($p->getPayDate()));

        return $p;
    }
}