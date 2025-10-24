<?php
require './handle/handle_product.php';
?>
<style>
    body {
        background-color: #f3f4f6;
    }

    .edit-form {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 30px;
    }

    .edit-form h3 {
        font-weight: 700;
        color: #007bff;
    }
</style>

<body>
    <div class="container">
        <div class="edit-form">
            <h3 class="text-center mb-4 text-uppercase">Chỉnh sửa sản phẩm</h3>
            <form method="post" enctype="multipart/form-data">
                <div>
                    <img src="<?= $rowProduct['image'] ?>" class="w-100 h-100" alt="">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="<?= $rowProduct['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá gốc (₫)</label>
                    <input type="number" name="base_price" class="form-control" value="<?= $rowProduct['base_price'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Giá bán (₫)</label>
                    <input type="number" name="sell_price" class="form-control" value="<?= $rowProduct['sell_price'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Vật liệu</label>
                    <input type="text" name="material" class="form-control" value="<?= $rowProduct['material'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kích thước</label>
                    <input type="text" name="size" class="form-control" value="<?= $rowProduct['size'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Màu sắc</label>
                    <input type="text" name="color" class="form-control" value="<?= $rowProduct['color'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số lượng</label>
                    <input type="number" name="quantity" class="form-control" value="<?= $rowProduct['quantity'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm</label>
                    <textarea name="description" class="form-control" rows="3"><?= $rowProduct['description'] ?></textarea>
                </div>
                <label>Chọn ảnh để upload:</label><br>
                <input type="file" name="image" accept="image/*"><br><br>
                <div class="d-flex justify-content-between mt-4">
                    <a href="./index.php?page=handle_product&id_product=<?= $id_product ?>" class="btn btn-secondary">
                        ← Quay lại
                    </a>
                    <button type="submit" name="update_product" class="btn btn-primary px-4">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</body>