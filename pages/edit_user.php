<?php
$user = new User($connect, $config_id_user);
?>

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
        border: none;
        text-align: center;
        color: white;
        padding: 1.2rem;
        font-weight: 600;
        font-size: 1.3rem;
        letter-spacing: 0.3px;
    }

    .card-body label {
        font-weight: 500;
        color: #333;
        margin-bottom: 4px;
    }

    .form-control {
        border-radius: 8px;
        box-shadow: none !important;
        border: 1px solid #ccc;
        transition: 0.2s;
        width: 100%;
        padding: 0.5rem;
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

    .avatar-preview {
        display: block;
        margin: 0 auto 1rem auto;
        border-radius: 50%;
        border: 4px solid #007bff;
        width: 120px;
        height: 120px;
        object-fit: cover;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-pencil-square me-2"></i> Chỉnh sửa thông tin tài khoản
                </div>
                <div class="card-body">
                    <form method="POST" action="./index.php?page=handle_user" enctype="multipart/form-data">
                        <div class="text-center mb-4">
                            <img src="<?= $user->getUrlAvatar() ?>" alt="Avatar" class="avatar-preview">
                        </div>
                        <div class="mb-3">
                            <label for="Avatar">Tải ảnh đại diện</label>
                            <input type="file" name="avatar" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" id="fullname" name="full_name" class="form-control" value="<?= $user->getFullName() ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $user->getEmail() ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form-control" value="<?= $user->getPhone() ?>" required>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary me-2" name="update_user">
                                <i class="bi bi-save me-1"></i> Lưu thay đổi
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