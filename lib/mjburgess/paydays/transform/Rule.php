<?php
namespace mjburgess\paydays\transform;

use mjburgess\paydays\condition\ICondition;

class Rule implements IDateTransform {
    private $test;
    private $modifier;

    public function __construct(ICondition $t, IDateTransform $m) {
        $this->test = $t;
        $this->modifier = $m;
    }

    public function apply($timestamp) {
        return $this->test->tryDate($timestamp) ? $timestamp : $this->modifier->apply($timestamp);
    }
}
