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

// Lấy danh sách khách hàng từ bảng Customers
$sql = "SELECT * FROM Customers";
$result = $conn->query($sql);

$error_message = "";

// Xử lý khi form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    // Kiểm tra các trường nhập liệu
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
        $error_message = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Thực hiện thêm khách hàng vào cơ sở dữ liệu
        // ...
        // Redirect hoặc hiển thị thông báo thành công
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý khách hàng</title>
    <style>
        body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url(https://www.schemecolor.com/wallpaper?i=54674&desktop);
        margin: 0;
        padding: 20px;
        background-color: #f5f5f5;
        text-align: center;
        flex-direction: column;
    }

        button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 60px;
        cursor: pointer;
        margin-right: 10px;
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;

    }

    .button-container button {
        margin: 0 5px;
    }
    button:hover {
        background-color: #45a049;
    }

    button:last-child {
        margin-right: 0;
    }

    .add-button {
        margin-top: 10px;
    }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
        <script>
        function exportExcel() {
            var confirmation = confirm("Bạn có muốn xuất file Excel không?");
            if (confirmation) {
                window.location.href = "export_excel_customers.php";
            }
        }

        function logout() {
            if (confirm('Bạn có chắc chắn quay lại không?')) {
                window.location.href = "home.php";
            }
        }

        function navigateToProducts() {
            window.location.href = "manage_products.php";
        }

        function redirectToProductSelection(customerId) {
        // Chuyển hướng đến trang select_product.php
        window.location.href = "order.php?customer_id=" + customerId;
    }

    </script>
</head>

<body>
    <h1>QUẢN LÝ KHÁCH HÀNG</h1>

    <table>
        <tr>
            <th>Mã khách hàng</th>
            <th>Tên</th>
            <th>Họ, tên đệm</th>
            <th>Email</th>
            <th>Số điện thoại</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Hiển thị dữ liệu khách hàng
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["customer_id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>";
                echo "<div class='button-container'>";
                // Thêm nút "Mua sản phẩm" với thuộc tính onclick
                echo "<button type='button' onclick='redirectToProductSelection(" . $row["customer_id"] . ")'>Mua sản phẩm</button>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Không có khách hàng.</td></tr>";
        }
        ?>
    </table>
    <div class = "button-container">
    <button onclick="window.location.href='add_customers.php'" class="add-button">Thêm khách hàng</button>
    <button onclick="window.location.href='edit_customer.php'" class="edit-button">Sửa khách hàng</button>
    <button onclick="window.location.href='delete_customer.php'" class="del-button">Xoá khách hàng</button>
    <button type="button" onclick="exportExcel()">Xuất Excel</button>
    <button type="button" onclick="logout()">Quay lại</button>
    </div>
</body>
</html>