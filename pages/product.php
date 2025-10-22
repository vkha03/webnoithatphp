    <?php
    require './handle/handle_product.php';
    ?>
    <style>
        .product-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .product-card:hover {
            transform: translateY(-10px);
        }

        .contact-header {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                url('https://images.unsplash.com/photo-1600121848594-d8644e57abab?ixlib=rb-4.0.3&auto=format&fit=crop&w=1587&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 0;
        }

        .category-bar {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
        }

        .category-bar .btn {
            border-radius: 30px;
            margin: 10px;
            transition: all 0.3s;
        }

        .category-bar .btn:hover,
        .category-bar .btn.active {
            background-color: #0d6efd;
            color: white;
        }

        .pagination .page-link:hover,
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            color: #fff;
            border-color: #0d6efd;
        }
    </style>

    <header class="contact-header text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Sản phẩm</h1>
        </div>
    </header>

    <!-- Danh mục sản phẩm -->
    <div class="category-bar text-center py-3">
        <div class="container">

            <a href="./index.php?page=product&id_cate=0"
                class="btn btn-outline-primary">Tất cả sản phẩm</a>

            <?php
            // Hiển thị danh mục sản phẩm
            while ($rowCate = $resultCate->fetch_assoc()) {
            ?>
                <a href="./index.php?page=product&id_cate=<?php echo $rowCate['id_cate']; ?>"
                    class="btn btn-outline-primary">
                    <?php echo $rowCate['name']; // Tên danh mục
                    ?>
                </a>
            <?php
            }
            ?>
            <!-- Thêm, sửa, xóa danh mục và thêm mới sản phẩm (Chỉ dành cho admin) -->
            <?php
            if (config_checkRole('admin') == true) {
                echo "<a href='./index.php?page=add_cate'
                  class='btn btn-outline-secondary'>Thêm mới danh mục</a>";
                echo "<a href='./index.php?page=edit_cate'
                  class='btn btn-outline-secondary'>Sửa tên danh mục</a>";
                echo "<a href='./index.php?page=delete_cate'
                  class='btn btn-outline-secondary'>Xóa danh mục</a>";
                echo "<a href='./index.php?page=add_product'
                  class='btn btn-outline-secondary'>Thêm mới sản phẩm</a>";
            }
            ?>
        </div>
    </div>

    <!-- card -->
    <div class="py-5 bg-light">
        <div class="container">
            <!-- row-1 -->
            <div class="row">

                <?php
                // Hiển thị sản phẩm
                while ($rowProduct = $resultProduct->fetch_assoc()) {
                ?>

                    <!-- card-1 -->
                    <div class="col-md-3">
                        <div class="card product-card">

                            <img src="
                            <?php
                            // Link hình ảnh sản phẩm
                            echo $rowProduct['image'];
                            ?>"
                                class="card-img-top img-fluid" style="height:300px; object-fit:cover;" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $rowProduct['name']; // Tên sản phẩm 
                                                        ?></h5>
                                <div class="card-text text-muted"><?= $rowProduct['short_description'] ?></div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-danger fw-bold"><?php echo number_format($rowProduct['sell_price']); // Giá sản phẩm 
                                                                    ?> ₫</p>
                                    <a href="./index.php?page=product_details&id_product=<?php echo $rowProduct['id_product']; // Id sản phẩm
                                                                                            ?>" class="btn btn-sm btn-outline-primary">Chi tiết</a>

                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted text-decoration-line-through mb-2" style="font-size: 0.9rem;">
                                        <?php echo number_format($rowProduct['base_price']); // Giá gốc sản phẩm 
                                        ?>₫</p>
                                    <?php
                                    if (config_checkRole('admin')) {
                                    ?>
                                        <a href="./index.php?page=edit_product&id_product=<?php echo $rowProduct['id_product']; // Id sản phẩm
                                                                                            ?>" class="btn btn-sm btn-outline-primary">Chỉnh sửa</a>
                                        <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="./index.php?page=handle_product&delete_product=<?php echo $rowProduct['id_product']; // Id sản phẩm
                                                                                                                                                                        ?>" class="btn btn-sm btn-outline-primary">Xóa</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

                <!-- Page -->

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center text-muted m-4">
                        <a class="page-link" href="./index.php?page=product&id_cate=<?php echo $id_cate; ?>&num_page=<?php if ($page > 1) { // Quay lại trang trước
                                                                                                                            echo $page - 1;
                                                                                                                        } else echo $page; ?>">Trước
                        </a>

                        <?php
                        // Phân trang sản phẩm
                        while ($numPage <= $totalPage) {
                            $active = ($page == $numPage) ? 'active' : '';
                        ?>
                            <li class="page-item <?php echo $active; ?>">
                                <a class="page-link" href="./index.php?page=product&id_cate=<?php echo $id_cate; ?>&num_page=<?php echo $numPage; ?>">
                                    <?php echo $numPage; // Số trang
                                    ?>
                                </a>
                            </li>
                        <?php
                            $numPage++;
                        }
                        ?>

                        <li class="page-item">
                            <a class="page-link" href="./index.php?page=product&id_cate=<?php echo $id_cate; ?>&num_page=<?php if ($page < $totalPage) { // Đến trang sau
                                                                                                                                echo $page + 1;
                                                                                                                            } else echo $page; ?>">
                                Sau
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>