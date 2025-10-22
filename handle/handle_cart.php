<?php
// Hiển thị giỏ hàng
$resultCartIndex = $connect->query("select * from cart_items c join products p on p.id_product = c.id_product where c.id_user = '$config_id_user'");
$totalPriceIndex = 0;

// === Lấy số lượng sản phẩm trong giỏ hàng ===
$sqlCartCount = "SELECT COUNT(*) AS total_cart FROM cart_items WHERE id_user = '$config_id_user'";
$resultCartCount = $connect->query($sqlCartCount);
$rowCartCount = $resultCartCount->fetch_assoc();
$totalCart = $rowCartCount['total_cart'] ?? 0;

// === Lấy số lượng đơn hàng ===
// Giả sử bảng đơn hàng là `orders`, cột id_user là khóa ngoại
$sqlOrderCount = "SELECT COUNT(*) AS total_order FROM orders WHERE id_user = '$config_id_user'";
$resultOrderCount = $connect->query($sqlOrderCount);
$rowOrderCount = $resultOrderCount->fetch_assoc();
$totalOrder = $rowOrderCount['total_order'] ?? 0;

if (isset($_GET['id_item'])) {
    // Lấy id sản phẩm trong giỏ hàng (id_cart)
    $id_item = $_GET['id_item'] ?? 0;

    // Kiểm tra hợp lệ
    if ($id_item <= 0) {
        echo "<script>
        alert('ID giỏ hàng không hợp lệ!');
        history.back();
    </script>";
        exit;
    }

    // Xóa sản phẩm trong giỏ hàng của user hiện tại
    $sqlDelete = "DELETE FROM cart_items WHERE id_item = '$id_item' AND id_user = '$config_id_user'";

    if ($connect->query($sqlDelete)) {
        echo "<script>
        alert('Đã xóa sản phẩm khỏi giỏ hàng!');
        if (document.referrer) {
            window.location.href = document.referrer;
        } else {
            window.location.href = './index.php?page=home';
        }
    </script>";
    } else {
        echo "<script>
        alert('Lỗi khi xóa: " . addslashes($connect->error) . "');
        history.back();
    </script>";
    }
}
