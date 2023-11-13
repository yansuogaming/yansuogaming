<?php
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET["user_id"])) {
    $user_id = $_GET["user_id"];

    $sql = "DELETE FROM Users WHERE user_id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "Người dùng đã được xóa thành công!";
        header("refresh:3; url=manage_users.php"); // Tự động quay lại trang manage_users.php sau 3 giây
        exit(); // Kết thúc kịch bản PHP sau khi chuyển hướng
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không tìm thấy người dùng!";
}

$conn->close();
?>