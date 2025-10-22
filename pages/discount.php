<style>
    .discount-banner {
        background-color: indianred;
        color: white;
    }

    .card {
        transition: transform 0.3s;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .promo-card:hover {
        transform: translateY(-5px);
    }

    .discount-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .time {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        font-size: 1.2rem;
    }
</style>

<body>
    <!-- banner -->
    <header class="discount-banner py-4 text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">KHUYẾN MÃI ĐẶC BIỆT</h1>
            <p class="back">Giảm giá lên đến 50% - Áp dụng đến hết tháng</p>

            <!-- Time -->
            <div class="d-flex justify-content-center gap-3 my-3">
                <div class="time">
                    <span>03</span> Ngày
                </div>
                <div class="time">
                    <span>12</span> Giờ
                </div>
                <div class="time">
                    <span>45</span> Phút
                </div>
            </div>
        </div>
    </header>

    <main class="py-5">
        <div class="container">

            <section class="mb-5">
                <h2 class="text-center mb-4">SẢN PHẨM KHUYẾN MÃI</h2>
                <div class="row g-4">
                    <!-- card 1 -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="discount-badge">-27%</div>
                            <img src="./images/hinh/hobro.webp" class="card-img-top" alt="Sản phẩm 1">
                            <div class="card-body">
                                <h5 class="card-title">Combo Sofa Gỗ Cao Su Chữ L HOBRO</h5>
                                <!-- <p class="card-text">Mô tả ngắn về sản phẩm khuyến mãi.</p> -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <del class="text-muted">25,980,000đ</del>
                                    <span class="fw-bold text-danger">18,990,000đ</span>
                                </div>
                                <a href="#" class="btn btn-danger mt-3 w-100">Mua ngay</a>
                            </div>
                        </div>
                    </div>

                    <!-- card 2 -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="discount-badge">-28%</div>
                            <img src="./images/hinh/vlinecombo.webp" class="card-img-top" alt="Sản phẩm 2">
                            <div class="card-body">
                                <h5 class="card-title">Combo Phòng Ngủ VLINE</h5>
                                <!-- <p class="card-text">Mô tả ngắn về combo khuyến mãi.</p> -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <del class="text-muted">28,460,000đ</del>
                                    <span class="fw-bold text-danger">20,390,000đ</span>
                                </div>
                                <a href="#" class="btn btn-danger mt-3 w-100">Mua ngay</a>
                            </div>
                        </div>
                    </div>

                    <!-- card 3 -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="discount-badge">-40%</div>
                            <img src="./images/hinh/fullhouse.webp" class="card-img-top" alt="Sản phẩm 3">
                            <div class="card-body">
                                <h5 class="card-title">Sản phẩm C</h5>
                                <!-- <p class="card-text">Mô tả ngắn về sản phẩm khuyến mãi.</p> -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <del class="text-muted">52,270,000đ</del>
                                    <span class="fw-bold text-danger">31,490,000đ</span>
                                </div>
                                <a href="#" class="btn btn-danger mt-3 w-100">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section class="mb-5">
                <h2 class="text-center mb-4">ƯU ĐÃI KHÁC</h2>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="p-4 bg-light rounded-3 h-100">
                            <h3><i class="bi bi-truck"></i> Miễn phí vận chuyển</h3>
                            <p class="mb-0">Áp dụng cho đơn hàng từ 1.500.000đ trở lên trong khu vực nội thành.</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="p-4 bg-light rounded-3 h-100">
                            <h3><i class="bi bi-gift"></i> Quà tặng hấp dẫn</h3>
                            <p class="mb-0">Tặng kèm voucher trị giá 200.000 khi mua đơn hàng từ 1.500.000đ.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>