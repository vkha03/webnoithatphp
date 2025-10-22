<?php
require './handle/handle_contact.php';
?>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f5f0;
    }

    .contact-header {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
            url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 100px 0;
        margin-bottom: 50px;
    }

    .contact-card {
        background-color: white;
        border-radius: 5px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .contact-icon {
        font-size: 24px;
        margin-right: 10px;
    }

    .btn-primary:hover {
        background-color: #6d4621;
        border-color: #6d4621;
    }
</style>
<!-- Header với hình ảnh nội thất -->
<header class="contact-header text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Liên hệ với chúng tôi</h1>
        <p class="lead">Nội Thất DecoX - Mang đến không gian sống hoàn hảo</p>
    </div>
</header>

<!-- Phần nội dung chính -->
<main class="container">
    <div class="row">
        <!-- Thông tin liên hệ -->
        <div class="col-lg-5 mb-4">
            <div class="contact-card h-100">
                <h2 class="mb-4 text-primary"><i class="bi bi-house contact-icon"></i> Nội Thất DecoX</h2>
                <p class="mb-4">Chúng tôi chuyên cung cấp các giải pháp nội thất cao cấp, thiết kế theo yêu cầu và
                    tư vấn không gian sống tối ưu.</p>

                <div class="mb-3">
                    <h5><i class="bi bi-geo-alt contact-icon"></i> Địa chỉ</h5>
                    <p>Số 413, Đường 30/4, Phường Hưng Lợi, Quận Ninh Kiều, TP. Cần Thơ</p>
                </div>

                <div class="mb-3">
                    <h5><i class="bi bi-telephone contact-icon"></i> Điện thoại</h5>
                    <p>0939.422.165</p>
                </div>

                <div class="mb-3">
                    <h5><i class="bi bi-envelope contact-icon"></i> Email</h5>
                    <p>Ngkhangg3003@gmail.com</p>
                </div>

                <div class="mb-3">
                    <h5><i class="bi bi-clock contact-icon"></i> Giờ làm việc</h5>
                    <p>Thứ 2 - Thứ 7: 8:00 - 18:00</p>
                    <p>Chủ nhật: 9:00 - 12:00</p>
                </div>
            </div>
        </div>

        <!-- Form liên hệ -->
        <div class="col-lg-7">
            <div class="contact-card">
                <h2 class="mb-4 text-primary"><i class="bi bi-pencil contact-icon"></i> Gửi yêu cầu</h2>
                <form method="POST" action="">

                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" name="title" value="" placeholder="Nhập tiêu đề yêu cầu của bạn...">
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Nội dung yêu cầu</label>
                        <textarea class="form-control" id="message" name="description" rows="5" placeholder="Mô tả chi tiết yêu cầu của bạn..."></textarea>
                    </div>

                    <button type="submit" class="btn px-4 py-2" style="background-color: blue; color: white;">Gửi yêu cầu</button>
                </form>
            </div>
        </div>
    </div>

    <!-- map -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="contact-card">
                <h3 class="mb-4"><i class="bi bi-map contact-icon"></i> Bản đồ</h3>
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.026407106879!2d105.76449424982214!3d10.014677299429461!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883386360bf7%3A0x7e6cb1199f229872!2zVHLGsOG7nW5nIENhbyDEkOG6s25nIEPhuqduIFRoxqE!5e0!3m2!1svi!2s!4v1747533861472!5m2!1svi!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</main>