<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "yansuo";
$password = "long2002";
$dbname = "salesmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy danh sách sản phẩm từ bảng Products
$sql = "SELECT * FROM Products";
$result = $conn->query($sql);

// Xử lý khi khách hàng chọn sản phẩm
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    // Xử lý các thông tin sản phẩm đã chọn ở đây
    // Ví dụ: Lưu thông tin vào session, thêm vào giỏ hàng, v.v.

    // Không chuyển hướng đến trang mới, vì có thể chọn nhiều sản phẩm
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chọn sản phẩm</title>
    <style>
        /* CSS styles */
    </style>
    <script>
    function selectProduct(productId) {
    // Xử lý khi khách hàng chọn sản phẩm
    // Ví dụ: Lưu thông tin vào session, thêm vào giỏ hàng, v.v.
  
    // Tìm phần tử checkbox được chọn
    var checkbox = document.getElementById(productId);

    // Kiểm tra xem checkbox có được chọn hay không
    if (checkbox.checked) {
        // Lấy giá trị sản phẩm từ phần tử HTML
        var productPrice = parseFloat(checkbox.getAttribute("data-price"));

        // Cộng giá trị sản phẩm vào tổng giá
        totalCost += productPrice;
    } else {
        // Lấy giá trị sản phẩm từ phần tử HTML
        var productPrice = parseFloat(checkbox.getAttribute("data-price"));

        // Trừ giá trị sản phẩm khỏi tổng giá
        totalCost -= productPrice;
    }
    window.addEventListener("DOMContentLoaded", function() {
        // Hiển thị giá trị tổng giá thành ban đầu khi trang web được tải
        var totalPriceElement = document.getElementById("totalPrice");
        var initialTotalCost = parseFloat(totalPriceElement.getAttribute("data-total-cost"));
        totalPriceElement.innerHTML = "Tổng giá thành: " + initialTotalCost.toFixed(2) + " đồng";
    });
    </script>
</head>
<body>
    <h1>Chọn sản phẩm</h1>

    <table>
        <!-- Hiển thị danh sách sản phẩm -->
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th></th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["product_id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td><input type='checkbox' onchange=\"selectProduct('" . $row["product_id"] . "')\"></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Không có sản phẩm.</td></tr>";
        }
        ?>
    </table>
    <div id="totalPrice" data-total-cost="0">Tổng giá thành: 0 đồng</div>
    <button onclick="buyProducts()">Mua hàng</button>
</body>
</html>