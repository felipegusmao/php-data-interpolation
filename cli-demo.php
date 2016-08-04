#! /usr/bin/env php
<?php
require_once __DIR__.'/vendor/autoload.php';

use Fgunix\DataInterpolation\DataInterpolation;

$side = isset($argv[1]) ? $argv[1] : null;

$data = array(
    "2010-05-01 12:20:08" => 858,
    "2010-06-05 16:30:54" => 1009,
    "2010-07-04 08:11:20" => 1156,
    "2010-08-02 14:06:20" => 1293,
    "2010-08-31 13:50:00" => 1345,
    "2010-10-03 17:34:20" => 1512
);

$d = DataInterpolation::create()->setEntries($data)->setThreshold(20);

echo "Given the input of: \n\n";

foreach ($data as $dat => $value)
    echo $dat . " " . $value . "\n";

echo "\n=====================================\n\n";
echo "The result is: \n\n";

foreach ($d->getResult() as $data => $value)
    echo $data." ".$value."\n";

echo "\n=====================================\n";
