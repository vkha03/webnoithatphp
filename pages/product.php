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
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding: 1rem 0;
        }

        .category-pills .nav-link {
            color: #333;
            border-radius: 50rem;
            padding: 0.5rem 1.25rem;
            margin: 0 0.25rem;
            transition: all 0.3s;
        }

        .category-pills .nav-link.active,
        .category-pills .nav-link:hover {
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
    <div class="category-bar">
        <div class="container d-flex justify-content-between align-items-center flex-wrap">
            <ul class="nav nav-pills category-pills">
                <li class="nav-item">
                    <a href="./index.php?page=product&id_cate=0" class="nav-link <?= ($id_cate == 0) ? 'active' : '' ?>">Tất cả</a>
                </li>
                <?php
                // Hiển thị danh mục sản phẩm
                while ($rowCate = $resultCate->fetch_assoc()) {
                    $isActive = ($id_cate == $rowCate['id_cate']) ? 'active' : '';
                ?>
                    <li class="nav-item">
                        <a href="./index.php?page=product&id_cate=<?= $rowCate['id_cate'] ?>" class="nav-link <?= $isActive ?>">
                            <?= htmlspecialchars($rowCate['name']) ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>

            <!-- Menu quản lý cho Admin -->
            <?php if (config_checkRole('admin') == true) { ?>
                <div class="dropdown position-absolute end-0 me-3 mt-3">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear-fill me-1"></i> Quản lý
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="./index.php?page=add_product"><i class="bi bi-plus-circle me-2"></i>Thêm sản phẩm</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <h6 class="dropdown-header">Quản lý danh mục</h6>
                        </li>
                        <li><a class="dropdown-item" href="./index.php?page=add_cate"><i class="bi bi-bookmark-plus me-2"></i>Thêm danh mục</a></li>
                        <li><a class="dropdown-item" href="./index.php?page=edit_cate"><i class="bi bi-pencil-square me-2"></i>Sửa danh mục</a></li>
                        <li><a class="dropdown-item text-danger" href="./index.php?page=delete_cate"><i class="bi bi-trash me-2"></i>Xóa danh mục</a></li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- card -->
    <div class="py-5 bg-light">
        <div class="container">
            <!-- row-1 -->
            <div class="row g-4">

                <?php
                // Hiển thị sản phẩm
                if ($resultProduct->num_rows > 0) {
                    while ($rowProduct = $resultProduct->fetch_assoc()) {
                ?>
                        <!-- Product Card -->
                        <div class="col-md-4 col-lg-3">
                            <div class="card product-card h-100">
                                <a href="./index.php?page=product_details&id_product=<?= $rowProduct['id_product'] ?>">
                                    <img src="<?= htmlspecialchars($rowProduct['image']) ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="<?= htmlspecialchars($rowProduct['name']) ?>">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">
                                        <a href="./index.php?page=product_details&id_product=<?= $rowProduct['id_product'] ?>" class="text-dark text-decoration-none"><?= htmlspecialchars($rowProduct['name']) ?></a>
                                    </h5>
                                    <div class="card-text text-muted small mb-2"><?= htmlspecialchars($rowProduct['short_description']) ?></div>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <p class="text-danger fw-bold mb-0"><?= number_format($rowProduct['sell_price']) ?> ₫</p>
                                                <p class="text-muted text-decoration-line-through" style="font-size: 0.9rem;"><?= number_format($rowProduct['base_price']) ?>₫</p>
                                            </div>
                                            <a href="./index.php?page=product_details&id_product=<?= $rowProduct['id_product'] ?>" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                        </div>

                                        <?php if (config_checkRole('admin')) { ?>
                                            <div class="btn-group w-100" role="group">
                                                <a href="./index.php?page=edit_product&id_product=<?= $rowProduct['id_product'] ?>" class="btn btn-sm btn-outline-secondary">
                                                    <i class="bi bi-pencil-square"></i> Sửa
                                                </a>
                                                <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="./index.php?page=handle_product&delete_product=<?= $rowProduct['id_product'] ?>" class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i> Xóa
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } // end while
                } else { ?>
                    <div class="col-12">
                        <div class="text-center py-5">
                            <img src="./images/empty-box.svg" alt="Không có sản phẩm" style="width: 150px; opacity: 0.7;">
                            <h5 class="mt-4 text-muted">Không có sản phẩm nào</h5>
                            <p class="text-muted">Hiện chưa có sản phẩm trong danh mục này.</p>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPage > 1) : ?>
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="./index.php?page=product&id_cate=<?= $id_cate ?>&num_page=<?= $page - 1 ?>">Trước</a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                                <a class="page-link" href="./index.php?page=product&id_cate=<?= $id_cate ?>&num_page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= ($page >= $totalPage) ? 'disabled' : '' ?>">
                            <a class="page-link" href="./index.php?page=product&id_cate=<?= $id_cate ?>&num_page=<?= $page + 1 ?>">Sau</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>