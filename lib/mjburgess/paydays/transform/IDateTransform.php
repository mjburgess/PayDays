<?php

namespace mjburgess\paydays\transform;


interface IDateTransform {
    public function apply($timestamp);
}