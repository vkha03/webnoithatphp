<?php
require './handle/handle_payment.php';
?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .payment-card {
        border-radius: 15px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
    }

    .divider {
        height: 1px;
        background-color: #e0e0e0;
        margin: 20px 0;
    }

    .btn-payment {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 0;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-payment:hover {
        background-color: #5a6268;
        color: white;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.25);
        border-color: #6c757d;
    }

    .nav-pills .nav-link.active {
        background-color: #6c757d;
    }

    .nav-pills .nav-link {
        color: #6c757d;
    }
</style>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="bg-white p-5 payment-card">
                <h2 class="text-center mb-4">Thanh Toán Đơn Hàng </h2>


                <div class="mb-4">
                    <h5 class="mb-3">Sản phẩm</h5>
                    <?php
                    while ($dataCart = $resultCart->fetch_assoc()) {
                        $totalPrice += ($dataCart['sell_price'] * $dataCart['qty']);
                    ?>
                        <div class="d-flex align-items-center mb-3">
                            <img src="/images/halden801.webp" alt="Ghế sofa" class="product-img me-3">
                            <div class="flex-grow-1">
                                <h6 class="mb-1"><?= $dataCart['name'] ?></h6>
                            </div>
                            <div class="text-end">
                                <h6 class="mb-1"><?= number_format($dataCart['sell_price']) ?> ₫</h6>
                                <small class="text-muted">Số lượng: <?= $dataCart['qty'] ?></small>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="divider"></div>

                <!-- Thông tin thanh toán -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <h5 class="mb-3">Thông tin giao hàng</h5>
                        <form>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="fullName" value="<?= $address->name ?? '' ?>" readonly required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" value="<?= $address->phone ?? '' ?>" readonly required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" id="address" rows="2" readonly required><?= ($address->province . ', ' . $address->district . ', ' . $address->ward . ', ' . $address->street) ?? ''  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Vị trí</label>
                                <input class="form-control" id="address" rows="2" value="<?= $address->label ?? '' ?>" readonly required>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" rows="2"></textarea>
                            </div>
                            <input type="submit" class="btn btn-payment w-100 mt-3" value="Sửa địa chỉ">
                            <i class="fas fa-shopping-bag me-2"></i>
                        </form>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Phương thức thanh toán</h5>
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-cod-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-cod" type="button" role="tab">COD</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-bank-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-bank" type="button" role="tab">Chuyển khoản</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-cod" role="tabpanel">
                                <p>Thanh toán khi nhận hàng (COD)</p>
                                <small class="text-muted">Bạn sẽ thanh toán bằng tiền mặt khi nhận được
                                    hàng.</small>
                            </div>
                            <div class="tab-pane fade" id="pills-bank" role="tabpanel">
                                <p>Thông tin chuyển khoản</p>
                                <div class="bg-light p-3 rounded mb-2">
                                    <p class="mb-1"><strong>Ngân hàng:</strong> Vietcombank</p>
                                    <p class="mb-1"><strong>Số tài khoản:</strong> 1034291032</p>
                                    <p class="mb-1"><strong>Chủ tài khoản:</strong> Công ty Nội Thất DecoX</p>
                                </div>
                                <small class="text-muted">Vui lòng chuyển khoản trước khi đặt hàng.</small>
                            </div>
                        </div>

                        <div class="divider mt-4"></div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span><?= number_format($totalPrice) ?> ₫</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span>Free</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Giảm giá:</span>
                                <span class="text-danger">-0₫</span>
                            </div>
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Tổng cộng:</span>
                                <span><?= number_format($totalPrice) ?> ₫</span>
                            </div>
                        </div>
                        <form method="post">
                            <input type="submit" name="payment" class="btn btn-payment w-100 mt-3" value="Đặt hàng">
                            <i class="fas fa-shopping-bag me-2"></i>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>