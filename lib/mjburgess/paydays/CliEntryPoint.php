<?php

namespace mjburgess\paydays;

class CliEntryPoint {
    public static function formatPaydays(array $paydays) {
        return array_map(function (PayDates $p) {
            return sprintf('%s, %s, %s, %s', $p->getYear(), $p->getMonth(),
                $p->getPayDate('d'), $p->getBonusDate('d'));
        }, $paydays);
    }

    public static function main(array $argv) {
        list($self, $csvfile, ) = $argv;

        $header = "year, month, pay date, bonus date\n";
        $csv    = $header . implode("\n", self::formatPaydays((new Application())->run()));
        echo $csv;
        return file_put_contents($csvfile, $csv);
    }
}