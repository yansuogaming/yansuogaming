<!DOCTYPE html>
<html>
<head>
    <title>Thêm Khách Hàng</title>
    <style>
        body {
            display:flex;
            margin: auto;
            align-items: center;
            height: 100vh;
            background-image: url(https://p1-jj.byteimg.com/tos-cn-i-t2oaga2asx/gold-user-assets/2020/2/19/1705d686ea3e4466~tplv-t2oaga2asx-image.image);
            background-size: cover;
            
        }
        .main{
           margin: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 330px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;            
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

    </style>

</head>
<body>
    <div class='main'>
    <h1>THÊM KHÁCH HÀNG</h1>
    <form method="post" action="add_customers_process.php">
        <label for="first_name">Tên:</label>
        <input type="text" id="first_name" name="first_name" required>
        <br>
        <label for="last_name">Họ, tên đệm:</label>
        <input type="text" id="last_name" name="last_name" required>
        <br>
        <!-- Bổ sung phần email và phone -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone" required>
        <br>
        <input type="submit" value="Thêm khách hàng">
    </form>
    </div>
</body>
</html>