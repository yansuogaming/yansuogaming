<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Truy vấn để lấy danh sách sản phẩm
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Kiểm tra và lấy danh sách sản phẩm
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Đóng kết nối
$conn->close();

// Sử dụng thư viện PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo một đối tượng Spreadsheet mới
$spreadsheet = new Spreadsheet();

// Lấy trang tính hiện tại
$sheet = $spreadsheet->getActiveSheet();

// Đặt tiêu đề cho các cột
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Tên sản phẩm');
$sheet->setCellValue('C1', 'Giá');
$sheet->setCellValue('D1', 'Mô tả');
$sheet->setCellValue('E1', 'Số lượng tồn kho');

// Đặt giá trị cho các dòng dữ liệu
$row = 2;
foreach ($products as $product) {
    $sheet->setCellValue('A' . $row, $product['product_id']);
    $sheet->setCellValue('B' . $row, $product['product_name']);
    $sheet->setCellValue('C' . $row, $product['price']);
    $sheet->setCellValue('D' . $row, $product['description']);
    $sheet->setCellValue('E' . $row, $product['stock_quantity']);
    $row++;
}

// Định dạng file Excel
$sheet->setTitle('Danh sách sản phẩm');
$sheet->getStyle('A1:E1')->getFont()->setBold(true);
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(30);
$sheet->getColumnDimension('C')->setWidth(15);
$sheet->getColumnDimension('D')->setWidth(50);
$sheet->getColumnDimension('E')->setWidth(20);

// Xuất file Excel
$writer = new Xlsx($spreadsheet);
$filename = 'products.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');