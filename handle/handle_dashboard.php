<?php

// Lấy tổng doanh thu (cộng tất cả total trong bảng orders có trạng thái 'Hoàn tất')
$resultRevenue = $connect->query("SELECT SUM(total) AS total_revenue FROM orders WHERE status = 'completed'");
$totalRevenue = 0;
if ($row = $resultRevenue->fetch_assoc()) {
    $totalRevenue = $row['total_revenue'] ?? 0;
}

// Lấy số lượng đơn hàng
$resultOrders = $connect->query("SELECT COUNT(*) AS total_orders FROM orders");
$totalOrders = $resultOrders->fetch_assoc()['total_orders'] ?? 0;

// Lấy số lượng sản phẩm
$resultProducts = $connect->query("SELECT COUNT(*) AS total_products FROM products");
$totalProducts = $resultProducts->fetch_assoc()['total_products'] ?? 0;

// Lấy số lượng khách hàng (user)
$resultUsers = $connect->query("SELECT COUNT(*) AS total_users FROM users");
$totalUsers = $resultUsers->fetch_assoc()['total_users'] ?? 0;

// Lấy 5 đơn hàng gần nhất
$resultRecent = $connect->query("SELECT * FROM orders o JOIN users u ON u.id_user = o.id_user ORDER BY o.created_at DESC LIMIT 5");
$recentOrders = [];
if ($resultRecent) {
    while ($row = $resultRecent->fetch_assoc()) {
        $recentOrders[] = $row;
    }
}

// Đếm tổng số yêu cầu hỗ trợ
$totalSupportRequests = $connect->query("SELECT COUNT(*) AS total FROM requirements")->fetch_assoc()['total'];
