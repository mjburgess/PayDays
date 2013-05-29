<?php

namespace mjburgess\paydays\condition;



class WeekendCondition implements ICondition {
    public function tryDate($timestamp) {
        return !in_array(date('D', $timestamp), ['Sat', 'Sun']);
    }
}