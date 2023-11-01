<!DOCTYPE html>
<html>
<head>
    <title>Kết quả tìm kiếm</title>
</head>
<body>
    <h2>Kết quả tìm kiếm</h2>

    <?php
    // Kiểm tra xem đã nhận được từ khóa tìm kiếm hay chưa
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];

        // Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Escape các ký tự đặc biệt trong từ khóa tìm kiếm
        $searchQuery = $conn->real_escape_string($searchQuery);

        // Truy vấn tìm kiếm sản phẩm theo tên
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchQuery%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị kết quả tìm kiếm
            while ($row = $result->fetch_assoc()) {
                echo "Tên sản phẩm: " . $row["product_name"] . "<br>";
                echo "Giá: " . $row["price"] . "<br>";
                echo "Mô tả: " . $row["description"] . "<br>";
                echo "Chất lượng sản phẩm: " . $row["stock_quantity"] . "<br>";
                echo "<hr>";
            }
        } else {
            echo "Không tìm thấy sản phẩm phù hợp.";
        }

        // Đóng kết nối
        $conn->close();
    } else {
        echo "Không có từ khóa tìm kiếm.";
    }
    ?>
</body>
</html>

