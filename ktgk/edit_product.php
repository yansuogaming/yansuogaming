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

// Kiểm tra xem có giá trị id được truyền vào từ trang trước hay không
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];

    // Cập nhật thông tin sản phẩm trong cơ sở dữ liệu
    $sql = "UPDATE products SET product_name='$product_name', description='$description', price='$price', stock_quantity='$stock_quantity' WHERE product_id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật sản phẩm thành công.";
        // Chuyển hướng về trang manage_products.php
        header("Location: manage_products.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

// Lấy thông tin sản phẩm từ cơ sở dữ liệu
$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE product_id='$product_id'";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa sản phẩm</title>
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
            width: 400px;
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
        <h1>SỬA SẢN PHẨM</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>">
            <div class="form-group">
                <label for="product_name">Tên sản phẩm:</label>
                <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <input type="text" id="description" name="description" value="<?php echo $product['description']; ?>">
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>">
            </div>
            <div class="form-group">
                <label for="stock_quantity">Số lượng tồn kho:</label>
                <input type="text" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>">
            </div>
            <div class="form-group">
                <button type="submit">Cập nhật</button>
            </div>
        </form>
    </div>
</body>
</html>