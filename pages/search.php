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
</style>

<!-- card -->
<div class="py-5 bg-light">
    <div class="container">
        <!-- row-1 -->
        <div class="row">
            <?php
            if (!empty($keyword) && $result && $result->num_rows > 0) {
            ?>
                <h3 class="mb-5 text-center">Kết quả tìm kiếm cho "<span class="text-primary"><?php echo $keyword; ?></span>"</h3>
                <?php
                while ($row = $result->fetch_assoc()) {
                    $count++;
                ?>
                    <!-- card-1 -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card product-card h-100">
                            <a href="./index.php?page=product_details&id_product=<?= $row['id_product'] ?>">
                                <img src="<?= $row['image'] ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="<?= $row['name'] ?>">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    <a href="./index.php?page=product_details&id_product=<?= $row['id_product'] ?>" class="text-dark text-decoration-none"><?= $row['name'] ?></a>
                                </h5>
                                <div class="card-text text-muted small mb-2"><?= $row['short_description'] ?></div>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <p class="text-danger fw-bold mb-0"><?= number_format($row['sell_price']) ?> ₫</p>
                                            <p class="text-muted text-decoration-line-through" style="font-size: 0.9rem;"><?= number_format($row['base_price']) ?>₫</p>
                                        </div>
                                        <a href="./index.php?page=product_details&id_product=<?= $row['id_product'] ?>" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                    </div>

                                    <?php if (config_checkRole('admin')) { ?>
                                        <div class="btn-group w-100" role="group">
                                            <a href="./index.php?page=edit_product&id_product=<?= $row['id_product'] ?>" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-pencil-square"></i> Sửa
                                            </a>
                                            <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="./index.php?page=handle_product&delete_product=<?= $row['id_product'] ?>" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Xóa
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
                <p class="text-center mt-5">Tìm thấy <?= $count ?> sản phẩm</p>
            <?php
            } else {
                echo "<p class='p-3 text-center'>Không tìm thấy sản phẩm phù hợp.</p>";
            }
            ?>
        </div>
    </div>
</div>