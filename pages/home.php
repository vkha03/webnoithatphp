<?php
require './handle/handle_product.php';
?>

<style>
    .banner {
        background: url('./images/DecoX.svg') no-repeat center center;
        background-size: cover;
        height: 80vh;
        position: relative;
    }

    .banner1 {
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-card {
        transition: transform 0.3s;
        margin-bottom: 20px;
    }

    .product-card:hover {
        transform: translateY(-10px);
    }
</style>
<!-- Header strart -->
<section class="banner">
    <div class="banner1">
        <div class="container text-center text-white">
            <h1 class="display-3 fw-bold">Nội thất cao cấp</h1>
            <p class="lead">Thiết kế không gian hoàn hảo cho bạn</p>
            <a href="./index.php?page=product" class="btn btn-primary btn-lg mt-3">Xem sản phẩm</a>
        </div>
    </div>
</section>
<!-- Header end -->

<!-- Aboutus -->
<section class="py-4 ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 ">
                <h2 class="fw-bold">Về chúng tôi</h2>
                <p>
                    DecoX là nơi hội tụ của đam mê sáng tạo và sự tinh tế trong từng chi tiết thiết kế nội thất. Với
                    sứ mệnh "Biến không gian thành tổ ấm", chúng tôi mang đến những giải pháp thiết kế hiện đại, tối
                    ưu công năng và phản ánh cá tính riêng của từng khách hàng.
                </p>
                <p>Chúng tôi tin rằng một không gian đẹp không chỉ là nơi để sống mà còn là nơi truyền cảm hứng mỗi
                    ngày. Từ căn hộ nhỏ đến biệt thự rộng lớn, từ văn phòng làm việc đến quán cà phê độc đáo – đội
                    ngũ của chúng tôi luôn tận tâm trong từng bản vẽ, từng vật liệu và từng đường nét thi công.</p>
            </div>
            <div class="col-md-6">
                <img src="./images/aboutus.jpg " alt="Về chúng tôi" class="img-fluid rounded  w-100">
            </div>
        </div>
    </div>
</section>

<!-- card -->
<div class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold p-5">CÁC SẢN PHẨM MỚI NHẤT</h2>
        <!-- row-1 -->
        <div class="row">
            <!-- card-1 -->
            <?php
            while ($data = $result->fetch_assoc()) {
            ?>
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="<?= $data['image'] ?>"
                            class="card-img-top" style="height:300px; object-fit:cover;" alt="halden801">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['name']; // Tên sản phẩm 
                                                    ?></h5>
                            <div class="card-text text-muted"><?= $data['short_description'] ?></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-danger fw-bold"><?php echo number_format($data['sell_price']); // Giá bán sản phẩm 
                                                                ?> ₫</p>
                                <a href="./index.php?page=product_details&id_product=<?php echo $data['id_product']; // Id sản phẩm
                                                                                        ?>" class="btn btn-sm btn-outline-primary">Chi
                                    tiết</a>
                            </div>
                            <p class="text-muted text-decoration-line-through mb-2" style="font-size: 0.9rem;">
                                <?php echo number_format($data['base_price']); // Giá gốc sản phẩm 
                                ?>₫</p>
                            </p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>