<?php
// Kết nối đến cơ sở dữ liệu
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

// Tạo ngày đặt hàng (sử dụng ngày hiện tại)
$orderDate = date("Y-m-d");

// Thêm dữ liệu vào bảng Orders
$sqlOrders = "INSERT INTO Orders (customer_id, user_id, order_date, total_amount) VALUES (1, 1, '$orderDate', 0.00)";
if ($conn->query($sqlOrders) === TRUE) {
    $orderId = $conn->insert_id; // Lấy ID của đơn hàng mới thêm vào
    echo "Thêm đơn hàng thành công. ID của đơn hàng: " . $orderId . "<br>";
} else {
    echo "Lỗi khi thêm đơn hàng: " . $conn->error . "<br>";
}

// Thêm dữ liệu vào bảng OrderDetails cho sản phẩm iPhone 15
$productId = 1; // ID của sản phẩm iPhone 15
$sqlOrderDetails = "INSERT INTO OrderDetails (order_id, product_id, quantity, subtotal) VALUES ";
$sqlOrderDetails .= "($orderId, $productId, 1, 0.00)"; // Thêm 1 sản phẩm iPhone 15

if ($conn->query($sqlOrderDetails) === TRUE) {
    echo "Thêm chi tiết đơn hàng thành công cho sản phẩm iPhone 15.<br>";
} else {
    echo "Lỗi khi thêm chi tiết đơn hàng: " . $conn->error . "<br>";
}

// Lấy thông tin đơn hàng
$sqlOrderInfo = "SELECT * FROM Orders WHERE order_id = $orderId";
$resultOrderInfo = $conn->query($sqlOrderInfo);
$orderInfo = $resultOrderInfo->fetch_assoc();

// Lấy thông tin chi tiết đơn hàng
$sqlOrderDetails = "SELECT od.order_detail_id, p.product_name, od.quantity, p.price, (od.quantity * p.price) AS subtotal
                    FROM OrderDetails od
                    JOIN Products p ON od.product_id = p.product_id
                    WHERE od.order_id = $orderId";
$resultOrderDetails = $conn->query($sqlOrderDetails);
$orderDetails = [];
while ($row = $resultOrderDetails->fetch_assoc()) {
    $orderDetails[] = $row;
}

// Tính tổng tiền
$totalAmount = 0;
foreach ($orderDetails as $detail) {
    $totalAmount += $detail['subtotal'];
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
</head>
<body>
    <h1>Chi tiết đơn hàng</h1>
    <form action="process_order.php" method="post">
        <h2>Thông tin người mua hàng</h2>
        <label for="first_name">Họ:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Tên:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" required>

        
    </form>
    <h2>Thông tin đơn hàng</h2>
    <p>ID đơn hàng: <?php echo $orderInfo['order_id']; ?></p>
    <p>Ngày đặt hàng: <?php echo $orderInfo['order_date']; ?></p>
    <p>Tổng tiền: <?php echo $totalAmount; ?></p>

    <h2>Chi tiết sản phẩm</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderDetails as $detail) { ?>
                <tr>
                    <td><?php echo $detail['order_detail_id']; ?></td>
                    <td><?php echo $detail['product_name']; ?></td>
                    <td><?php echo $detail['quantity']; ?></td>
                    <td><?php echo $detail['price']; ?></td>
                    <td><?php echo $detail['subtotal']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <form action="success.php" method="post">
        <!-- Ẩn ID đơn hàng để gửi lên trang success.php -->
        <input type="hidden" name="order_id" value="<?php echo $orderInfo['order_id']; ?>">
        <button type="submit">Thanh toán</button>
    </form>
</body>
</html>
