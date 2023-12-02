<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy ID đơn hàng từ biểu mẫu trước đó
    $orderId = $_POST['order_id'];

    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "salesmanagement";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

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

    // Đóng kết nối
    $conn->close();

    // Hiển thị thông báo và thông tin sản phẩm
    echo "Thanh toán thành công! Đơn hàng có ID: $orderId";

    echo "<h2>Chi tiết sản phẩm</h2>";
    echo "<table border='1'>";
    echo "<thead><tr><th>ID</th><th>Tên sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Thành tiền</th></tr></thead>";
    echo "<tbody>";
    foreach ($orderDetails as $detail) {
        echo "<tr>";
        echo "<td>{$detail['order_detail_id']}</td>";
        echo "<td>{$detail['product_name']}</td>";
        echo "<td>{$detail['quantity']}</td>";
        echo "<td>{$detail['price']}</td>";
        echo "<td>{$detail['subtotal']}</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Chuyển hướng về trang chính (index.php) sau một khoảng thời gian ngắn (ví dụ: 5 giây)
    header('refresh:5;url=manage_products.php');
    exit;
} else {
    // Nếu truy cập trang success.php mà không thông qua POST request, chuyển hướng về trang chính
    header('Location: manage_products.php');
    exit;
}
?>
