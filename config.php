<?php
// Set server database
$host = "localhost";
$user = "root";
$password = "";
$database = "quanlybannoithat";

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get data session
$config_email = $_SESSION['email'] ?? null;
$config_role = $_SESSION['role'] ?? null;
$config_id_user = $_SESSION['id_user'] ?? null;

// Connect database
$connect = new mysqli($host, $user, $password, $database);

// Set language
mysqli_set_charset($connect, "utf8mb4");

// Check login
function config_checkLogin()
{
    if (isset($_SESSION['email'])) {
        return true;
    } else return false;
}

// Check role
function config_checkRole($role)
{
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        return false;
    }
    return true;
}
