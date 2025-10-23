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
                        $currentStatus = $order['status'];
                        switch ($currentStatus) {
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
                            <td>
                                <?= $statusText ?>
                                <?php if (config_checkRole('admin') === true) { ?>
                                    <form method="POST" action="./index.php?page=handle_order" style="display:inline-block;">
                                        <input type="hidden" name="id_order" value="<?= $order['id_order'] ?>">

                                        <!-- icon bấm hiện dropdown -->
                                        <i class="bi bi-pencil-square"
                                            style="cursor:pointer; color:#007bff; margin-left:6px;"
                                            onclick="this.nextElementSibling.style.display='inline-block'"></i>

                                        <!-- dropdown ẩn ban đầu -->
                                        <select name="status" style="display:none; padding:3px 5px; border-radius:5px;"
                                            onchange="this.form.submit()">
                                            <option value="pending" <?= $currentStatus == 'pending' ? 'selected' : '' ?>>⏳ Đang xử lý</option>
                                            <option value="shipping" <?= $currentStatus == 'shipping' ? 'selected' : '' ?>>🚚 Đang giao hàng</option>
                                            <option value="completed" <?= $currentStatus == 'completed' ? 'selected' : '' ?>>✅ Hoàn tất</option>
                                            <option value="cancelled" <?= $currentStatus == 'cancelled' ? 'selected' : '' ?>>❌ Đã hủy</option>
                                        </select>
                                    </form>
                                <?php } ?>
                            </td>
                            <td>
                                <a href="./index.php?page=order_detail&id_order=<?= $order['id_order'] ?>"
                                    class="btn btn-info btn-sm">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php if (config_checkRole('admin') === true) { ?>
                                    <a href="./index.php?page=handle_order&delete=<?= $order['id_order'] ?>"
                                        onclick="return confirm('Xác nhận xóa đơn hàng này?')"
                                        class="btn btn-danger btn-sm" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                <?php } ?>
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