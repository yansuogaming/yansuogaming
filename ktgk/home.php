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

// Kiểm tra nút "Thoát" được nhấn
if (isset($_POST['logout'])) {
    header("Location: login.php");
    exit();
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trang chủ</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(https://p1-jj.byteimg.com/tos-cn-i-t2oaga2asx/gold-user-assets/2020/2/19/1705d686ea3e4466~tplv-t2oaga2asx-image.image);
            background-size: cover;
        }

        .container {
            width: 590px;
            padding: 40px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .container button {
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 60px;
            background-color: #00FFCC;
            margin-right: 5px;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 5px;
        }

        .form-group button {
            padding: 5px 10px;
            border-radius: 60px;
            margin-bottom: 10px;
        }
        
        .form-group button {
            display: inline-block;
            margin-right: 10px;
            border-radius: 60px;
        }

        .container h1 {
            text-align: center;
            font-size: 40px;
        }

        .container h2 {
            text-align: center;
            font-size: 25px;
        }

        .form-row {
            display: flex;
            justify-content: center;
        }
    </style>
    <script>
        function logout() {
            if (confirm('Bạn có chắc chắn thoát không?')) {
                window.location.href = "index.php";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Xin chào, <?php echo $username; ?>!</h1>
        <h2>Vui lòng bạn chọn danh mục</h2>
        <form action="manage_products.php" method="get">
            <div class="form-row">
                <button type="submit" formaction="manage_products.php">Quản lý sản phẩm</button>
                <button type="submit" formaction="manage_customers.php">Quản lý khách hàng</button>
                <button type="submit" formaction="manage_users.php">Quản lý người dùng</button>
                <button type="button" onclick="logout()">Thoát</button>
            </div>
        </form>
    </div>
</body>
</html>