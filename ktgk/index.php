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

        .container .btn-export {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>ĐĂNG NHẬP</h1>
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a></p>
        <p style="text-align: center; margin-top: 20px;">© Copyright by Yansuo</p>
        </div>
    </div>
    
</body>
</html>