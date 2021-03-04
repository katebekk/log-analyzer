<?php

require_once( "LogAnalyzer.php" );


use App\LogAnalyzer;



$filename = 'php://stdin';
$options = getopt("u:t:");
$num1 = $options["u"];
$time1 = $options["t"];

$analyzer = new LogAnalyzer();
try {
    $analyzer($filename, $num1, $time1);
} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}