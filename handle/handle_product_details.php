<?php
// Hiển thị thông tin sản phẩm và đánh giá sản phẩm
if ($_GET['page'] == 'product_details') {
    $id_product = $_GET['id_product'];
    $product  = new Product($connect, $id_product);

    // Hiển thị danh sách đánh giá sản phẩm
    $sql = "select rv.*, u.full_name as name from reviews rv join users u on u.id_user = rv.id_user where id_product = '$id_product'";
    $result = $connect->query($sql);
    $totalReviews = $result->num_rows; // Đếm tổng số lượt đánh giá
}

// Thêm đánh giá vào database
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review'])) {
    $content = $_POST['content'];
    $rating = $_POST['rating'];
    $sql = "insert into reviews (id_product, id_user, rating, content) values ('$id_product','$config_id_user','$rating','$content')";
    if ($connect->query($sql)) {
        echo "<script> 
                        alert('Đánh giá thành công!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
    } else echo "<script> 
                        alert('Đánh giá thất bại!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
}

// Thêm sản phẩm vào giỏ hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart'])) {
    $quantity = $_POST['quantity'];
    // Nếu sản phẩm đã có trong giỏ hàng thì cộng thêm số lượng
    $check = $connect->query("select * from cart_items where id_user = '$config_id_user' and id_product = '$id_product'");
    // Kiểm tra số lượng thêm vào giỏ hàng + số lượng đã có trong giỏ hàng có vượt quá số lượng trong kho hay không
    if ($check->num_rows > 0) {
        if ($quantity + $check->fetch_assoc()['qty'] > $product->getQuantity()) {
            echo "<script> 
                        alert('Số lượng trong kho không đủ, vui lòng nhập lại số lượng!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
            exit();
        }
        $update = $connect->query("update cart_items set qty = qty + '$quantity' where id_user = '$config_id_user' and id_product = '$id_product'");
        if ($update) {
            echo "<script> 
                        alert('Thêm vào giỏ hàng thành công!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
            exit();
        } else {
            echo "<script> 
                        alert('Thêm vào giỏ hàng thất bại!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
            exit();
        }
    }
    // Nếu sản phẩm chưa có trong giỏ hàng thì thêm mới
    $sql = "insert into cart_items (id_user, id_product, qty) values ('$config_id_user', '$id_product', '$quantity')";
    if ($connect->query($sql)) {
        echo "<script> 
                        alert('Thêm vào giỏ hàng thành công!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
    } else echo "<script> 
                        alert('Thêm vào giỏ hàng thất bại!')
                        window.location.href='./index.php?page=product_details&id_product={$id_product}'
                        </script>";
}

// Xử lý xóa đánh giá (dành cho admin)
if (isset($_GET['delete_review'])) {
    $id_review = $_GET['delete_review'];
    $sql = "delete from reviews where id_review = '$id_review'";
    if ($connect->query($sql)) {
        echo "<script> 
                        alert('Xóa đánh giá thành công!')
                        window.history.back()
                        </script>";
    } else echo "<script> 
                        alert('Xóa đánh giá thất bại!')
                        window.history.back()
                        </script>";
}
