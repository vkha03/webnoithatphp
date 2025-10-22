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
        <h3 class="text-center mb-4 text-uppercase">Thêm mới danh mục</h3>
        <form method="post" action="./index.php?page=handle_cate">
            <div class="mb-3">
                <label class="form-label">Tên danh mục</label>
                <input type="text" name="category_name" class="form-control" placeholder="Nhập tên danh mục..." required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="./index.php?page=product" class="btn btn-secondary">
                    ← Quay lại
                </a>
                <button type="submit" name="add_cate" class="btn btn-primary px-4">
                    Thêm mới
                </button>
            </div>
        </form>
    </div>
</div>