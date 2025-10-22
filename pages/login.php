<style>
    body {
        background: url('./images/login.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: 'Segoe UI', sans-serif;
    }

    .auth-card {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    /* Bên trái (nền xanh, ảnh, text) */
    .auth-left {
        background-color: #2f66f5;
        color: white;
        text-align: center;
        padding: 40px 20px;
    }

    .auth-left img {
        border-radius: 10px;
        margin-bottom: 15px;
        width: 100%;
        max-height: 5px;
        object-fit: cover;
    }

    /* Form bên phải */
    .bg-white {
        background-color: #ffffff;
        border-left: 1px solid #eee;
    }


    .btn-primary {
        background-color: #2f66f5;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e4bd8;
    }
</style>

<div class="container">
    <div class="row justify-content-center ">
        <div class="col-lg-8">
            <div class="auth-card row g-1 " style="height: 550px;">
                <div
                    class="col-md-5 auth-left d-none d-md-flex flex-column justify-content-center align-items-center">
                    <img src="./images/login.jpg" alt="Logo" class="mb-3 img-fluid" style="max-height: 250px;">
                    <h4>Chào mừng đến với DecoX</h4>
                    <p class="text-center">Đăng nhập để truy cập vào tài khoản của bạn hoặc đăng ký nếu bạn chưa có
                        tài khoản</p>
                </div>


                <div class="col-md-7 bg-white p-4">

                    <ul class="nav nav-tabs border-0 mb-4" id="authTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="login-tab" data-bs-toggle="tab"
                                data-bs-target="#login" type="button" role="tab">Đăng nhập</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="register-tab" data-bs-toggle="tab"
                                data-bs-target="#register" type="button" role="tab">Đăng ký</button>
                        </li>
                    </ul>


                    <div class="tab-content" id="authTabsContent">
                        <!--form dangnhap -->
                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form id="form1" method="post" action="./index.php?page=auth">
                                <div class="mb-3">
                                    <label for="login-email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="login_email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="login-password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" name="login_password" required>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="remember_me">
                                    <label class="form-check-label" for="remember-me">Ghi nhớ đăng nhập</label>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-3" name="login">Đăng nhập</button>
                                <div class="text-center">
                                    <a href="#" class="text-decoration-none">Quên mật khẩu?</a>
                                </div>
                            </form>
                        </div>

                        <!-- form dangki -->
                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form id="form2" method="post" action="./index.php?page=auth">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="full-name" class="form-label">Họ và Tên</label>
                                        <input type="text" class="form-control" id="full-name" name="full-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="register-email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="register-email" name="register-email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password2" class="form-label">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control" id="password2" name="password2" required>
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="agree-terms" required>
                                    <label class="form-check-label" for="agree-terms">Tôi đồng ý với điều khoản</label>
                                </div>

                                <button type="submit" class="btn btn-primary w-100" name="register">Đăng ký</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>