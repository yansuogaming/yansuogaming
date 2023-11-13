<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy danh sách khách hàng từ bảng Customers
$sql = "SELECT * FROM Customers";
$result = $conn->query($sql);

// Tạo file Excel
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Đặt tiêu đề cho các cột
$sheet->setCellValue('A1', 'Mã khách hàng');
$sheet->setCellValue('B1', 'Tên');
$sheet->setCellValue('C1', 'Họ, tên đệm');
$sheet->setCellValue('D1', 'Email');
$sheet->setCellValue('E1', 'Số điện thoại');

// Đổ dữ liệu vào file Excel
$rowIndex = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $rowIndex, $row["customer_id"]);
    $sheet->setCellValue('B' . $rowIndex, $row["first_name"]);
    $sheet->setCellValue('C' . $rowIndex, $row["last_name"]);
    $sheet->setCellValue('D' . $rowIndex, $row["email"]);
    $sheet->setCellValue('E' . $rowIndex, $row["phone"]);
    $rowIndex++;
}

// Xuất file Excel
$writer = new Xlsx($spreadsheet);
$filename = 'customers.xlsx';

// Đặt header để tải file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');

// Đóng kết nối
$conn->close();
?>