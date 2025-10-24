<?php

// Lấy tổng doanh thu (cộng tất cả total trong bảng orders có trạng thái 'Hoàn tất')
$sqlRevenue = "SELECT SUM(total) AS total_revenue FROM orders WHERE status = 'completed'";
$resultRevenue = $connect->query($sqlRevenue);
$totalRevenue = 0;
if ($resultRevenue && $row = $resultRevenue->fetch_assoc()) {
    $totalRevenue = $row['total_revenue'] ?? 0;
}

// Lấy số lượng đơn hàng
$sqlOrders = "SELECT COUNT(*) AS total_orders FROM orders";
$resultOrders = $connect->query($sqlOrders);
$totalOrders = $resultOrders->fetch_assoc()['total_orders'] ?? 0;

// Lấy số lượng sản phẩm
$sqlProducts = "SELECT COUNT(*) AS total_products FROM products";
$resultProducts = $connect->query($sqlProducts);
$totalProducts = $resultProducts->fetch_assoc()['total_products'] ?? 0;

// Lấy số lượng khách hàng (user)
$sqlUsers = "SELECT COUNT(*) AS total_users FROM users";
$resultUsers = $connect->query($sqlUsers);
$totalUsers = $resultUsers->fetch_assoc()['total_users'] ?? 0;

// Lấy 5 đơn hàng gần nhất
$sqlRecent = "SELECT o.id_order, u.full_name, o.status 
              FROM orders o 
              JOIN users u ON u.id_user = o.id_user 
              ORDER BY o.created_at DESC 
              LIMIT 5";
$resultRecent = $connect->query($sqlRecent);
$recentOrders = [];
if ($resultRecent) {
    while ($row = $resultRecent->fetch_assoc()) {
        $recentOrders[] = $row;
    }
}
// Đếm tổng số yêu cầu hỗ trợ
$totalSupportRequests = $connect->query("SELECT COUNT(*) AS total FROM requirements")->fetch_assoc()['total'];
