<?php
require './handle/handle_product.php';
?>
<style>
    body {
        background-color: #f3f4f6;
    }

    .edit-form {
        max-width: 650px;
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
<div class="container">
    <div class="edit-form">
        <h3 class="text-center mb-4 text-uppercase">Thêm mới sản phẩm</h3>
        <form method="post" enctype="multipart/form-data">
            <!-- Chọn danh mục -->
            <div class="mb-3">
                <label class="form-label">Danh mục sản phẩm</label>
                <select name="id_cate" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php while ($cate = $category->fetch_assoc()) { ?>
                        <option value="<?= $cate['id_cate'] ?>"><?= $cate['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá gốc (₫)</label>
                <input type="number" name="base_price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Giá bán (₫)</label>
                <input type="number" name="sell_price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Vật liệu</label>
                <input type="text" name="material" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Kích thước</label>
                <input type="text" name="size" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Màu sắc</label>
                <input type="text" name="color" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Số lượng</label>
                <input type="number" name="quantity" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <label>Chọn ảnh để upload:</label><br>
            <input type="file" name="image" accept="image/*"><br><br>

            <div class="d-flex justify-content-between mt-4">
                <a href="./index.php?page=product" class="btn btn-secondary">
                    ← Quay lại
                </a>
                <input type="submit" name="add_product" class="btn btn-primary px-4" value="Thêm sản phẩm">
            </div>
        </form>
    </div>
</div>