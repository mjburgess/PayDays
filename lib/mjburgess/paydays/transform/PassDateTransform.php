<?php
namespace mjburgess\paydays\transform;

class PassDateTransform implements IDateTransform {
    public function apply($timestamp) {
        return $timestamp;
    }
}