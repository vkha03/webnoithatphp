<?php
require './handle/handle_address.php';
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
        max-width: 600px;
        margin: 50px auto;
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

    .form-control,
    .form-select {
        border-radius: 8px;
        box-shadow: none !important;
        border: 1px solid #ccc;
        transition: 0.2s;
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056d2);
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        font-weight: 500;
        cursor: pointer;
    }

    .btn-primary:hover {
        opacity: 0.9;
    }

    .btn-secondary {
        border-radius: 8px;
        padding: 0.6rem 1.2rem;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        color: #333;
        border: 1px solid #ccc;
    }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <i class="bi bi-pencil-square me-2"></i> Chỉnh sửa địa chỉ
        </div>
        <div class="card-body">
            <form method="POST" action="index.php?page=handle_address">
                <!-- Họ và tên người nhận -->
                <label for="recipient_name">Họ và tên người nhận</label>
                <input type="text" id="full_name" name="full_name" class="form-control" value="<?= $address->getName() ?>" required>

                <!-- Số điện thoại người nhận -->
                <label for="recipient_phone">Số điện thoại người nhận</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?= $address->getPhone() ?>" required>

                <!-- Địa chỉ -->
                <label for="province">Tỉnh / Thành phố</label>
                <input type="text" id="province" name="province" class="form-control" value="<?= $address->getProvince() ?>" required>

                <label for="district">Quận / Huyện</label>
                <input type="text" id="district" name="district" class="form-control" value="<?= $address->getDistrict() ?>" required>

                <label for="ward">Phường / Xã</label>
                <input type="text" id="ward" name="ward" class="form-control" value="<?= $address->getWard() ?>" required>

                <label for="street">Đường / Số nhà / Khu vực</label>
                <input type="text" id="street" name="street" class="form-control" placeholder="Tên đường, số nhà, khu vực..." value="<?= $address->getStreet() ?>" required>
                <label for="ward">Vị trí</label>
                <input type="text" id="label" name="label" class="form-control" value="<?= $address->getLabel() ?>" required>

                <div style="text-align:center; margin-top:20px;">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    <a href="./index.php?page=user" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>