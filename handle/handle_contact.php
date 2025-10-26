<?php

// Xử lý gửi yêu cầu liên hệ hỗ trợ
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (config_checkLogin() == false) {
        echo "<script>
        alert('Vui lòng đăng nhập để gửi yêu cầu!');
        window.location.href='./index.php?page=contact';
        </script>";
    }
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);

    if (empty($title) && empty($description)) {
        echo "<script>
        alert('Vui lòng không để trống thông tin!');
        window.location.href='./index.php?page=contact';
        </script>";
    }

    $sql = "INSERT INTO requirements (id_user, title, description, status) VALUES ('$config_id_user', '$title', '$description', 'pending')";

    if ($connect->query($sql)) {
        echo "<script>
        alert('Cảm ơn $name! Yêu cầu của bạn đã được gửi thành công. Chúng tôi sẽ liên hệ lại trong thời gian sớm nhất.');
        window.location.href='./index.php?page=contact';
    </script>";
    } else {
        echo "<script>
        alert('Có lỗi xảy ra khi gửi yêu cầu. Vui lòng thử lại!');
        window.location.href='./index.php?page=contact';
    </script>";
    }
}
