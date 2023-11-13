<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Xử lý thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $stock_quantity = $_POST["stock_quantity"];

    // Kiểm tra không được bỏ trống và giá tiền và số lượng tồn kho phải là số
    if (empty($product_name) || !is_numeric($price) || !is_numeric($stock_quantity)) {
        $error_message = "Vui lòng nhập đầy đủ thông tin và đảm bảo giá tiền và số lượng tồn kho là số.";
    } else {
        // Thêm sản phẩm vào cơ sở dữ liệu
        $add_product_sql = "INSERT INTO Products (product_name, price, description, stock_quantity) VALUES ('$product_name', '$price', '$description', '$stock_quantity')";

        if ($conn->query($add_product_sql) === TRUE) {
            // Thêm sản phẩm thành công
            $success_message = "Sản phẩm đã được thêm vào.";
            echo '<script>window.location.href = "manage_products.php?success_message=' . urlencode($success_message) . '";</script>';
            exit();
        } else {
            $error_message = "Đã xảy ra lỗi trong quá trình thêm sản phẩm.";
        }
    }
}

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

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 5px;
        }

        .form-group button {
            padding: 5px 10px;
        }

        .form-group .error {
            color: red;
        }

        .form-group .success {
            color:green;
        }
        .container h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>THÊM SẢN PHẨM</h1>
        <?php
        if (isset($error_message)) {
            echo '<div class="form-group error">' . $error_message . '</div>';
        } elseif (isset($success_message)) {
            echo '<div class="form-group success">' . $success_message . '</div>';
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                <input type="text" id="stock_quantity" name="stock_quantity">
            </div>
            <div class="form-group">
                <button type="submit">Thêm sản phẩm</button>
</div>
        </form>
    </div>
</body>
</html>