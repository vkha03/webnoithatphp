<?php
require './handle/handle_dashboard.php';
?>

<style>
    .card {
        transition: 0.2s ease-in-out;
    }

    .card:hover {
        transform: scale(1.03);
        cursor: pointer;
        filter: brightness(1.1);
    }

    /* Căn 5 card đều nhau trên 1 hàng */
    @media (min-width: 992px) {
        .col-md-3.custom-20 {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">
        <i class="bi bi-speedometer2 me-2"></i>Bảng điều khiển quản trị
    </h2>

    <!-- Các thẻ thống kê -->
    <div class="row g-4 mb-4 justify-content-center">
        <div class="col-md-3 custom-20">
            <div class="card text-white bg-primary shadow-sm rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Tổng doanh thu</h5>
                    <h3><?= number_format($totalRevenue, 0, ',', '.') ?>₫</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 custom-20">
            <div class="card text-white bg-success shadow-sm rounded-4"
                onclick="window.location.href='./index.php?page=order'">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Đơn hàng</h5>
                    <h3><?= $totalOrders ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 custom-20">
            <div class="card text-white bg-warning shadow-sm rounded-4"
                onclick="window.location.href='./index.php?page=product'">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Sản phẩm</h5>
                    <h3><?= $totalProducts ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 custom-20">
            <div class="card text-white bg-danger shadow-sm rounded-4"
                onclick="window.location.href='./index.php?page=admin_users'">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Khách hàng</h5>
                    <h3><?= $totalUsers ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 custom-20">
            <div class="card text-white bg-info shadow-sm rounded-4"
                onclick="window.location.href='./index.php?page=list_request'">
                <div class="card-body text-center">
                    <h5 class="card-title mb-1">Yêu cầu hỗ trợ</h5>
                    <h3><?= $totalSupportRequests ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Đơn hàng gần đây -->
    <div class="card shadow-sm border-0 rounded-4 mt-4">
        <div class="card-header bg-light fw-bold">
            <i class="bi bi-receipt me-2"></i>Đơn hàng gần đây
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recentOrders)): ?>
                        <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td>#<?= $order['id_order'] ?></td>
                                <td><?= htmlspecialchars($order['full_name']) ?></td>
                                <td>
                                    <?php
                                    $statusColor = match ($order['status']) {
                                        'Hoàn tất' => 'success',
                                        'Đang giao' => 'warning',
                                        'Đã hủy' => 'danger',
                                        default => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $statusColor ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Chưa có đơn hàng nào
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>