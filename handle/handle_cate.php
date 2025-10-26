<?php
// Lấy tất cả danh mục
$result = $connect->query("SELECT * FROM categories");

// Cập nhật danh mục
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cate'])) {
    $id_category = $_POST['id_category'];
    $new_name = trim($_POST['new_name']);

    if (empty($new_name)) {
        echo "<script>
            alert('Tên danh mục không được để trống!');
            window.history.back();
        </script>";
        exit;
    }

    $update = "UPDATE categories SET name = '$new_name' WHERE id_cate = '$id_category'";
    if ($connect->query($update)) {
        echo "<script>
            alert('Cập nhật danh mục thành công!');
            window.location.href='./index.php?page=product';
        </script>";
    } else {
        echo "<script>
            alert('Cập nhật thất bại!');
            window.history.back();
        </script>";
    }
}

// Thêm danh mục
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_cate'])) {
    $category_name = trim($_POST['category_name']);

    if (empty($category_name)) {
        echo "<script>
            alert('Vui lòng nhập tên danh mục!');
            window.location.href='./index.php?page=add_cate';
        </script>";
        exit;
    }

    $sql = "INSERT INTO categories (name) VALUES ('$category_name')";
    if ($connect->query($sql)) {
        echo "<script>
            alert('Thêm danh mục thành công!');
            window.location.href='./index.php?page=product';
        </script>";
    } else {
        echo "<script>
            alert('Thêm danh mục thất bại!');
            window.history.back();
        </script>";
    }
}

// Xóa danh mục
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_cate'])) {
    $id_category = $_POST['id_category'];

    if (empty($id_category)) {
        echo "<script>
            alert('Vui lòng chọn danh mục cần xóa!');
            window.location.href='./index.php?page=delete_cate';
        </script>";
        exit;
    }

    // Kiểm tra xem danh mục có sản phẩm không (nếu có thì không xóa)
    $check = $connect->query("SELECT * FROM products WHERE id_cate = '$id_category'");
    if ($check->num_rows > 0) {
        echo "<script>
            alert('Không thể xóa danh mục này vì vẫn còn sản phẩm liên quan!');
            window.location.href='./index.php?page=delete_cate';
        </script>";
        exit;
    }

    // Thực hiện xóa
    $delete = "DELETE FROM categories WHERE id_cate = '$id_category'";
    if ($connect->query($delete)) {
        echo "<script>
            alert('Xóa danh mục thành công!');
            window.location.href='./index.php?page=delete_cate';
        </script>";
    } else {
        echo "<script>
            alert('Xóa thất bại, vui lòng thử lại!');
            window.location.href='./index.php?page=delete_cate';
        </script>";
    }
}
