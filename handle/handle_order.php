<?php
// Kiểm tra đăng nhập
if (config_checkLogin() == false) {
    echo "<script>alert('Vui lòng đăng nhập để xem đơn hàng!'); 
    window.location.href = './index.php?page=login';</script>";
    exit;
}

$id_user = $config_id_user;

// === XÓA ĐƠN HÀNG (chỉ admin) ===
if (isset($_GET['delete']) && config_checkRole('admin') == true) {
    $id_order = intval($_GET['delete']); // tránh SQL injection

    // Xóa chi tiết đơn hàng trước
    $connect->query("DELETE FROM order_items WHERE id_order = '$id_order'");
    // Xóa đơn hàng
    $connect->query("DELETE FROM orders WHERE id_order = '$id_order'");

    echo "<script>
        alert('Đã xóa đơn hàng thành công!');
        window.history.back();
    </script>";
    exit;
}

// === Bộ lọc trạng thái ===
$statusFilter = $_GET['status'] ?? ''; // Lấy trạng thái từ URL

$where = "";
if (!empty($statusFilter) && in_array($statusFilter, ['pending', 'shipping', 'completed', 'cancelled'])) {
    $where = "AND status = '$statusFilter'";
}

// Lấy danh sách đơn hàng (admin xem tất cả, user chỉ xem của mình)
if (config_checkRole('admin') == true) {
    $sqlOrders = "SELECT * FROM orders WHERE 1=1 $where ORDER BY created_at DESC";
} else {
    $sqlOrders = "SELECT * FROM orders WHERE id_user = '$id_user' $where ORDER BY created_at DESC";
}

$resultOrders = $connect->query($sqlOrders);

// === Cập nhật trạng thái đơn hàng ===
if (isset($_POST['id_order']) && isset($_POST['status'])) {
    $id_order = $_POST['id_order'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status = '$status' WHERE id_order = '$id_order'";
    if ($connect->query($sql)) {
        echo "<script>
            alert('Cập nhật trạng thái thành công!');
            window.location.href = './index.php?page=order';
        </script>";
    } else {
        echo "<script>
            alert('Lỗi khi cập nhật!');
            window.location.href = './index.php?page=order';
        </script>";
    }
}
