<?php
if (!empty($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
    $result = $connect->query($query);
    $count = 0; // Số lượng sản phẩm
}
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
                <h3 class="p-3 text-center">Kết quả tìm kiếm cho "<span class="text-primary"><?php echo $keyword; ?></span>"</h3>
                <?php
                while ($row = $result->fetch_assoc()) {
                    // Lấy ảnh sản phẩm
                    $queryImage = "SELECT * FROM product_images WHERE id_product = {$row['id_product']}";
                    $resultImage = $connect->query($queryImage);
                    $dataImage = $resultImage ? $resultImage->fetch_assoc() : null;
                    $imgUrl = $dataImage ? $dataImage['url'] : 'default.jpg';
                    $count++;
                ?>
                    <!-- card-1 -->
                    <div class="col-md-3">
                        <div class="card product-card">
                            <img src="<?= $row['image'] ?>" class="card-img-top img-fluid" style="height:300px; object-fit:cover;" alt="">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-danger fw-bold"><?php echo number_format($row['sell_price']); ?> VND</p>
                                    <a href="./index.php?page=product_details&id_product=<?php echo $row['id_product']; ?>" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="text-muted text-decoration-line-through mb-2" style="font-size: 0.9rem;">
                                        <?php echo number_format($row['base_price']); // Giá gốc sản phẩm 
                                        ?>₫</p>
                                    <?php
                                    if (config_checkRole('admin')) {
                                    ?>
                                        <a href="./index.php?page=edit_product&id_product=<?php echo $rowProduct['id_product']; // Id sản phẩm
                                                                                            ?>" class="btn btn-sm btn-outline-primary">Chỉnh sửa</a>
                                        <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="./index.php?page=delete_product&id_product=<?php echo $rowProduct['id_product']; // Id sản phẩm
                                                                                                                                                                    ?>" class="btn btn-sm btn-outline-primary">Xóa</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
                <p class="text-center">Tìm thấy <?= $count ?> sản phẩm</p>
            <?php
            } else {
                echo "<p class='p-3 text-center'>Không tìm thấy sản phẩm phù hợp.</p>";
            }
            ?>
        </div>
    </div>
</div>