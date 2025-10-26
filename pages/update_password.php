<style>
    body {
        background: linear-gradient(135deg, #a8edea, #fed6e3);
        font-family: 'Segoe UI', sans-serif;
    }

    .card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: none;
        transition: 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .card-header {
        background: linear-gradient(135deg, #007bff, #0056d2);
        text-align: center;
        color: white;
        padding: 1.2rem;
        font-weight: 600;
        font-size: 1.3rem;
    }

    .card-body label {
        font-weight: 500;
        color: #333;
        margin-bottom: 4px;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        width: 100%;
        padding: 0.5rem;
        box-shadow: none !important;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056d2);
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
    }

    .btn-primary:hover {
        opacity: 0.9;
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-key-fill me-2"></i> Đổi mật khẩu
                </div>
                <div class="card-body">
                    <form method="POST" action="./index.php?page=handle_user">
                        <div class="mb-3">
                            <label for="current_password">Mật khẩu hiện tại</label>
                            <input type="password" id="current_password" name="current_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password">Mật khẩu mới</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Xác nhận mật khẩu mới</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" name="update_password">
                                <i class=" bi bi-save me-1"></i> Đổi mật khẩu
                            </button>
                            <a href="./index.php?page=user" class="btn btn-secondary">
                                <i class="bi bi-x-circle me-1"></i> Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>