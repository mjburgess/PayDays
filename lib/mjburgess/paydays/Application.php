<?php
namespace mjburgess\paydays;

use mjburgess\paydays\transform\Rule;
use mjburgess\paydays\transform\WeekdayTransform;
use mjburgess\paydays\transform\DefaultsTransform;
use mjburgess\paydays\transform\WeekdayDateTransform;
use mjburgess\paydays\condition\WeekendCondition;

class Application {
    public function getTransforms() {
        $nWednesday = new WeekdayDateTransform(WeekdayDateTransform::WEDNESDAY, WeekdayDateTransform::NEXT);
        $pFriday    = new WeekdayDateTransform(WeekdayDateTransform::FRIDAY, WeekdayDateTransform::PREV);

        $nWednesday = new Rule(new WeekendCondition(), $nWednesday);
        $pFriday    = new Rule(new WeekendCondition(), $pFriday);

        return [new DefaultsTransform(15), new WeekdayTransform($nWednesday, $pFriday)];
    }

    public function run() {
        $pcoll = PayDatesCollection::fromExtendedRange(date('m'), date('m') + 12);

        return $pcoll->applyTransforms($this->getTransforms());
    }
}


