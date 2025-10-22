<?php
require './handle/handle_cate.php';
?>
<style>
    body {
        background-color: #f3f4f6;
    }

    .delete-form {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 30px;
    }

    .delete-form h3 {
        font-weight: 700;
        color: #dc3545;
    }
</style>
<div class="container">
    <div class="delete-form">
        <h3 class="text-center mb-4 text-uppercase">Xóa danh mục</h3>

        <form method="post" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">
            <div class="mb-3">
                <label class="form-label">Chọn danh mục cần xóa</label>
                <select name="id_category" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?= $row['id_cate'] ?>"><?= $row['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="./index.php?page=product" class="btn btn-secondary">← Quay lại</a>
                <button type="submit" name="delete_cate" class="btn btn-danger px-4">Xóa danh mục</button>
            </div>
        </form>
    </div>
</div>

<script>
</script>