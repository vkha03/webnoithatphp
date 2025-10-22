<?php
require './handle/handle_order_detail.php';
?>

<style>
    .order-detail-container {
        max-width: 1200px;
        margin: 2rem auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .order-header {
        background-color: #f8f9fa;
        padding: 2rem;
        border-radius: 0.75rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .order-header h3 {
        font-weight: 600;
        color: #0056b3;
    }

    .order-header .badge {
        font-size: 1rem;
        padding: 0.5em 0.75em;
    }

    .details-card,
    .items-card {
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .details-card h5,
    .items-card h5 {
        font-weight: 600;
        border-bottom: 2px solid #eee;
        padding-bottom: 0.75rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
    }

    .details-card h5 i,
    .items-card h5 i {
        margin-right: 0.75rem;
        color: #007bff;
    }

    .detail-group {
        /* display: grid; */
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .detail-item p {
        margin-bottom: 0.5rem;
    }

    .detail-item strong {
        color: #555;
    }

    .product-table img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.25rem;
    }

    .product-table th,
    .product-table td {
        vertical-align: middle;
    }


    .table-responsive {
        margin-top: 1rem;
    }

    .total-row td {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
    }

    .btn-custom {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        border-radius: 0.25rem;
        transition: all 0.3s ease;
    }

    .btn-print {
        background-color: #6c757d;
        color: white;
    }

    .btn-print:hover {
        background-color: #5a6268;
    }

    .btn-back {
        background-color: #007bff;
        color: white;
    }

    .btn-back:hover {
        background-color: #0056b3;
    }
</style>

<div class="order-detail-container">
    <div class="order-header text-center">
        <h3>Chi tiết đơn hàng #<?= htmlspecialchars($order['id_order']) ?></h3>
        <p class="lead text-muted mb-0">Cảm ơn bạn đã tin tưởng và mua sắm tại DecoX.</p>
        <span class="badge bg-primary mt-2">
            <?= $statusText ?>
        </span>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="items-card">
                <h5><i class="bi bi-box-seam"></i>Sản phẩm trong đơn</h5>
                <div class="table-responsive">
                    <table class="table product-table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col" class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            while ($item = $resultItems->fetch_assoc()) {
                                $subtotal = $item['qty'] * $item['sell_price'];
                                $total += $subtotal;
                            ?>
                                <tr class="border-bottom">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="./images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-0"><?= htmlspecialchars($item['name']) ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>x <?= $item['qty'] ?></td>
                                    <td><?= number_format($item['sell_price']) ?> ₫</td>
                                    <td class="text-end"><?= number_format($subtotal) ?> ₫</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot class="fw-bold">
                            <tr>
                                <td colspan="3" class="text-end py-3">Tạm tính:</td>
                                <td class="text-end py-3"><?= number_format($order['subtotal']) ?> ₫</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end py-2">Phí vận chuyển:</td>
                                <td class="text-end py-2"><?= number_format($order['shipping_fee']) ?> ₫</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end py-2">Giảm giá:</td>
                                <td class="text-end py-2 text-danger">-<?= number_format($order['discount']) ?> ₫</td>
                            </tr>
                            <tr class="total-row bg-light">
                                <td colspan="3" class="text-end py-3">Tổng cộng:</td>
                                <td class="text-end py-3 text-danger"><?= number_format($order['total']) ?> ₫</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="details-card">
                <h5><i class="bi bi-receipt"></i>Thông tin đơn hàng</h5>
                <div class="row detail-group">
                    <div class="col-12 mb-3">
                        <p class="mb-1"><strong>Mã đơn hàng:</strong> #<?= htmlspecialchars($order['id_order']) ?></p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="mb-1"><strong>Ngày đặt:</strong> <?= date("d/m/Y H:i", strtotime($order['created_at'])) ?></p>
                    </div>
                </div>
            </div>
            <div class="details-card">
                <h5><i class="bi bi-geo-alt"></i>Thông tin giao hàng</h5>
                <div class="row detail-group">
                    <div class="col-12 mb-3">
                        <p class="mb-1"><strong>Người nhận:</strong> <?= htmlspecialchars($order['address_name']) ?></p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="mb-1"><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['address_phone']) ?></p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="mb-1"><strong>Địa chỉ:</strong>
                            <?= htmlspecialchars($order['street']) ?>,
                            <?= htmlspecialchars($order['ward']) ?>,
                            <?= htmlspecialchars($order['district']) ?>,
                            <?= htmlspecialchars($order['province']) ?>
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="mb-1"><strong>Vị trí:</strong> <?= htmlspecialchars($order['address_label']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="actions">
        <a href="javascript:window.print()" class="btn btn-custom btn-print">
            <i class="bi bi-printer"></i> In đơn hàng
        </a>
        <a href="./index.php?page=order" class="btn btn-custom btn-back">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>
</div>