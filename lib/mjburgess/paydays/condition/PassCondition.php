<?php
namespace mjburgess\paydays\condition;

class PassCondition implements ICondition {
    public function tryDate($timestamp) {
        return (bool) $timestamp;
    }
}