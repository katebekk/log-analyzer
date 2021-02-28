<?php
ini_set('auto_detect_line_endings',TRUE);
$handle = fopen('php://stdin', 'r');



// 6 - код ошибки
// 8 - время обработки запроса
//while(!feof($handle)) {
//    $buffer = fgetcsv($handle, 1000, " ");
//    $num = count($buffer);
//    echo $buffer[6];
//    echo "\n";
//
//}

//на вход функции подается часть потока, парсится и анализируется, и печатает результат выполнения
function check_log($file, $num, $time)
{
    $count = 0;
    $count_false = 0;
    $arr[] = array();
    $time_start = null;
    $time_end = null;
    $flag = true;//true - осчет до пика  false - после
    while (!feof($file)) {
        $count ++;
        $buffer = fgetcsv($file, 1000, " ");
        //проверка на пустую строку
        if(empty($buffer[0])) $buffer = fgetcsv($file, 1000, " ");

        if(($buffer[6] == 500) or ($buffer[8] > $time)) $count_false ++;

        $lvl = $count_false / $count * 100;//вычисление процента ошибок
        if($lvl >= $num and $count > 1) {
            $time_start = substr($buffer[3], 12, 21);
            $time_end = substr($buffer[3], 12, 21);
            while (($lvl >= $num) and (($buffer[6] != 500) or ($buffer[8] < $time)) and (!feof($file)) ) {

                $buffer = fgetcsv($file, 1000, " ");
                if(empty($buffer[0])) $buffer = fgetcsv($file, 1000, " ");
                $count ++;
                if(($buffer[6] == 500) or ($buffer[8] > $time)) $count_false ++;
                $time_end = substr($buffer[3], 12, 21);
                $lvl = $count_false / $count * 100;
            }
            echo  $lvl," ", $time_start," ",$time_end,"\n";
            array_push($arr, array($time_start, $time_end, $lvl));

        }
    }
}

check_log($handle, 76, 43);


function print_answer($arr)
{

}

//while (!feof($handle)) {
//
//    $str = fread($handle, 60);
//    echo $str;
//}

/*check_log($handle);



$count = 0;
while(!feof($handle)) {
    $buffer = fgetcsv($handle, 1000, " ");
    $num = count($buffer);
//    echo $count++, ": ", $buffer;
    echo "<p> $num fields in line $count: <br /></p>\n";
    $count++;
    for ($c=0; $c < $num; $c++) {
        echo $c;
        echo $buffer[$c] . "<br />\n";
    }
}*/
fclose($handle);
