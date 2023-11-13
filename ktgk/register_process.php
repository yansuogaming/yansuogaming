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

// Xử lý đăng ký
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];

    // Kiểm tra xem tên đăng nhập đã tồn tại chưa
    $check_username_sql = "SELECT * FROM Users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_sql);

    if ($check_username_result->num_rows > 0) {
        $error_message = "Tên đăng nhập đã tồn tại.";
    } else {
        // Thêm người dùng mới vào cơ sở dữ liệu
        $role_id = 2; // Gán vai trò người dùng
        $register_sql = "INSERT INTO Users (username, password, full_name, email, role_id) VALUES ('$username', '$password', '$full_name', '$email', $role_id)";

        if ($conn->query($register_sql) === TRUE) {
            // Đăng ký thành công
            $success_message = "Đã đăng ký tài khoản thành công.";
            // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Đã xảy ra lỗi trong quá trình đăng ký: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng ký</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(https://p1-jj.byteimg.com/tos-cn-i-t2oaga2asx/gold-user-assets/2020/2/19/1705d686ea3e4466~tplv-t2oaga2asx-image.image);
            background-size: cover;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
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
        }

        .form-group .success {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng ký</h2>
        <?php
        if (isset($error_message)) {
            echo '<div class="form-group error">' . $error_message . '</div>';
        } elseif (isset($success_message)) {
            echo '<div class="form-group success">' . $success_message . '</div>';
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="full_name">Họ và tên:</label>
                <input type="text" id="full_name" name="full_name">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div>
            <div class="form-group">
                <button type="submit">Đăng ký</button>
            </div>
        </form>
        <p>Đã có tài khoản? <a href="index.php">Đăng nhập</a></p>
    </div>
</body>
</html>