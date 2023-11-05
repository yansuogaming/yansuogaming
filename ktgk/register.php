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
            padding: 30px;
            margin: 0 auto;
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
        }
        .container h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ĐĂNG KÝ</h1>
        <form method="post" action="register_process.php">
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

