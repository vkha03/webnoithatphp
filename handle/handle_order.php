<?php
// Kiểm tra đăng nhập
if (config_checkLogin() == false) {
    echo "<script>alert('Vui lòng đăng nhập để xem đơn hàng!'); 
    window.location.href = './index.php?page=login';</script>";
    exit;
}

$id_user = $config_id_user;

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
