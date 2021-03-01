<?php

$shortopts .= "u:";
$shortopts .= "t:";

$handle = fopen('php://stdin', 'r');

$options = getopt($shortopts);
$num1 = $options["u"];
$time1 = $options["t"];


// 6 - код ошибки
// 8 - время обработки запроса

//на вход функции подается часть потока, парсится и анализируется, и печатает результат выполнения
function check_log($file, $num, $time)
{
    $count = 0;
    $count_false = 0;
    $arr[] = array();
    $time_start = null;
    $time_end = null;


    while (!feof($file)) {
        $count++;
        $buffer = fgetcsv($file, 1000, " ");
        //проверка на пустую строку
        if (empty($buffer[0])) $buffer = fgetcsv($file, 1000, " ");

        if ((preg_match('/^(5(\d\d))$/',$buffer[6])) or ($buffer[8] > $time)) $count_false++;

        $lvl = $count_false / $count * 100;//вычисление процента ошибок
        if ($lvl >= $num and $count > 1) {
            $time_start = substr($buffer[3], 12, 21);
            $time_end = substr($buffer[3], 12, 21);
            while (($lvl >= $num) and (!preg_match('/^(5(\d\d))$/',$buffer[6]) or ($buffer[8] < $time)) and (!feof($file))) {
                $buffer = fgetcsv($file, 1000, " ");
                if (empty($buffer[0])) $buffer = fgetcsv($file, 1000, " ");
                $count++;
                if (preg_match('/^(5(\d\d))$/',$buffer[6]) or ($buffer[8] > $time)) $count_false++;
                $time_end = substr($buffer[3], 12, 21);
                $lvl = $count_false / $count * 100;
            }
            array_push($arr, array($time_start, $time_end, round($lvl, 1)));

        }
    }
    $new_arr = sort_arr($arr);
    print_answer($new_arr);

}


//выводит значения двумерного массива
function print_answer($arr)
{
    foreach ($arr as &$value) {
        foreach ($value as &$val) echo $val," ";
        echo "\n";
    }
}

//callback для usort
function cmp_sort($x, $y)
{
    return strcmp($x[0], $y[0]);
}

//функция сортировки
function sort_arr($arr)
{
    usort($arr, "cmp_sort");
    return $arr;
}

//check_log($handle, $num1, $time1);

$chunk_size = (1<<24);
$position = 0;
//while (!feof($handle)) {
//
//    $position1 = ftell($handle);
//    $chunk = fread($handle, $chunk_size );
//
//    $last_lf_pos = strrpos($chunk, PHP_EOL);
//    $pos = strpos($chunk, $findme);
//    while($pos)
//    $pos = strpos($, $findme);
//   //echo $position1," ",$position2," ",$last_lf_pos,"\n";
//    $buffer = mb_substr($chunk,0,$last_lf_pos);
//
//    echo "hello \n",$buffer,"\n";
//    $buffer = NULL;
//
//}


fclose($handle);
