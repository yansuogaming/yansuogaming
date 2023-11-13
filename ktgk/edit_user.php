<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa người dùng</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(https://images7.alphacoders.com/131/1318803.jpeg);
            background-size: cover;
        }
        </style>
</head>
<body>
    <h1>Chỉnh sửa người dùng</h1>

    <?php
    $servername = "localhost";
    $username = "yansuo";
    $password = "long2002";
    $dbname = "salesmanagement";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_POST["user_id"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $full_name = $_POST["full_name"];

        $sql = "UPDATE Users
                SET username = '$username', password = '$password', full_name = '$full_name'
                WHERE user_id = $user_id";

        if ($conn->query($sql) === TRUE) {
            echo "Thông tin người dùng đã được cập nhật thành công!";
            header("refresh:3; url=manage_users.php"); // Tự động quay lại trang manage_users.php sau 3 giây
            exit(); // Kết thúc kịch bản PHP sau khi chuyển hướng
        } else {
            echo "Lỗi: " . $conn->error;
        }
    }

    if (isset($_GET["user_id"])) {
        $user_id = $_GET["user_id"];

        $sql = "SELECT * FROM Users WHERE user_id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            echo "Không tìm thấy người dùng!";
            exit();
        }
    } else {
        exit();
    }

    $conn->close();
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="user_id" value="<?php echo $user["user_id"]; ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $user["username"]; ?>" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" id="full_name" value="<?php echo $user["full_name"]; ?>" required><br><br>

        <input type="submit" value="Cập nhật">
    </form>

</body>
</html>