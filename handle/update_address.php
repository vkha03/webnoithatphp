<?php

// Kiểm tra nếu form được submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  Lấy dữ liệu từ form
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $label = $_POST['label'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $ward = $_POST['ward'];
    $street = $_POST['street'];

    // Lấy id user hiện tại (bạn đã có sẵn biến $config_id_user trong session)
    $id_user = $config_id_user;
    // Kiểm tra có địa chỉ chưa
    $result = $connect->query("SELECT * FROM addresses WHERE id_user = '$id_user'");
    if ($result->num_rows > 0) {
        // Đã có -> update
        $query_address = "UPDATE addresses  
                      SET recipient_name = '$full_name',
                          province = '$province',
                          phone = '$phone',
                          district = '$district',
                          ward = '$ward', 
                          label = '$label', 
                          street = '$street'
                      WHERE id_user = '$id_user'";
    } else {
        // Chưa có -> insert mới
        $query_address = "INSERT INTO addresses (id_user, recipient_name, phone, province, district, ward, label, street)
                      VALUES ('$id_user', '$full_name','$phone', '$province', '$district', '$ward', '$label', '$street')";
    }
    if ($connect->query($query_address)) {


        // Quay lại trang thông tin
        echo " <script>alert('Cập nhật thông tin thành công!');
         window.location.href='./index.php?page=home'
         </script>";
        exit;
    } else {
        // Nếu không phải POST thì quay về trang thông tin
        echo " <script>alert('Không có dữ liệu để cập nhật!');
         window.location.href='./index.php?page=user'
         </script>";
        exit;
    }
}
