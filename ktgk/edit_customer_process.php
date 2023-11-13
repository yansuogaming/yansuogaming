<!DOCTYPE html>
<html>
<head>
    <title>Thông báo chỉnh sửa thành công</title>
    <script>
        setTimeout(function() {
            window.location.href = "manage_customers.php";
        }, 3000); // Chuyển hướng sau 3 giây (3000 milliseconds)
    </script>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer_id"])) {
        $selected_customer_id = $_POST["customer_id"];
        $selected_first_name = $_POST["first_name"];
        $selected_last_name = $_POST["last_name"];
        $selected_email = $_POST["email"];
        $selected_phone = $_POST["phone"];

        // Kết nối tới cơ sở dữ liệu
        $servername = "localhost";
        $username = "yansuo";
        $password = "long2002";
        $dbname = "salesmanagement";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Cập nhật thông tin khách hàng
        $sql = "UPDATE Customers SET first_name = '$selected_first_name', last_name = '$selected_last_name', email = '$selected_email', phone = '$selected_phone' WHERE customer_id = $selected_customer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Thông tin khách hàng đã được cập nhật thành công.";
        } else {
            echo "Lỗi khi cập nhật thông tin khách hàng: " . $conn->error;
        }

        // Đóng kết nối tới cơ sở dữ liệu
        $conn->close();
    }
    ?>
</body>
</html>