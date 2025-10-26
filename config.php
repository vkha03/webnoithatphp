<?php
// Cấu hình database
$host = "localhost";
$user = "root";
$password = "";
$database = "quanlybannoithat";

// Mở session mỗi khi load trang
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối database
$connect = new mysqli($host, $user, $password, $database);

// Cài ngôn ngữ database
mysqli_set_charset($connect, "utf8mb4");

// Lấy data từ session
$config_email = $_SESSION['email'] ?? null;
$config_role = $_SESSION['role'] ?? null;
$config_id_user = $_SESSION['id_user'] ?? null;

// Kiểm tra đăng nhập
function config_checkLogin()
{
    if (isset($_SESSION['email'])) {
        return true;
    } else return false;
}

// Kiểm tra phân quyền
function config_checkRole($role)
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        return false;
    }
    return true;
}
