<?php
session_start();

// Kiểm tra xem có tham số id trong URL hay không
if (!isset($_GET["id"])) {
    header("Location: manage_products.php");
    exit();
}

// Lấy giá trị id từ URL
$id = $_GET["id"];

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Xóa sản phẩm từ cơ sở dữ liệu
$delete_product_sql = "DELETE FROM Products WHERE product_id = '$id'";

if ($conn->query($delete_product_sql) === TRUE) {
    // Xóa sản phẩm thành công
    $_SESSION['success_message'] = 'Đã xoá thành công.';
    header("Location: manage_products.php");
    exit();
} else {
    // Xảy ra lỗi trong quá trình xóa sản phẩm
    echo "Lỗi: " . $conn->error;
}

$conn->close();
?>