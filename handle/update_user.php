<?php

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    // Lấy dữ liệu từ form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Lấy id user hiện tại
    $id_user = $config_id_user;

    // Xử lý avatar nếu có upload
    $avatar_sql = '';
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {

        $uploadDir = './images/avatars/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        // Lấy tên file gốc
        $file_name = basename($_FILES['avatar']['name']);
        $target_file = $uploadDir . $file_name;

        // Lấy định dạng file
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra file có phải ảnh không
        $check = getimagesize($_FILES['avatar']['tmp_name']);
        if ($check === false) {
            die("<script>alert('❌ File không phải là ảnh!'); window.history.back();</script>");
        }

        // Giới hạn kích thước (5MB)
        if ($_FILES['avatar']['size'] > 5 * 1024 * 1024) {
            die("<script>alert('❌ Ảnh quá lớn (tối đa 5MB)!'); window.history.back();</script>");
        }

        // Chỉ cho phép định dạng
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowed)) {
            die("<script>alert('❌ Chỉ cho phép JPG, JPEG, PNG, GIF, WEBP!'); window.history.back();</script>");
        }

        // Đổi tên file để tránh trùng
        $new_name = uniqid() . '.' . $imageFileType;
        $target_file = $uploadDir . $new_name;

        // Upload file
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            $avatar_sql = ", avatar = '$target_file'"; // Lưu URL vào DB
        } else {
            die("<script>alert('❌ Lỗi khi upload ảnh!'); window.history.back();</script>");
        }
    }

    // Cập nhật bảng users
    $query_user = "UPDATE users 
                   SET full_name = '$full_name', 
                       email = '$email',
                       phone = '$phone'
                       $avatar_sql
                   WHERE id_user = '$id_user'";

    if ($connect->query($query_user) === true) {
        echo "<script>alert('Cập nhật thông tin thành công!');
              window.location.href='./index.php?page=home'</script>";
        exit;
    } else {
        echo "<script>alert('Cập nhật thất bại!');
              window.location.href='./index.php?page=user'</script>";
        exit;
    }
}

// Đổi mật khẩu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
    // Lấy dữ liệu từ form
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Lấy id user hiện tại
    $id_user = $config_id_user;

    // Kiểm tra mật khẩu mới có trùng xác nhận không
    if ($new_password !== $confirm_password) {
        echo "<script>alert('❌ Mật khẩu mới và xác nhận không khớp!'); window.history.back();</script>";
        exit;
    }

    // Lấy mật khẩu hiện tại từ database
    $sql = "SELECT password_hash FROM users WHERE id_user = '$id_user' LIMIT 1";
    $result = $connect->query($sql);
    $user_data = $result->fetch_assoc();

    if (!$user_data || $current_password !== $user_data['password']) {
        echo "<script>alert('❌ Mật khẩu hiện tại không đúng!'); window.history.back();</script>";
        exit;
    }

    // Cập nhật mật khẩu mới (không hash)
    $sql_update = "UPDATE users SET password_hash = '$new_password' WHERE id_user = '$id_user'";
    if ($connect->query($sql_update) === true) {
        echo "<script>alert('✅ Đổi mật khẩu thành công!'); window.location.href='./index.php?page=user'</script>";
        exit;
    } else {
        echo "<script>alert('❌ Đổi mật khẩu thất bại!'); window.history.back();</script>";
        exit;
    }
}
// Xóa users
if (isset($_GET['delete_id_user']) && config_checkRole('admin')) {
    $result = $connect->query("delete from users where id_user = '{$_GET['delete_id_user']}'");
    if ($result === true) {
        echo "<script>
                alert('Xóa thành công!')
                window.location.href='./index.php?page=admin_users'
                </script>";
    } else {
        echo "<script>
                alert('Xóa thất bại!')
                window.location.href='./index.php?page=admin_users'
                </script>";
    }
}
