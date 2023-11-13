<!DOCTYPE html>
<html>
<head>
    <title>Quản lý người dùng</title>
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
                window.location.href = "export_excel_users.php";
            }
        }

        function logout() {
            if (confirm('Bạn có chắc chắn quay lại không?')) {
                window.location.href = "home.php";
            }
        }
    </script>
</head>
<body>
    <h1>QUẢN LÝ NGƯỜI DÙNG</h1>

    <?php
    $servername = "localhost";
    $username = "yansuo";
    $password = "long2002";
    $dbname = "salesmanagement";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn danh sách người dùng
    $sql = "SELECT * FROM Users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID người dùng</th>
                    <th>Tên đăng nhập</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Mã định danh</th>
                    <th>Button</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>" . $row["user_id"] . "</td>
            <td>" . $row["username"] . "</td>
            <td>" . $row["full_name"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["role_id"] . "</td>
            <td>
                <a href='edit_user.php?user_id=" . $row["user_id"] . "'>Sửa</a>
                <a href='delete_user.php?user_id=" . $row["user_id"] . "'>Xóa</a>
            </td>";
        }

        echo "</table>";
    } else {
        echo "Không có người dùng nào.";
    }

    // Đóng kết nối tới cơ sở dữ liệu
    $conn->close();
    ?>
    <div class = "button-container">
    <button onclick="window.location.href='add_user.php'" class="add-button">Thêm người dùng</button>
    <button type="button" onclick="exportExcel()">Xuất Excel</button>
    <button type="button" onclick="logout()">Quay lại</button>
    </div>
</body>
</html>