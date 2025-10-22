            <?php
            // Lấy thông tin sản phẩm
            $id_product = $_GET['id_product'];
            $queryProduct = "select * from products where id_product = $id_product";
            $resultProduct = $connect->query($queryProduct);
            $rowProduct = $resultProduct->fetch_assoc();

            // Hiển thị danh sách đánh giá sản phẩm
            $sql = "select rv.*, u.full_name as name from reviews rv join users u on u.id_user = rv.id_user where id_product = '$id_product'";
            $result = $connect->query($sql);

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

            ?>
