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

// Kiểm tra nếu có giá trị product_id được truyền qua URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Truy vấn để lấy thông tin sản phẩm
    $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = $conn->query($sql);

    // Kiểm tra và lấy thông tin sản phẩm
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Tiến hành tạo hoá đơn và lưu vào cơ sở dữ liệu
        // ...
        // Code tạo hoá đơn và lưu vào cơ sở dữ liệu
        // ...
        // Sau khi tạo hoá đơn thành công, chuyển hướng người dùng đến trang in hoá đơn
        header("Location: print_invoice.php?invoice_id=$invoice_id");
        exit();
    }
}

// Đóng kết nối
$conn->close();
?>