<?php
if (config_checkLogin() == false) {
    echo "<script>alert('Vui lòng đăng nhập để xem chi tiết đơn hàng!'); 
    window.location.href = './index.php?page=login';</script>";
    exit;
}

$id_user = $config_id_user;
$id_order = $_GET['id_order'] ?? 0;

// Lấy thông tin đơn hàng
$sqlOrder = "SELECT o.*, u.full_name, u.email, a.recipient_name AS address_name, a.phone AS address_phone, a.province, a.district, a.ward, a.street, a.label AS address_label
             FROM orders o
             JOIN users u ON o.id_user = u.id_user
             LEFT JOIN addresses a ON o.id_address = a.id_address
             WHERE o.id_order = '$id_order'";
$resultOrder = $connect->query($sqlOrder);
$order = $resultOrder->fetch_assoc();

// Lấy chi tiết sản phẩm trong đơn hàng
$sqlItems = "SELECT oi.*, p.name, p.sell_price, p.image
             FROM order_items oi
             JOIN products p ON p.id_product = oi.id_product 
             WHERE oi.id_order = '$id_order'";
$resultItems = $connect->query($sqlItems);

// Xử lý trạng thái hiển thị
switch ($order['status']) {
    case 'pending':
        $statusText = '⏳ Đang xử lý';
        break;
    case 'shipping':
        $statusText = '🚚 Đang giao hàng';
        break;
    case 'completed':
        $statusText = '✅ Hoàn tất';
        break;
    case 'cancelled':
        $statusText = '❌ Đã hủy';
        break;
    default:
        $statusText = 'Không xác định';
}
