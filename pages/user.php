<?php
require './handle/handle_user.php'
?>

<style>
    .card {
        border-radius: 20px !important;
    }

    .card-header {
        border-top-left-radius: 20px !important;
        border-top-right-radius: 20px !important;
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
        <div class="col-md-10 col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h3 class="mb-0"><i class="bi bi-person-circle me-2"></i>Thông tin tài khoản</h3>
                </div>
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img src="<?= $user->getUrlAvatar() ?>" class="rounded-circle shadow avatar-preview" alt="Avatar" width="130" height="130">
                        <h4 class="mt-3 text-dark"><?= $user->getFullName() ?></h4>
                        <p class="text-muted mb-1"><?= ($user->getRole() == "customer") ? "Khách hàng" : "Quản trị viên" ?></p>
                        <p class="small text-secondary">Thành viên từ <?= $user->getCreated() ?></p>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-secondary">Họ và tên:</div>
                        <div class="col-sm-8"><?= $user->getFullName() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-secondary">Email:</div>
                        <div class="col-sm-8"><?= $user->getEmail() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-secondary">Số điện thoại:</div>
                        <div class="col-sm-8"><?= $user->getPhone() ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-secondary">Địa chỉ:</div>
                        <div class="col-sm-8"><?= $address->getProvince() . ", " . $address->getDistrict() . ", " . $address->getWard() . ", " . $address->getStreet() ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold text-secondary">Vị trí:</div>
                        <div class="col-sm-8"><?= $address->getLabel() ?></div>
                    </div>
                    <?php
                    if (config_checkRole('customer')) {
                    ?>
                        <div class="text-center mt-4">
                            <a href="./index.php?page=edit_user" class="btn btn-outline-primary px-4 me-2">
                                <i class="bi bi-pencil-square me-1"></i>Chỉnh sửa thông tin
                            </a>
                            <a href="./index.php?page=edit_address" class="btn btn-outline-primary px-4 me-2">
                                <i class="bi bi-pencil-square me-1"></i>Chỉnh sửa thông tin giao hàng
                            </a>
                            <a href="./index.php?page=update_password" class="btn btn-outline-primary px-4 me-2">
                                <i class="bi bi-pencil-square me-1"></i>Đổi mật khẩu
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>