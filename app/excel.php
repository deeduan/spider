<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require '../vendor/autoload.php';

$inputFileName = './ws30.xlsx';

/** Load $inputFileName to a Spreadsheet object **/
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$sheet = $spreadsheet->getActiveSheet();

$cellValue = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(1, 1)->getCalculatedValue();

$cellValue = $spreadsheet->getActiveSheet()->getCell('A2')->getFormattedValue();

var_dump($cellValue);
// 读取多列到一个数组
//$dataArray = $spreadsheet->getActiveSheet()
//    ->rangeToArray(
//        'A1:A3',     // The worksheet range that we want to retrieve
//        NULL,        // Value that should be returned for empty cells
//        TRUE,        // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
//        TRUE,        // Should values be formatted (the equivalent of getFormattedValue() for each cell)
//        false         // Should the array be indexed by cell row and cell column
//    );


//$dataArray = $spreadsheet->getActiveSheet()->toArray();
//
//var_dump($dataArray);


// 设置单列值
//$sheet->setCellValue('A5', 'Hello World !');

// 设置多列
$rowArray = ['Value1', 'Value2', 'Value3', 'Value4'];
$columnArray = array_chunk($rowArray, 1);
$spreadsheet->getActiveSheet()->fromArray($columnArray, NULL, 'A5');

$writer = new Xlsx($spreadsheet);
//$writer->save('hello world.xlsx');
