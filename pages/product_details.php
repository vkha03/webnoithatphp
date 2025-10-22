    <?php
    require './handle/handle_product_details.php';
    ?>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: whitesmoke;
        }

        .product-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .product-price {
            color: #d32f2f;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-buy {
            background-color: #d32f2f;
            color: white;
            font-weight: bold;
        }

        .divider {
            border-top: 1px solid #eee;
            margin: 1.5rem 0;
        }

        .original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 1.2rem;
        }

        .sale-price {
            color: #d32f2f;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .price-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="container p-3">
                    <!-- carousel-start -->
                    <img src="<?php echo $rowProduct['image']; ?>" class="d-block w-100" alt="anh1">
                </div>
            </div>
            <!-- carousel-end -->
            <div class="col-lg-6 ">
                <div class="product-container p-4">
                    <h1><?php echo $rowProduct['name']; ?></h1>

                    <div class="price-container">
                        <span class="sale-price"><?php echo number_format($rowProduct['sell_price']); ?> ₫</span>
                    </div>

                    <div class="product-meta mt-3">
                        <p><strong>Vật liệu: </strong><?= $rowProduct['material'] ?></p>
                        <p><strong>Kích thước: </strong><?= $rowProduct['size'] ?></p>
                        <p><strong>Màu sắc: </strong><?= $rowProduct['color'] ?></p>
                        <p><strong>Số lượng còn lại: </strong> <?= $rowProduct['quantity'] ?></p>
                    </div>

                    <form class="d-flex align-items-center mt-4" method="post">
                        <div class="input-group me-3" style="width: 120px;">
                            <input type="number" class="form-control text-center" value="1" min="1" max="10" name="quantity">
                        </div>
                        <input type="submit" class="btn btn-outline-secondary" value="THÊM VÀO GIỎ" name="cart">
                    </form>
                    <div class="divider"></div>

                    <div>
                        <ul class="nav nav-tabs" id="productTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description"
                                    type="button">Mô tả</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviews"
                                    type="button">Đánh giá (<?= $totalReviews ?>)</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#warranty"
                                    type="button">Bảo hành</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shipping"
                                    type="button">Vận chuyển</button>
                            </li>
                        </ul>

                        <div class="tab-content p-3">
                            <div class="tab-pane fade show active" id="description">
                                <p><?= $rowProduct['description'] ?></p>
                            </div>
                            <div class="tab-pane fade" id="reviews">
                                <?php
                                while ($dataReview = $result->fetch_assoc()) {
                                ?>
                                    <div class="review-item border-bottom py-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <strong><?= $dataReview['name'] ?></strong>
                                            <span><?= $dataReview['rating'] ?>/5★</span>
                                        </div>
                                        <p class="mb-1"><?= $dataReview['content'] ?></p>
                                        <small class="text-muted"><?= $dataReview['created_at'] ?></small>
                                    </div>
                                <?php
                                }
                                ?>
                                <!-- Form thêm đánh giá -->
                                <?php
                                if (config_checkLogin() == true) {
                                ?>
                                    <div class="mt-4">
                                        <h5>Viết đánh giá của bạn</h5>
                                        <form method="post">
                                            <div class="mb-2">
                                                <label>Đánh giá</label>
                                                <select class="form-select" name="rating" required>
                                                    <option value="5">5 - Xuất sắc</option>
                                                    <option value="4">4 - Tốt</option>
                                                    <option value="3">3 - Trung bình</option>
                                                    <option value="2">2 - Kém</option>
                                                    <option value="1">1 - Rất tệ</option>
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label>Nội dung đánh giá</label>
                                                <textarea name="content" class="form-control" rows="3" placeholder="Nhập đánh giá" required></textarea>
                                            </div>
                                            <input type="submit" value="Gửi đánh giá" class="btn btn-primary" name="review">
                                        </form>
                                    </div>
                                <?php
                                } else echo "<p class='mt-5'>Vui lòng đăng nhập để đánh giá sản phẩm!<p>";
                                ?>
                            </div>

                            <div class="tab-pane fade" id="warranty">
                                <p class="fs-6 fw-bold">1.Thời gian bảo hành</p>
                                Bảo hành 24 tháng đối với khung gỗ và kết cấu chính <br>
                                Bảo hành 12 tháng đối với bề mặt, sơn, vecni <br>
                                Bảo hành 6 tháng đối với phụ kiện (ngăn kéo, bản lề, tay nắm) <br><br>

                                <p class="fs-6 fw-bold">2.Điều kiện bảo hành</p>
                                Chỉ áp dụng cho các lỗi kỹ thuật do nhà sản xuất<br>
                                Sản phẩm phải còn nguyên vẹn, không bị biến dạng do tác động ngoại lực<br>
                                Còn hóa đơn mua hàng hoặc phiếu bảo hành hợp lệ<br>
                                Không bao gồm hư hỏng do thiên tai, hỏa hoạn, sử dụng sai cách <br><br>

                                <p class="fs-6 fw-bold">3.Dịch vụ bảo hành</p>
                                Bảo hành tại nhà đối với sản phẩm có kích thước lớn<br>
                                Miễn phí nhân công sửa chữa, thay thế linh kiện<br>
                                Hỗ trợ tư vấn bảo quản nội thất miễn phí trọn đời sản phẩm
                            </div>
                            <div class="tab-pane fade" id="shipping">
                                <p>GIAO HÀNG TẬN NƠI <br>
                                    DecoX cung cấp dịch vụ giao hàng tận nơi, lắp ráp và sắp xếp vị trí theo đúng ý
                                    muốn của quý khách:<br><br>
                                    - MIỄN PHÍ giao hàng trong các Quận nội thành Cần Thơ, áp dụng cho
                                    các đơn hàng trị giá trên 10 triệu.<br><br>
                                    - Đối với khu vực các tỉnh lân cận: Tính phí hợp lý theo dựa trên quãng đường vận
                                    chuyển</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>