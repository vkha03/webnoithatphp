<?php
require './handle/handle_cart.php';

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
$totalPrice = 0;

// Lấy địa chỉ người dùng
$address = new Address($connect, $config_id_user);

// Xử lý đặt hàng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['payment']) {
    if ($address->idAddress == 0) {
        echo "<script>alert('Bạn chưa thêm địa chỉ giao hàng!');
    window.location.href = './index.php?page=payment';</script>";
        exit;
    }
    $check = true;
    $tempResult = $connect->query($sqlGetCart);
    while ($tempData = $tempResult->fetch_assoc()) {
        $totalPrice += ($tempData['sell_price'] * $tempData['qty']);
    }
    $sql = "insert into orders (id_user,id_address,status,subtotal,shipping_fee,discount,total) values ('$config_id_user', '$address->idAddress', 'pending', '$totalPrice', '0', 0, '$totalPrice')";
    if ($connect->query($sql) === true) {
        $id_order = $connect->insert_id;
    } else {
        $check = false;
        exit;
    }
    $resultCartHandle = $connect->query($sqlGetCart);
    while ($dataCartHandle = $resultCartHandle->fetch_assoc()) {
        $price = $dataCartHandle['sell_price'] * $dataCartHandle['qty'];
        $sql = "insert into order_items (id_order, id_product, product_name, unit_price, qty, total_price) values ('$id_order', '{$dataCartHandle['id_product']}', '{$dataCartHandle['name']}', '{$dataCartHandle['sell_price']}', '{$dataCartHandle['qty']}', '$price')";
        $result = $connect->query($sql);
        $updateQuantity = $connect->query("update products set quantity = quantity - {$dataCartHandle['qty']} where id_product = {$dataCartHandle['id_product']}");
        if ($result === false || $updateQuantity === false) {
            echo "<script>
            alert('Đặt hàng thất bại!');
            window.location.href = './index.php?page=payment';
        </script>";
            $check = false;
            exit;
        }
    }
    if ($check == true && $connect->query("delete from cart_items where id_user = '$config_id_user'")) {
        echo "<script>
            alert('Đặt hàng thành công!');
            window.location.href = './index.php?page=payment';
        </script>";
    }
}
