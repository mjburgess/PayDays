<?php
namespace mjburgess\paydays\transform;

use mjburgess\paydays\condition\ICondition;

/**
 * Class Rule
 *
 * A Rule transforms a timestamp (timestamp -> timestamp')
 *  if a test condition applied to the timestamp fails.
 *
 * @package mjburgess\paydays\transform
 */
class Rule implements IDateTransform {
    /**
     * @var \mjburgess\paydays\condition\ICondition
     */
    private $test;

    /**
     * @var IDateTransform
     */
    private $modifier;

    /**
     * @param ICondition $t
     * @param IDateTransform $m
     */
    public function __construct(ICondition $t, IDateTransform $m) {
        $this->test = $t;
        $this->modifier = $m;
    }

    /**
     * Transforms a timestamp (timestamp -> timestamp')
     *  if a test condition applied to the timestamp fails.
     *
     * @param $timestamp
     * @return timestamp
     */
    public function apply($timestamp) {
        return $this->test->tryDate($timestamp) ? $timestamp : $this->modifier->apply($timestamp);
    }
}
