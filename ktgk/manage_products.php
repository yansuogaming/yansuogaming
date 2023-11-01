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

// Truy vấn để lấy danh sách sản phẩm
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Kiểm tra và lấy danh sách sản phẩm
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Kiểm tra nếu có giá trị tìm kiếm được submit từ form
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%' OR product_id = '$searchTerm'";
    $result = $conn->query($sql);

    // Kiểm tra và lấy danh sách sản phẩm
    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý sản phẩm</title>
    <style>
        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Xin chào, <?php echo $username; ?>!</h1>
        <h2>Quản lý sản phẩm</h2>
        <form method="GET" action="">
            <div class="form-group">
                <label for="search">Tìm kiếm theo tên hoặc mã:</label>
                <input type="text" id="search" name="search" placeholder="Nhập tên hoặc mã sản phẩm">
                <button type="submit">Tìm kiếm</button>
            </div>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Số lượng tồn kho</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo $product["product_id"]; ?></td>
                        <td><?php echo $product["product_name"]; ?></td>
                        <td><?php echo $product["price"]; ?></td>
                        <td><?php echo $product["description"]; ?></td>
                        <td><?php echo $product["stock_quantity"]; ?></td>
                        <td>
                            <a href="add_product.php?id=<?php echo $product["product_id"]; ?>">Thêm</a>
                            <a href="edit_product.php?id=<?php echo $product["product_id"]; ?>">Sửa</a>
                            <a href="delete_product.php?id=<?php echo $product["product_id"]; ?>">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="export_excel_product.php">Xuất Excel</a>
    </div>
</body>
</html>