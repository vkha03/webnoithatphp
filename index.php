<?php
require './config.php'; // Import file cấu hình
require './class.php'; // Import file class

require './pages/header.php'; // Import header

// Xử lý đường dẫn
$page = $_GET['page'] ?? 'home'; // Lấy tên page từ url
switch ($page) {
    // Pages
    case 'home':
        require './pages/home.php';
        break;
    case 'aboutus':
        require './pages/aboutus.php';
        break;
    case 'contact':
        require './pages/contact.php';
        break;
    case 'search':
        require './pages/search.php';
        break;
    case 'discount':
        require './pages/discount.php';
        break;
    case 'login':
        require './pages/login.php';
        break;
    case 'dashboard':
        require './pages/dashboard.php';
        break;
    case 'product':
        require './pages/product.php';
        break;
    case 'edit_product':
        require './pages/edit_product.php';
        break;
    case 'add_product':
        require './pages/add_product.php';
        break;
    case 'product_details':
        require './pages/product_details.php';
        break;
    case 'payment':
        require './pages/payment.php';
        break;
    case 'user':
        require './pages/user.php';
        break;
    case 'admin_users':
        require './pages/admin_users.php';
        break;
    case 'edit_user':
        require './pages/edit_user.php';
        break;
    case 'update_password':
        require './pages/update_password.php';
        break;
    case 'order':
        require './pages/order.php';
        break;
    case 'order_detail':
        require './pages/order_detail.php';
        break;
    case 'edit_address':
        require './pages/edit_address.php';
        break;
    case 'add_cate':
        require './pages/add_cate.php';
        break;
    case 'edit_cate':
        require './pages/edit_cate.php';
        break;
    // Handle
    case 'handle_product':
        require './handle/handle_product.php';
        break;
    case 'update_user':
        require './handle/update_user.php';
        break;
    case 'auth':
        require './handle/auth.php';
        break;
    case 'delete_cate':
        require './pages/delete_cate.php';
        break;
    case 'delete_cart':
        require './pages/delete_cart.php';
        break;
    case 'update_address':
        require './handle/update_address.php';
        break;
    case 'handle_cate':
        require './handle/handle_cate.php';
        break;
    default:
        echo "<script>alert('404 - Not Found')
                window.location.href='./index.php'</script>";
        break;
}

require './pages/footer.php'; // Import footer

$connect->close(); // Đóng kết nối database khi tải xong trang
