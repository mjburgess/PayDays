<?php
namespace mjburgess\paydays;

use ArrayObject;

/**
 * Class PayDatesCollection
 *
 * Convenience wrapper for [PayDates]
 *
 * @package mjburgess\paydays
 */
class PayDatesCollection extends ArrayObject {
    /**
     * Factory. Creates a PayDatesCollection from 0 to N months into the future,
     * where N is unbounded (eg. 0, 48)
     *
     * @param int $start
     * @param int $end
     * @param null|string [$year = date('Y')]
     * @return PayDatesCollection
     */
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

    /**
     * Apply an array of callables to the collection PayDates,
     * and return them.
     *
     * @param array $transforms [callable]
     * @return array [PayDates]
     */
    public function applyTransforms(array $transforms) {
        $paydays = $this->getArrayCopy();
        foreach($transforms as $t) {
            $paydays = array_map($t, $paydays);
        }
        return $paydays;
    }
}