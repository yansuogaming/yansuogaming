<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa thông tin khách hàng</title>
    <style>
        body {
            width: 100%;
            display: flex;
            align-items: center;
            height: 100vh;
            background-image: url(https://p1-jj.byteimg.com/tos-cn-i-t2oaga2asx/gold-user-assets/2020/2/19/1705d686ea3e4466~tplv-t2oaga2asx-image.image);
            background-size: cover;            
            font-size: 20px;
            text-align: center;
            justify-content: space-between;
            
        }
        .container{
        }
        .main{
            margin:auto;
            
        }
        .box-1{
            margin-left:0%;
        }
        .box{
            display: flex;
            flex-direction:column;
            /* margin-left:50%; */
            margin:auto;
            width: 550px;
            height: 500px;
            background-color:#fff;
            border-radius: 10px;
        }
        /* .container {
            width: 900px;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: white;
            /* text-align: center; */
        } */

        .container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .container form {
            margin-bottom: 20px;
        }

        .container form label {
            display: block;
            margin-bottom: 10px;
        }

        .container form input[type="text"],
        .container form input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .container form input[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .container form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container h3 {
            margin-bottom: 10px;
        }

        .container form input[type="hidden"] {
            display: none;
        }

        .center-text {
            text-align: center;
        }
    </style>

<script>
    function validateForm() {
        var customerId = document.getElementById('customer_id').value;
        if (customerId.trim() === '') {
            alert('Vui lòng nhập mã ID khách hàng.');
            return false;
        }

        // Gửi yêu cầu tìm kiếm đến server và nhận kết quả tìm kiếm

        // Sau khi tìm kiếm thành công
        // Ẩn dòng "Chỉnh sửa thông tin khách hàng" và trường nhập mã ID khách hàng
        document.getElementById('edit_customer_title').style.display = 'none';
        document.getElementById('customer_id_label').style.display = 'none';
        document.getElementById('customer_id').style.display = 'none';

        return true;
    }
</script>

</head>
<body>
    <div class='box'>
        <div class='box-1'>
    <div class='main'>
    <h2>SỬA THÔNG TIN KHÁCH HÀNG </h2>
    <?php
    $selected_customer_id = "";
    $selected_first_name = "";
    $selected_last_name = "";
    $selected_email = "";
    $selected_phone = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer_id"])) {
        $selected_customer_id = $_POST["customer_id"];

        // Kết nối tới cơ sở dữ liệu
        $servername = "localhost";
        $username = "yansuo";
        $password = "long2002";
        $dbname = "salesmanagement";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Kết nối tới cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Lấy thông tin khách hàng dựa trên mã ID
        $sql = "SELECT first_name, last_name, email, phone FROM Customers WHERE customer_id = $selected_customer_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $selected_first_name = $row["first_name"];
            $selected_last_name = $row["last_name"];
            $selected_email = $row["email"];
            $selected_phone = $row["phone"];
            echo '<script>hideCustomerIdField();</script>'; // Thêm dòng này để gọi hàm ẩn trường customerIdField
        } else {
            echo "Không tìm thấy khách hàng với mã ID đã nhập.";
        }

        // Đóng kết nối tới cơ sở dữ liệu
        $conn->close();
    }
    ?>

<form method="POST" action="edit_customer.php" onsubmit="return validateForm();">
    <label for="customer_id" id="customer_id_label" class="center-text">Nhập mã ID khách hàng:</label>
    <input type="text" id="customer_id" name="customer_id" value="<?php echo $selected_customer_id; ?>" required><br><br>
    <input type="submit" value="Tìm kiếm">
</form>
</div>
<div class='main-1'>
    <?php if (!empty($selected_first_name)) : ?>
        <h3>Thông tin khách hàng:</h3>
        <form method="POST" action="edit_customer_process.php">
            <input type="hidden" name="customer_id" value="<?php echo $selected_customer_id; ?>">
            
            <label for="first_name">Họ:</label>
            <input type="text" name="first_name" value="<?php echo $selected_first_name; ?>" required><br><br>
            
            <label for="last_name">Tên:</label>
            <input type="text" name="last_name" value="<?php echo $selected_last_name; ?>" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $selected_email; ?>" required><br><br>
            
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" value="<?php echo $selected_phone; ?>" required pattern="[0-9]{10}" title="Vui lòng nhập đúng 10 số điện thoại."><br><br>
            
            <input type="submit" value="Cập nhật">
        </form>
    <?php endif; ?>
    </div>
    </div>
    </div>
</body>
</html>