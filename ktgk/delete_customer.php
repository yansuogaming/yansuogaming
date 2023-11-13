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

// Xử lý xóa khách hàng
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];

    // Kiểm tra xem trường customer_id có rỗng không
    if (empty($customer_id)) {
        $error_message = "Vui lòng nhập mã khách hàng";
    } else {
        // Xóa khách hàng từ cơ sở dữ liệu
        $delete_customer_sql = "DELETE FROM Customers WHERE customer_id = '$customer_id'";

        if ($conn->query($delete_customer_sql) === TRUE) {
            // Xóa khách hàng thành công
            $success_message = "Khách hàng đã được xóa.";
            echo '<script>window.location.href = "manage_customers.php?success_message=' . urlencode($success_message) . '";</script>';
            exit();
        } else {
            $error_message = "Đã xảy ra lỗi trong quá trình xóa khách hàng.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Xóa khách hàng</title>
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
            width: 320px;
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

        .form-group .error {
            color: red;
            margin-top: 10px; /* Thêm khoảng cách giữa nút và thông báo lỗi */
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
        <h1>XOÁ KHÁCH HÀNG</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="customer_id">Mã khách hàng:</label>
                <input type="text" id="customer_id" name="customer_id">
            </div>
            <div class="form-group">
                <button type="submit">Xóa khách hàng</button>
            </div>
            <?php
            if (isset($error_message)) {
                echo '<div class="form-group error">' . $error_message . '</div>';
            } elseif (isset($success_message)) {
                echo '<div class="form-group success">' . $success_message . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>