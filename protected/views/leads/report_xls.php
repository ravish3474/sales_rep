<?php 
$basePath = realpath(__DIR__ . '/../../vendors');

if (!$basePath) {
    die('Vendors folder not found');
}

require_once($basePath . '/PHPExcel/Classes/PHPExcel.php');

$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->setActiveSheetIndex(0);

// 🔹 Header row
$headers = [
    "Product","Status","Created Date","Assigned To",
    "Company","QTY","Due Date","Name & Email",
    "State","Country","City"
];

// Set header values
$col = 0;
foreach ($headers as $header) {
    $sheet->setCellValueByColumnAndRow($col, 1, $header);
    $col++;
}

// 🔹 Style header (Bold + Font Size)
$sheet->getStyle('A1:K1')->applyFromArray([
    'font' => [
        'bold' => true,
        'size' => 12
    ]
]);

// 🔹 Set column widths
$sheet->getColumnDimension('A')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(25); // Assigned To
$sheet->getColumnDimension('E')->setWidth(30); // Company
$sheet->getColumnDimension('G')->setWidth(20); // Due Date
$sheet->getColumnDimension('H')->setWidth(30);  

// 🔹 Fill data
$rowNum = 2;

if (!empty($adminLeads)) {
    foreach ($adminLeads as $leads) {

        $product = TblLeads::GetPriceDetails($leads['pro_name']);
        $assigned_sales_person = TblLeads::GetAssignedSalesPerson($leads['lead_id']);
        $userDetails = !empty($assigned_sales_person) 
            ? TblLeads::getSalesPersonDetails($assigned_sales_person) 
            : [];

        $assigned = $userDetails['fullname'] ?? 'Select sales rep';

        $statusName = isset($LEAD_STATUS[$leads['status']]) 
            ? $LEAD_STATUS[$leads['status']] 
            : "";

        $sheet->setCellValueByColumnAndRow(0, $rowNum, $product ?: $leads['pro_name']);
        $sheet->setCellValueByColumnAndRow(1, $rowNum, $statusName);
        $sheet->setCellValueByColumnAndRow(2, $rowNum, date('d/m/Y', strtotime($leads['created_at'])));
        $sheet->setCellValueByColumnAndRow(3, $rowNum, $assigned);
        $sheet->setCellValueByColumnAndRow(4, $rowNum, $leads['TAC_name']);
        $sheet->setCellValueByColumnAndRow(5, $rowNum, $leads['qty']);
        $sheet->setCellValueByColumnAndRow(6, $rowNum, $leads['due_date']);
        $sheet->setCellValueByColumnAndRow(7, $rowNum, $leads['name'] . ' ' . $leads['last_name'] . ' (' . $leads['email'] . ')');
        $sheet->setCellValueByColumnAndRow(8, $rowNum, $leads['state_name']);
        $sheet->setCellValueByColumnAndRow(9, $rowNum, $leads['country_name']);
        $sheet->setCellValueByColumnAndRow(10, $rowNum, $leads['city']);

        $rowNum++;
    }
}

// 🔹 Output Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="LeadReport_' . date("Ymd") . '.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
?>