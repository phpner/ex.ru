<?php
require_once 'config.php';
require_once 'classes/PHPExcel.php';

$bas = new Db();
$data = $bas::getData();

$exl = new PHPExcel();
$exl->setActiveSheetIndex();
$sheet = $exl->getActiveSheet();
$sheet->setTitle('Проба!');
/**
 * settings
 */

$sheet->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$sheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$sheet->getPageSetup()->setFitToPage(true);
$sheet->getPageMargins()->setTop(0);
$sheet->getPageMargins()->setLeft(0);
$sheet->getPageMargins()->setRight(0);

$sheet->mergeCells('A1:E1');
$sheet->getRowDimension('1')->setRowHeight(40);
$sheet->setCellValue('A1','Компьюиепы');

$style = [
    'font' =>[
    'bold' => true,
    'size' => '20'
    ],
    'alignment' =>[
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' =>PHPExcel_Style_Alignment::VERTICAL_CENTER
    ]
];
$sheet->getStyle('A1:E1')->applyFromArray($style);

$sheet->setCellValue('A2','Название');
$sheet->setCellValue('B2','Описание');
$sheet->setCellValue('C2','Марк');
$sheet->setCellValue('D2','Цена');
$sheet->setCellValue('E2','Кол-во');


$sheet->getColumnDimension('A')->setWidth(20);
$sheet->getStyle('A')->getAlignment()->setWrapText(true);
$sheet->getStyle('A')->getAlignment('A')->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getColumnDimension('B')->setWidth(90);
$sheet->getStyle('B')->getAlignment()->setWrapText(true);
$sheet->getStyle('B')->getAlignment('B')->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$sheet->getColumnDimension('C')->setWidth(6);
$sheet->getColumnDimension('D')->setWidth(8);
$sheet->getColumnDimension('E')->setWidth(8);


$i = 4;
/**
 * Заполнение данными
 */
foreach ($data as $key)
{
    $sheet->setCellValue('A'.$i,$key['name']);
    $sheet->setCellValue('B'.$i,$key['description']);
    $sheet->setCellValue('C'.$i,$key['mark']);
    $sheet->setCellValue('D'.$i,$key['price']);
    $sheet->setCellValue('E'.$i,$key['count']);
    $sheet->setCellValue('F'.$i,$key['id_product']);
    ++$i;
}

$style = [
    'borders' => [
        'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THICK,
            'color' => [
                'rgb' => '696969'
            ]
        ]
    ]
];
$count = $i - 1;
$sheet->getStyle('A1:E'.$count)->applyFromArray($style);


$objWrite = PHPExcel_IOFactory::createWriter($exl, 'Excel5');

header("Content-Tye:application/vnd/ms-excel");
header("Content-Disposition:attachment;filename='simple.xls'");


$objWrite->save('php://output');




?>