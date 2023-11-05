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

// Kiểm tra nút "Thoát" được nhấn
if (isset($_POST['logout'])) {
    header("Location: login.php");
    exit();
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
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(https://www.schemecolor.com/wallpaper?i=54674&desktop);
            background-size: cover;
        }
        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
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
            background-color: #6666FF;
            color: #fff;
            border-radius: 5px;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        
        .form-group button {
            display: inline-block;
            margin-right: 10px;
        }
        
        .container h1 {
            text-align: center;
        }
    </style>
    <script>
        function exportExcel() {
            var confirmation = confirm("Bạn có muốn xuất file Excel không?");
            if (confirmation) {
                window.location.href = "export_excel_product.php";
            }
        }

        function logout() {
            if (confirm('Bạn có chắc chắn thoát không?')) {
                window.location.href = "index.php";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Xin chào, <?php echo $username; ?> !</h2>
        <h1>QUẢN LÝ SẢN PHẨM</h1>
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
        <div class="form-group">
            <button type="button" onclick="exportExcel()">Xuất Excel</button>
            <button type="button" onclick="logout()">Thoát</button>
        </div>
        <footer style="text-align: center; margin-top: 20px;">
            <p>© Copyright by Yansuo</p>
        </footer>
    </div>
</body>
</html>