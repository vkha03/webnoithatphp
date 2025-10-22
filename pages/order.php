<?php
require './handle/handle_order.php';
?>
<div class="container my-5">
    <h3 class="mb-4 text-center">Đơn hàng của bạn</h3>

    <!-- Bộ lọc trạng thái -->
    <form method="get" class="mb-4 text-center">
        <input type="hidden" name="page" value="order">
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-6">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả đơn hàng --</option>
                    <option value="pending" <?= $statusFilter == 'pending' ? 'selected' : '' ?>>⏳ Đang xử lý</option>
                    <option value="shipping" <?= $statusFilter == 'shipping' ? 'selected' : '' ?>>🚚 Đang giao</option>
                    <option value="completed" <?= $statusFilter == 'completed' ? 'selected' : '' ?>>✅ Hoàn tất</option>
                    <option value="cancelled" <?= $statusFilter == 'cancelled' ? 'selected' : '' ?>>❌ Đã hủy</option>
                </select>
            </div>
        </div>
    </form>

    <?php if ($resultOrders->num_rows > 0) { ?>
        <div class="table-responsive">
            <table class="table table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt</th>
                        <th>Trạng thái</th>
                        <th>Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($order = $resultOrders->fetch_assoc()) {
                        switch ($order['status']) {
                            case 'pending':
                                $statusText = '⏳ Đang xử lý';
                                break;
                            case 'shipping':
                                $statusText = '🚚 Đang giao';
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
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= htmlspecialchars($order['id_order']) ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($order['created_at'])) ?></td>
                            <td><?= $statusText ?></td>
                            <td>
                                <a href="./index.php?page=order_detail&id_order=<?= $order['id_order'] ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i> Xem
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <div class="alert alert-info text-center">
            Không có đơn hàng nào trong trạng thái này 😢 <br>
            <a href="./index.php?page=product" class="btn btn-primary btn-sm mt-3">Mua sắm ngay</a>
        </div>
    <?php } ?>
</div>