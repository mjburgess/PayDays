<?php
require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), 'lib', 'vendor', 'autoload.php']);

mjburgess\paydays\CliEntryPoint::main($argv + ['paydays.php', 'results.csv']);