<?php
$inputFile  = $argv[1];
$percentage = min(100, max(0, $argv[2]));
 
if (!file_exists($inputFile)) {
    throw new InvalidArgumentException('Invalid input file provided');
}
 
if (!$percentage) {
    throw new InvalidArgumentException('An integer checked percentage must be given as second parameter');
}
 
$xml             = new SimpleXMLElement(file_get_contents($inputFile));
$files        	 = $xml->xpath('//file');
$metrics		 = [];
$totalElements   = 0;
$checkedElements = 0;
 
foreach($files as $file) {
	$totalElements   += ($t = $file->metrics['elements']);
    $checkedElements += ($c = $file->metrics['coveredelements']);
	
	$m  = $file->metrics['methods'];
	$cm = $file->metrics['coveredmethods'];
	
	if($file->metrics['elements'] - $file->metrics['coveredelements'] > 0) {
		printf('%25s: %2d / %2d  , %2d / %2d' . PHP_EOL, basename($file['name']), $cm, $m, $c, $t);
	}
}

 
$coverage = ($checkedElements / $totalElements) * 100;
 
if ($coverage < $percentage) {
    printf('Code coverage is %.1f %%, which is below the accepted ' . $percentage . '%%' . PHP_EOL, $coverage);
    exit(1);
}
 
printf('Code coverage is %.1f %%- OK!' . PHP_EOL, $coverage);