<?php
namespace mjburgess\paydays;

use ArrayObject;

class PayDatesCollection extends ArrayObject {
    public static function fromExtendedRange($start, $end, $year = null) {
        $year = $year ?: date('Y');
        $pc = new PayDatesCollection();
        $pc->exchangeArray(array_map(function ($month) use($year) {
            return new PayDates(
                $month > 12 ? $month - 12  : $month,
                $month > 12 ? $year + 1 : $year
            ); }, range($start, $end)));

        return $pc;
    }

    public function applyTransforms(array $transforms) {
        $paydays = $this->getArrayCopy();
        foreach($transforms as $t) {
            $paydays = array_map($t, $paydays);
        }
        return $paydays;
    }
}