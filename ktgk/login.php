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

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //Tiếp tục phần mã nguồn của tệp "login.php":

        // Đăng nhập thành công
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role_id"] = $user["role_id"];

        // Chuyển hướng đến trang chủ sau khi đăng nhập
        header("Location: manage_products.php");
        exit();
    } else {
        // Đăng nhập thất bại
        $error_message = "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
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
            width: 400px;
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
            background-color: #FF6600;
            color: #fff;
            border-radius: 5px; 
            margin-right: 5px;
        }

        .form-group .error {
            color: red;
        }
        .container h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ĐĂNG NHẬP</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Đăng nhập</button>
            </div>
            <?php
            if (isset($error_message)) {
                echo '<div class="form-group error">' . $error_message . '</div>';
            }
            ?>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
    </div>
</body>
</html>

