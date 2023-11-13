<!DOCTYPE html>
<html>
<head>
    <title>Thêm người dùng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
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
    <h1>Thêm người dùng</h1>

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
            $role_id = 1; // Đặt RoleID mặc định là 1

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
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $username; ?>" required>
        <span class="error"><?php echo $username_err; ?></span>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <span class="error"><?php echo $password_err; ?></span>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
        <span class="error"><?php echo $email_err; ?></span>

        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>" required>
        <span class="error"><?php echo $full_name_err; ?></span>

        <input type="submit" value="Thêm">

    </form>

</body>
</html>