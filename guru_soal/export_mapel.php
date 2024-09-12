<?php
require_once "../database/config.php";
require '../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

ob_start();

$lk = "Data-Mapel-" . date('Y-m-d');
$sql = "SELECT * FROM tbl_mapel";
$result = mysqli_query($con, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Data Mapel');

// Set header cells
$sheet->setCellValue('A1', 'NO');
$sheet->setCellValue('B1', 'ID MAPEL');
$sheet->setCellValue('C1', 'NAMA MAPEL');

$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['rgb' => '808080'],
        ],
    ],
];
$sheet->getStyle('A1:C1')->applyFromArray($styleArray);
$sheet->getStyle('A1:C1')->getFont()->setBold(true);

foreach (array('B', 'C') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

$no = 1;
$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $code = $row['id'];
    $nama = $row['nama'];

    $sheet->setCellValue("A" . $rowNumber, $no);
    $sheet->setCellValue("B" . $rowNumber, $code);
    $sheet->setCellValue("C" . $rowNumber, $nama);
    $rowNumber++;
    $no++;
}

// Buat file excel
$filename = $lk . ".xlsx";
$writer = new Xlsx($spreadsheet);

ob_end_clean(); // Bersihkan output buffer

// Atur header untuk pengunduhan file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit();
?>
