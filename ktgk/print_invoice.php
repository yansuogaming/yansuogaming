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

// Kiểm tra nếu có giá trị invoice_id được truyền qua URL
if (isset($_GET['invoice_id'])) {
    $invoice_id = $_GET['invoice_id'];

    // Truy vấn để lấy thông tin hoá đơn
    $sql = "SELECT * FROM invoices WHERE invoice_id = '$invoice_id'";
    $result = $conn->query($sql);

    // Kiểm tra và lấy thông tin hoá đơn
    if ($result && $result->num_rows > 0) { // Thêm kiểm tra $result trước khi sử dụng num_rows
        $invoice = $result->fetch_assoc();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>In hoá đơn</title>
            <style>
                /* CSS code here */
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Hoá đơn</h1>
                <table>
                    <tr>
                        <th>Mã hoá đơn:</th>
                        <td><?php echo $invoice['invoice_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Tên khách hàng:</th>
                        <td><?php echo $invoice['customer_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ:</th>
                        <td><?php echo $invoice['customer_address']; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $invoice['customer_email']; ?></td>
                    </tr>
                    <tr>
                        <th>Sản phẩm:</th>
                        <td><?php echo $invoice['product_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Giá:</th>
                        <td><?php echo $invoice['product_price']; ?></td>
                    </tr>
                    <tr>
                        <th>Số lượng:</th>
                        <td><?php echo $invoice['quantity']; ?></td>
                    </tr>
                    <tr>
                        <th>Tổng tiền:</th>
                        <td><?php echo $invoice['total_amount']; ?></td>
                    </tr>
                </table>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Không tìm thấy hoá đơn.";
    }
}

// Đóng kết nối
$conn->close();