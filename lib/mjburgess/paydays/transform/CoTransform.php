<?php
namespace mjburgess\paydays\transform;

use mjburgess\paydays\PayDates;

/**
 * Class CoTransform
 * When applied to a PayDate array,
 * applies a IDateTransform to the bonus date, and one to the payment date
 *
 * [PayDates(M,Y,B,P), ...] -> [PayDates(M, Y, B', P'), ...]
 *
 * @package mjburgess\paydays\transform
 */
class CoTransform implements IPayDatesTransform {
    /**
     * @var IDateTransform
     */
    private $bonusDayTransform;

    /**
     * @var IDateTransform
     */
    private $payDayTransform;

    /**
     * @param IDateTransform $bdT
     * @param IDateTransform $pdT
     */
    public function __construct(IDateTransform $bdT, IDateTransform $pdT) {
        $this->bonusDayTransform = $bdT;
        $this->payDayTransform   = $pdT;
    }

    /**
     * Applies the pay date transform to $timestamp
     *
     * @param $timestamp
     * @return timestamp
     */
    public function getPayDate($timestamp) {
        return $this->payDayTransform->apply($timestamp);
    }

    /**
     * Applies the bonus date transform to $timestamp
     *
     * @param $timestamp
     * @return timestamp
     */
    public function getBonusDate($timestamp) {
        return $this->bonusDayTransform->apply($timestamp);
    }

    /**
     * Applies bonus/paydate transforms to a PayDates
     *
     * @param PayDates $p
     * @return PayDates
     */
    public function __invoke(PayDates $p) {
        $p->setBonusDate($this->getBonusDate($p->getBonusDate()));
        $p->setPayDate($this->getPayDate($p->getPayDate()));

        return $p;
    }
}