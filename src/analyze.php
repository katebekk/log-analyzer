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
    $count_true = 0;
    $count_false = 0;
    $arr[] = array();
    $time_start = null;
    $time_end = null;
    $flag = true;//true - осчет до пика  false - после
    while (!feof($file)) {
        $buffer = fgetcsv($file, 1000, " ");
        //проверка на пустую строку
        if(empty($buffer[0])) $buffer = fgetcsv($file, 1000, " ");

        if  (($buffer[6] == 500) or ($buffer[8] > $time)) {
            $count_false ++;
        }else if (($buffer[6] != 500) and ($buffer[8] < $time)) {
            $count_true ++;
        }
        echo $buffer[8]," ",$count_false," ",$count_true,"\n";
//        $lvl = $count_false / $count_true * 100;//вычисление процента ошибок
//        if ($lvl >= $num) {
//            $time_start = $buffer[3];
//            while (!feof($file) or ($lvl >= $num) or (($buffer[6] != 500) and ($buffer[8] < $time))) {
//                $count_true++;
//                $buffer = fgetcsv($file, 1000, " ");
//                $time_end = $buffer[3];
//            }
//            echo $time_start," ",$time_end,"\n";
//            array_push($arr, arrray($time_start, $time_end, $lvl));
//        }

    }
/*    echo "\n";
    echo substr($time_start, 12, 21);//подстрока время
    echo "\n";*/
}

check_log($handle, 45, 43);

//100 все 23 ошибочные 100 - 73

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
