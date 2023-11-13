<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy danh sách sản phẩm từ bảng Products
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chọn sản phẩm</title>
    <style>
        /* CSS styles */
    </style>
    <script>
    function selectProduct(productId) {
            // Xử lý khi khách hàng chọn sản phẩm
            // Chuyển hướng đến trang mới với thông tin sản phẩm được chọn
            window.location.href = "manage_customers.php?product_id=" + productId;
        }
    </script>
</head>
<body>
    <h1>Chọn sản phẩm</h1>

    <table>
        <!-- Hiển thị danh sách sản phẩm -->
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th></th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td><button onclick=\"selectProduct(" . $row["product_id"] . ")\">Chọn</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Không có sản phẩm.</td></tr>";
        }
        ?>
    </table>
</body>
</html>