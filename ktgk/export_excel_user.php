<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Sử dụng thư viện PhpSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

// Tạo một đối tượng Spreadsheet
$spreadsheet = new Spreadsheet();

// Tạo một trang tính mới
$sheet = $spreadsheet->getActiveSheet();

// Thực hiện truy vấn SELECT để lấy dữ liệu từ cơ sở dữ liệu
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

// Thiết lập tiêu đề cột
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Email');

// Thiết lập dữ liệu từ cơ sở dữ liệu vào các ô tương ứng
$rowIndex = 2;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowIndex, $row["user_id"]);
        $sheet->setCellValue('B' . $rowIndex, $row["username"]);
        $sheet->setCellValue('C' . $rowIndex, $row["email"]);
        $rowIndex++;
    }
}

// Tạo một đối tượng Writer để xuất file Excel
$writer = new Xls($spreadsheet);

// Đặt tên cho file Excel
$filename = 'users_data.xls';

// Đặt header để tải file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Xuất file Excel
$writer->save('php://output');

// Đóng kết nối
$conn->close();
?>