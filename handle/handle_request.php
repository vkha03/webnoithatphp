<?php
// Cập nhật trạng thái yêu cầu hỗ trợ
if (isset($_POST['update_status'])) {
    $id_requirement = $_POST['update_requirement'];
    $status = $_POST['status'];
    $result = $connect->query("UPDATE requirements SET status = '$status' WHERE id_requirement = $id_requirement");
    if ($result === true) {
        echo "<script>alert('Cập nhật trạng thái thành công!');</script>";
        echo "<script>window.location.href='./index.php?page=list_request';</script>";
    } else {
        echo "<script>alert('Cập nhật trạng thái thất bại!');</script>";
        echo "<script>window.location.href='./index.php?page=list_request';</script>";
    }
}

// Lấy danh sách yêu cầu hỗ trợ
$result = $connect->query("
    SELECT *
    FROM requirements r
    JOIN users u ON r.id_user = u.id_user
    ORDER BY r.created_at DESC
");

// Xóa yêu cầu hỗ trợ
if (isset($_GET['delete_requirement'])) {
    $deleteId = $_GET['delete_requirement'];
    // Xóa yêu cầu hỗ trợ
    $result = $connect->query("DELETE FROM requirements WHERE id_requirement = $deleteId");
    if ($result === true) {
        echo "<script>alert('Xóa yêu cầu thành công!');</script>";
        echo "<script>window.location.href='./index.php?page=list_request';</script>";
    } else {
        echo "<script>alert('Xóa yêu cầu thất bại!');</script>";
        echo "<script>window.location.href='./index.php?page=list_request';</script>";
        exit();
    }
}
