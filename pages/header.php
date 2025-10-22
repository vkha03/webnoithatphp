<?php
$user = new User($connect, $config_id_user);
require './handle/handle_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Web-Bao Cao</title>
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

        footer {
            background-color: #343a40;
            color: white;
            padding: 40px;
        }

        .offcart {
            width: 350px;
        }
    </style>
</head>

<body>
    <!-- navbar start -->
    <nav class="navbar navbar-expand-lg  bg-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="./index.php?page=home">
                <img src="./images/Logo.png" alt="Bootstrap" width="130px" height="100px">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item ">
                        <a class="nav-link" href="./index.php?page=aboutus">Giới thiệu</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="./index.php?page=discount">Khuyến mãi</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link" href="./index.php?page=product">Sản phẩm</a>

                    <li class="nav-item ">
                        <a class="nav-link" href="./index.php?page=contact">Liên hệ chúng tôi</a>
                    </li>
                </ul>
                <form class="d-flex my-3 mx-1" role="search" style="width: 40%;" action="index.php?page=search" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search for...." aria-label="Search" name="keyword" required>
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>

                <div class="d-flex align-items-center ">
                    <!-- Nút giỏ hàng -->
                    <button class="btn btn-dark btn-sm d-flex align-items-center me-2" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCart">
                        <i class="bi bi-cart"></i>
                        <span class="badge bg-danger ms-1"><?= $totalCart ?? 0 ?></span>
                    </button>
                    <!-- Nút đơn hàng -->
                    <button class="btn btn-dark btn-sm d-flex align-items-center me-2" onclick="window.location.href='./index.php?page=order'"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasOrder">
                        <i class="bi bi-bag-check-fill me-1"></i><span class="badge bg-success ms-1"><?= $totalOrder ?? 0 ?></span>
                    </button>
                    <!-- Nút đăng nhập -->
                    <div class="me-2">
                        <a href="<?php if (config_CheckRole('admin')) echo './index.php?page=dashboard';
                                    else if (config_checkLogin() == true) echo './index.php?page=user';
                                    else echo './index.php?page=login'; ?>" class=" btn btn-dark btn-sm d-flex align-items-center">
                            <i class="bi bi-person-fill"></i>
                        </a>
                    </div>
                    <!-- Nút logout -->
                    <button class=" btn btn-dark btn-sm d-flex align-items-center" name="logout" onclick="window.location.href='./index.php?page=auth&logout'">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- offcanvas-giỏ hàng -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasCartLabel">Giỏ hàng của bạn</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <!-- Danh sách sản phẩm -->
            <div class="list-group">
                <?php
                while ($dataCartIndex = $resultCartIndex->fetch_assoc()) {
                    $totalPriceIndex += $dataCartIndex['sell_price'] * $dataCartIndex['qty'];
                ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <img src="./images/halden801.webp" style="height: 50px;">
                            <h6 class="mb-1"><?= $dataCartIndex['name'] ?></h6>
                            <small class="text-muted"><?= $dataCartIndex['qty'] ?> x <?= number_format($dataCartIndex['sell_price']) ?> ₫</small>
                        </div>
                        <a href="./index.php?page=handle_cart&id_item=<?= $dataCartIndex['id_item'] ?>"
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                            <i class="bi bi-trash"></i>
                        </a>

                    </div>
                <?php } ?>
            </div>

            <!-- Tổng cộng -->
            <div class="mt-3 border-top pt-2">
                <div class="d-flex justify-content-between fw-bold">
                    <span>Tổng cộng:</span>
                    <span><?= number_format($totalPriceIndex) ?> ₫</span>
                </div>
            </div>
            <!-- Nút thanh toán -->
            <div class="d-grid mt-3">
                <a href="./index.php?page=payment">
                    <button class="btn btn-primary">Thanh toán</button>
                </a>
            </div>
        </div>
    </div>
    <!-- offcanvas-end -->
    <?php if (config_checkLogin() == true) { ?>
        <div class="text-end bg-light py-2 pe-4 border-top">
            Xin chào! <?= $user->fullName ?>
        </div>
    <?php } ?>