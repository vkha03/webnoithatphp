<?php
// Đăng nhập
if (isset($_POST['login'])) {
    $email = $_POST['login_email'];
    $password_hash = $_POST['login_password'];
    if ($email == "" || $password_hash == "") {
        echo "<script> alert('Vui lòng không để trống mật khẩu và email !!');
          </script>";
    } else {
        $result = $connect->query("SELECT * FROM users WHERE email = '$email' AND password_hash = '$password_hash'");
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            // Lưu thông tin vào session
            $_SESSION['email'] = $data['email'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['id_user'] = $data['id_user'];
            echo "<script> 
      alert('Đăng nhập thành công!')
      window.location.href='./index.php?page=home'
     </script>";
        } else {
            echo "<script>
    alert ('Sai email hoặc mật khẩu')
    window.location.href='./index.php?page=login';
    </script>";
        }
    }
}

// Đăng kí
if (isset($_POST['register'])) {
    $full_name = $_POST['full-name'];
    $phone = $_POST['phone'];
    $email = $_POST['register-email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password !== $password2) {
        echo "<script>alert('Xác nhận mật khẩu không trùng khớp !!!');
            window.location.href='./index.php?page=login'
            </script>";
        exit;
    }
    // Kiểm tra email trùng
    $hi = "SELECT * FROM users WHERE email = '$email'";
    $checkemail = mysqli_query($connect, $hi);
    if (mysqli_num_rows($checkemail) > 0) {
        echo "<script>alert('Email đã có sẵn, vui lòng nhập email khác!');
                window.location.href='./index.php?page=login'
          </script>";
        exit;
    }
    $sql = "insert into users(email,password_hash,full_name,phone) 
                  values('$email','$password','$full_name','$phone')";

    if (mysqli_query($connect, $sql)) {
        echo "<script>alert('Đăng ký thành công!');
         window.location.href='./index.php?page=login'
    </script>";
        exit;
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    echo "<script> 
      alert('Đăng xuất thành công!')
      window.location.href='./index.php?page=home'
     </script>";
}
