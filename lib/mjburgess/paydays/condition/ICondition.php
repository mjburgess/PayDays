<?php
namespace mjburgess\paydays\condition;


interface ICondition {
    public function tryDate($timestamp);
}
