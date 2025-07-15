<?php

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator("yo")->setLastModifiedBy("yo")->setTitle("yo")->setDescription("yo");
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet -> setTitle("Hoja 1");

/*for ($i = 1; $i <= 12; $i++) {
    $activeWorksheet->setCellValue('A' . $i, 1);        
    $activeWorksheet->setCellValue('B' . $i, 'x');      
    $activeWorksheet->setCellValue('C' . $i, $i);   
    $activeWorksheet->setCellValue('D' . $i, '=');     
    $activeWorksheet->setCellValue('E' . $i, '=A' . $i . '*C' . $i); 
}*/


$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');

