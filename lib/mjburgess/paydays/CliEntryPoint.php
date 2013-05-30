<?php

namespace mjburgess\paydays;

/**
 * Class CliEntryPoint
 *
 * CLI Application, runs Application and writes results to a csv file
 * @package mjburgess\paydays
 */
class CliEntryPoint {
    /**
     * Takes an array of PayDates and returns an array of CSV formatted lines
     * where each element is a string version of the paydate.
     *
     * @param array $paydays [PayDates]
     * @return array ["y, m, pay, bonus"]
     */
    public static function formatPaydays(array $paydays) {
        return array_map(function (PayDates $p) {
            return sprintf('%s, %s, %s, %s', $p->getYear(), $p->getMonth(),
                $p->getPayDate('d'), $p->getBonusDate('d'));
        }, $paydays);
    }

    /**
     * Writes CSV of pay days (bonus and salaries) in
     *  year, month, pay date, bonus date
     * format.
     *
     * Echo's CSV before writing.
     *
     * @param array $argv [_, file-to-write]
     * @return int file writing success
     */
    public static function main(array $argv) {
        list($self, $csvfile, ) = $argv;

        $header = "year, month, pay date, bonus date\n";
        $csv    = $header . implode("\n", self::formatPaydays((new Application())->run()));
        echo $csv;
        return file_put_contents($csvfile, $csv);
    }
}