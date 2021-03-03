<?php

require_once( "LogAnalyzer.php" );

use App\LogAnalyzer;


$filename = 'php://stdin';
$options = getopt("u:t:");
$num1 = $options["u"];
$time1 = $options["t"];

$analyzer = new LogAnalyzer();
$analyzer($filename, $num1,$time1);
