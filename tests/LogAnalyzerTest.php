<?php


namespace App\Tests;

use App\LogAnalyzer;
use PHPUnit\Framework\TestCase;
class LogAnalyzerTest extends TestCase
{

    //сортировка
    public function testSort()
    {
        $analyzer = new LogAnalyzer();
        $arr = array(array("16:47:04", "16:47:20", 59.2),
            array("17:47:04", "17:47:20", 60.2),
            array("16:47:05", "16:47:20", 59.2));

        $arr = $analyzer->sort_arr($arr);

        $sorted_arr = array(array("16:47:04", "16:47:20", 59.2),
            array("16:47:05", "16:47:20", 59.2),
            array("17:47:04", "17:47:20", 60.2));

        $this->assertEquals($arr, $sorted_arr);
    }
    //сортировка одинаковые сортируемые значения
    public function testSortSameVal()
    {
        $analyzer = new LogAnalyzer();
        $arr = array(array("16:47:04", "16:47:20", 59.2),
            array("17:47:04", "17:47:20", 60.2),
            array("17:47:04", "18:42:20", 60),
            array("16:47:05", "16:47:20", 59.2));

        $arr = $analyzer->sort_arr($arr);
        $sorted_arr = array(array("16:47:04", "16:47:20", 59.2),
            array("16:47:05", "16:47:20", 59.2),
            array("17:47:04", "17:47:20", 60.2),
            array("17:47:04", "18:42:20", 60));

        $this->assertEquals($arr, $sorted_arr);
    }
    //сортировка убывающей последовательности
    public function testSortReverse()
    {
        $analyzer = new LogAnalyzer();
        $arr = array(array("20:47:04", "20:47:20", 60.2),
            array("17:47:04", "18:47:20", 59.2),
            array("12:47:04", "12:47:20", 60.2),
            array("11:47:05", "11:47:20", 59.2));

        $arr = $analyzer->sort_arr($arr);

        $sorted_arr = array(array("11:47:05", "11:47:20", 59.2),
            array("12:47:04", "12:47:20", 60.2),
            array("17:47:04", "18:47:20", 59.2),
            array("20:47:04", "20:47:20", 60.2));

        $this->assertEquals($arr, $sorted_arr);
    }


}