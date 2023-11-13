<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Kiểm tra số điện thoại có đúng 10 chữ số và không chứa chữ cái
if (strlen($phone) != 10 || !ctype_digit($phone)) {
    // Hiển thị thông báo lỗi và chuyển hướng về trang add_customers.php sau 3 giây để nhập lại số điện thoại
    echo '<script>
            alert("Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại gồm 10 chữ số.");
            setTimeout(function() {
                window.location.href = "add_customers.php";
            }, 3000);
        </script>';
    exit();
}

// Chuẩn bị câu truy vấn INSERT
$sql = "INSERT INTO customers (first_name, last_name, email, phone) VALUES ('$first_name', '$last_name', '$email', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Thêm khách hàng thành công.";
    // Chuyển hướng sau 3 giây
    header("refresh:3; url=manage_customers.php"); // Chuyển hướng sau 3 giây về trang manage_customers.php
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối
$conn->close();
?>