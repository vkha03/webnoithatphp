  <?php
    //Chỉnh sửa sản phẩm
    if (isset($_GET['id_product'])) {
        // Lấy id sản phẩm từ URL
        $id_product = $_GET['id_product'] ?? 0;
        $queryProduct = "SELECT * FROM products WHERE id_product = $id_product";
        $resultProduct = $connect->query($queryProduct);

        if ($resultProduct->num_rows == 0) {
            echo "<script>
        alert('Không tìm thấy sản phẩm!');
        window.location.href='./index.php?page=products';
    </script>";
            exit;
        }
        $rowProduct = $resultProduct->fetch_assoc();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_product'])) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

                $target_dir = "./images/products/";

                // Lấy tên file gốc
                $file_name = basename($_FILES["image"]["name"]);

                // Đường dẫn file sau khi upload
                $target_file = $target_dir . $file_name;

                // Lấy loại file (jpg, png, ...)
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Kiểm tra file có phải ảnh không
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check === false) {
                    die("❌ File không phải là ảnh!");
                }

                // Giới hạn kích thước (ví dụ: 5MB)
                if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
                    die("❌ Ảnh quá lớn (tối đa 5MB)");
                }

                // Chỉ cho phép vài định dạng
                $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($imageFileType, $allowed)) {
                    die("❌ Chỉ cho phép JPG, JPEG, PNG, GIF, WEBP");
                }

                // Đổi tên file để tránh trùng
                $new_name = uniqid() . '.' . $imageFileType;
                $target_file = $target_dir . $new_name;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    echo "✅ Ảnh đã được upload thành công!<br>";
                    echo "<img src='$target_file' width='200'>";
                } else {
                    echo "❌ Lỗi khi upload ảnh!";
                }
            }
            $name = $_POST['name'];
            $base_price = $_POST['base_price'];
            $sell_price = $_POST['sell_price'];
            $material = $_POST['material'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $file = $rowProduct['image'];

            $tmp = !empty($target_file) ? "image = '$target_file'," : '';

            $sql = "UPDATE products SET 
                name = '$name',
                {$tmp}
                base_price = '$base_price',
                sell_price = '$sell_price',
                material = '$material',
                size = '$size',
                color = '$color',
                quantity = '$quantity',
                description = '$description'
            WHERE id_product = '$id_product'";

            if ($connect->query($sql)) {
                echo "<script>
            alert('Cập nhật sản phẩm thành công!');
            window.location.href='./index.php?page=product_details&id_product={$id_product}';
        </script>";
            } else {
                echo "<script>
            alert('Cập nhật thất bại!');
            window.location.href='./index.php?page=edit_product&id_product={$id_product}';
        </script>";
            }
        }
    }
    // Lấy danh mục sản phẩm
    $queryCate = "select * from categories";
    $resultCate = $connect->query($queryCate);

    // Hiển thị sản phẩm theo danh mục và số trang
    $page = isset($_GET['num_page']) ? (int)$_GET['num_page'] : 1; // Lấy trang hiện tại từ URL, mặc định là trang 1
    $id_cate = isset($_GET['id_cate']) ? (int)$_GET['id_cate'] : 0; // Lấy id danh mục, mặc định là 0 (Tất cả sản phẩm)
    $limit = 20; // Giới hạn số sản phẩm mỗi trang
    $start = ($page - 1) * $limit; // Bắt đầu từ sản phẩm thứ bao nhiêu

    // Lấy sản phẩm từ database
    if ($id_cate == 0) {
        $queryProduct = "select * from products limit $start, $limit";
        $resultProduct = $connect->query($queryProduct);
    } else {
        $queryProduct = "select * from products where id_cate = $id_cate limit $start, $limit";
        $resultProduct = $connect->query($queryProduct);
    }

    // Tính tổng số sản phẩm để phân trang động theo từng danh mục
    if ($id_cate == 0) {
        $queryCount = "SELECT COUNT(*) AS total FROM products";
    } else $queryCount = "SELECT COUNT(*) AS total FROM products WHERE id_cate = $id_cate";
    $resultCount = $connect->query($queryCount);
    $rowCount = $resultCount->fetch_assoc();
    $totalProduct = $rowCount['total'];
    $totalPage = ceil($totalProduct / $limit); // Làm tròn số trang nếu dư ra sản phẩm
    $numPage = 1; // Trang đầu tiên

    // Thêm sản phẩm
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
        $id_cate = trim($_POST['id_cate']);
        $name = trim($_POST['name']);
        $base_price = trim($_POST['base_price']);
        $sell_price = trim($_POST['sell_price']);
        $material = trim($_POST['material']);
        $size = trim($_POST['size']);
        $color = trim($_POST['color']);
        $quantity = trim($_POST['quantity']);
        $description = trim($_POST['description']);
        $short_description = substr($description, 0, 150); // tóm tắt ngắn tự động

        // Kiểm tra tên sp trống
        if (empty(trim($name))) {
            echo "<script>
            alert('Tên sản phẩm không được để trống!');
            window.location.href='./index.php?page=add_product';
        </script>";
            exit;
        }

        $target_dir = "./images/products/";

        // Lấy tên file gốc
        $file_name = basename($_FILES["image"]["name"]);

        // Đường dẫn file sau khi upload
        $target_file = $target_dir . $file_name;

        // Lấy loại file (jpg, png, ...)
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra file có phải ảnh không
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            die("❌ File không phải là ảnh!");
        }

        // Giới hạn kích thước (ví dụ: 5MB)
        if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
            die("❌ Ảnh quá lớn (tối đa 5MB)");
        }

        // Chỉ cho phép vài định dạng
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowed)) {
            die("❌ Chỉ cho phép JPG, JPEG, PNG, GIF, WEBP");
        }

        // Đổi tên file để tránh trùng
        $new_name = uniqid() . '.' . $imageFileType;
        $target_file = $target_dir . $new_name;

        // Upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "✅ Ảnh đã được upload thành công!<br>";
            echo "<img src='$target_file' width='200'>";
        } else {
            echo "❌ Lỗi khi upload ảnh!";
        }
        // Câu lệnh thêm
        $sql = "INSERT INTO products 
            (id_cate, name, image, material, color, size, quantity, short_description, description, base_price, sell_price)
            VALUES 
            ('$id_cate', '$name', '$target_file', '$material', '$color', '$size', '$quantity', '$short_description', '$description', '$base_price', '$sell_price')";
        if ($connect->query($sql)) {
            echo "<script>
            alert('Thêm sản phẩm thành công!');
            window.location.href='./index.php?page=product';
        </script>";
        } else {
            echo "<script>
            alert('Thêm sản phẩm thất bại!');
            window.location.href='./index.php?page=add_product';
        </script>";
        }
    }
    // Xóa sản phẩm
    if (isset($_GET['delete_product'])) {
        $id_product = $_GET['delete_product'] ?? 0;

        if ($id_product) {
            $sql = "DELETE FROM products WHERE id_product = $id_product";
            if ($connect->query($sql)) {
                echo "<script>
            alert('Xóa sản phẩm thành công!');
            window.location.href = './index.php?page=product';
        </script>";
            } else {
                echo "<script>
            alert('Xóa sản phẩm thất bại!');
            window.location.href = './index.php?page=product';
        </script>";
            }
        } else {
            echo "<script>
        alert('Không tìm thấy sản phẩm cần xóa!');
        window.location.href = './index.php?page=product';
    </script>";
        }
    }

    ?>