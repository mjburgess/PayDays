<?php
namespace mjburgess\paydays;

use mjburgess\paydays\transform\Rule;
use mjburgess\paydays\transform\CoTransform;
use mjburgess\paydays\transform\DefaultsTransform;
use mjburgess\paydays\transform\WeekdayDateTransform;
use mjburgess\paydays\condition\WeekendCondition;

/**
 * Class Application
 *
 * Calculates payment dates for the next 12 months
 *
 * @package mjburgess\paydays
 */
class Application {
    /**
     * Builds PayDates transformations
     *
     * @return array [ITransform]
     */
    public function getTransforms() {
        $nWednesday = new WeekdayDateTransform(WeekdayDateTransform::WEDNESDAY, WeekdayDateTransform::NEXT);
        $pFriday    = new WeekdayDateTransform(WeekdayDateTransform::FRIDAY, WeekdayDateTransform::PREV);

        $nWednesday = new Rule(new WeekendCondition(), $nWednesday);
        $pFriday    = new Rule(new WeekendCondition(), $pFriday);

        return [new DefaultsTransform(15), new CoTransform($nWednesday, $pFriday)];
    }

    /**
     * Returns an array of PayDates with final dates for bonuses and salaries from
     * now to 12 months from now
     *
     * @return array [PayDates]
     */
    public function run() {
        $pcoll = PayDatesCollection::fromExtendedRange(date('m'), date('m') + 12);

        return $pcoll->applyTransforms($this->getTransforms());
    }
}


