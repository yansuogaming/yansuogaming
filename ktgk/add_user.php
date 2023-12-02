<!DOCTYPE html>
<html>
<head>
    <title>Thêm người dùng</title>
    <style>
        body {
            margin: 20px;
            display:flex;
            align-items: center;
            height: 100vh;
            background-image: url(https://p1-jj.byteimg.com/tos-cn-i-t2oaga2asx/gold-user-assets/2020/2/19/1705d686ea3e4466~tplv-t2oaga2asx-image.image);
            background-size: cover;
            
            
        }

        .main{
           margin: auto;
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class='main'>
    <h1>THÊM NGƯỜI DÙNG</h1>

    <?php
    $servername = "localhost";
    $username = "yansuo";
    $password = "long2002";
    $dbname = "salesmanagement";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $username = $password = $email = $full_name = "";
    $username_err = $password_err = $email_err = $full_name_err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
            $username_err = "Vui lòng nhập tên người dùng";
        } else {
            $username = $_POST["username"];
        }

        if (empty($_POST["password"])) {
            $password_err = "Vui lòng nhập mật khẩu";
        } else {
            $password = $_POST["password"];
        if (strlen($password) < 6) {
            $password_length_err = "Mật khẩu phải có ít nhất 6 ký tự";
        }
    }

        if (empty($_POST["email"])) {
            $email_err = "Vui lòng nhập email";
        } else {
            $email = $_POST["email"];
        }

        if (empty($_POST["full_name"])) {
            $full_name_err = "Vui lòng nhập họ tên";
        } else {
            $full_name = $_POST["full_name"];
        }

        if (empty($username_err) && empty($password_err) && empty($email_err) && empty($full_name_err)) {
            // Truy vấn cơ sở dữ liệu để lấy RoleID mặc định
            $sql = "SELECT role_id FROM Roles WHERE role_name = 'default'";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $role_id = $row["role_id"];
            } else {
                // Nếu không tìm thấy RoleID mặc định, sử dụng giá trị cố định
                $role_id = 2;
            }

                // Tiếp tục thêm người dùng vào cơ sở dữ liệu với RoleID đã xác định
                $sql = "INSERT INTO Users (username, password, email, full_name, role_id) VALUES ('$username', '$password', '$email', '$full_name', $role_id)";

            if ($conn->query($sql) === TRUE) {
                echo "Người dùng đã được thêm thành công!";
                header("refresh:3; url=manage_users.php"); // Tự động quay lại trang manage_users.php sau 3 giây
                exit(); // Kết thúc kịch bản PHP sau khi chuyển hướng
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }
    }

    $conn->close();
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        <span class="error"><?php echo $username_err; ?></span>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password" required>
        <span class="error"><?php echo $password_err; ?></span>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
        <span class="error"><?php echo $email_err; ?></span>

        <label for="full_name">Tên:</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>" required>
        <span class="error"><?php echo $full_name_err; ?></span>

        <input type="submit" value="Thêm">

    </form>

</body>
</html>