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

// Truy vấn để lấy tên người dùng từ cơ sở dữ liệu
$sql = "SELECT username FROM users";
$result = $conn->query($sql);

// Kiểm tra và lấy tên người dùng
$username = "";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm sản phẩm</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(https://images7.alphacoders.com/131/1318803.jpeg);
            background-size: cover;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
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
        }
        .container h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>THÊM SẢN PHẨM</h1>
        <form method="post" action="add_product_process.php">
            <div class="form-group">
                <label for="product_name">Tên sản phẩm:</label>
                <input type="text" id="product_name" name="product_name">
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="text" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="stock_quantity">Số lượng tồn kho:</label>
                <textarea id="stock_quantity" name="stock_quantity"></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Thêm sản phẩm</button>
            </div>
        </form>
</div>
</form>
    </div>
</body>
</html>