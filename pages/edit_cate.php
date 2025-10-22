<?php
require './handle/handle_cate.php'
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
<div class="container">
    <div class="edit-form">
        <h3 class="text-center mb-4 text-uppercase">Chỉnh sửa danh mục</h3>

        <!-- Form chọn danh mục -->
        <form method="post" class="mb-4" action="./index.php?page=handle_cate">
            <div class="mb-3">
                <label class="form-label">Chọn danh mục cần sửa</label>
                <select name="id_category" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?= $row['id_cate'] ?>">
                            <?= $row['name'] ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tên danh mục mới</label>
                <input type="text" name="new_name" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="./index.php?page=product" class="btn btn-secondary">← Quay lại</a>
                <input type="submit" name="update_cate" class=" btn btn-primary px-4" value="Lưu thay đổi">
            </div>
        </form>
    </div>
</div>