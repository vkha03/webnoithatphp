<?php
require './handle/handle_cart.php'; // Gọi file handle_cart để lấy tổng sản phẩm giỏ hàng

// Kiểm tra giỏ hàng có sản phẩm hay không
if ($totalCart <= 0) {
    echo "<script>
        alert('Chưa có sản phẩm trong giỏ hàng')
        history.back()
    </script>";
    exit;
}

// Lấy sản phẩm từ giỏ hàng
$sqlGetCart = "select *  from cart_items ci join products pr on pr.id_product = ci.id_product where ci.id_user = '$config_id_user'";
$resultCart = $connect->query($sqlGetCart);
$totalPrice = 0; // Tổng giá tiền đơn hàng

// Lấy địa chỉ người dùng
$address = new Address($connect, $config_id_user);

// Xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['payment']) {

    if ($address->getIdAddress() == '') {
        echo "<script>alert('Bạn chưa thêm địa chỉ giao hàng!');
    window.location.href = './index.php?page=payment';</script>";
        exit;
    }

    $check = true; // Biến kiểm tra kết quả

    // Tính tổng giá tiền đơn hàng
    $totalPrice = 0;
    $tempResult = $connect->query($sqlGetCart);
    while ($tempData = $tempResult->fetch_assoc()) {
        $totalPrice += ($tempData['sell_price'] * $tempData['qty']);
    }

    // Thêm đơn hàng vào database
    $sql = "insert into orders (id_user,id_address,status,subtotal,shipping_fee,discount,total) values ('$config_id_user', '{$address->getIdAddress()}', 'pending', '$totalPrice', '0', 0, '$totalPrice')";
    if ($connect->query($sql) === true) {
        $id_order = $connect->insert_id;
    } else {
        $check = false;
        exit;
    }

    // Thêm chi tiết đơn hàng vào database theo đơn hàng
    $resultCartHandle = $connect->query($sqlGetCart); // Lấy lại sản phẩm giỏ hàng để xử lý
    while ($dataCartHandle = $resultCartHandle->fetch_assoc()) {
        $price = $dataCartHandle['sell_price'] * $dataCartHandle['qty']; // Tổng giá tiền của mỗi sản phẩm theo số lượng
        $sql = "insert into order_items (id_order, id_product, product_name, unit_price, qty, total_price) values ('$id_order', '{$dataCartHandle['id_product']}', '{$dataCartHandle['name']}', '{$dataCartHandle['sell_price']}', '{$dataCartHandle['qty']}', '$price')";
        $result = $connect->query($sql);
        if ($result === false) {
            $connect->query("delete from orders where id_order = '$id_order'");
            echo "<script>
            alert('Đặt hàng thất bại!');
            window.location.href = './index.php?page=payment';
            </script>";
            $check = false;
            exit;
        }
    }

    // Xóa sản phẩm trong giỏ hàng và cập nhật lại số lượng sản phẩm trong database
    if ($check === true) {
        $updateQty = $connect->query($sqlGetCart); // Lấy lại sản phẩm giỏ hàng để xử lý
        while ($dataQty = $updateQty->fetch_assoc()) {
            $connect->query("update products set quantity = quantity - {$dataQty['qty']} where id_product = {$dataQty['id_product']}");
        }
        $connect->query("delete from cart_items where id_user = '$config_id_user'"); // Xóa sản phẩm trong giỏ hàng
        echo "<script>
            alert('Đặt hàng thành công!');
            window.location.href = './index.php?page=order';
        </script>";
    }
}
