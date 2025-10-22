<?php

// Lấy danh sách user
$query = "SELECT id_user, full_name, email, phone, created_at, updated_at FROM users ORDER BY id_user DESC";
$result = $connect->query($query);
?>

<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">
        <i class="bi bi-people-fill me-2"></i>Quản lý người dùng
    </h2>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
            <span><i class="bi bi-person-lines-fill me-2"></i>Danh sách người dùng</span>
        </div>

        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Ngày tạo</th>
                        <th>Cập nhật</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($user = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= $user['id_user'] ?></td>
                                <td><?= $user['full_name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['phone'] ?></td>
                                <td><?= $user['created_at'] ?></td>
                                <td><?= $user['updated_at'] ?></td>
                                <td>
                                    <a href="./index.php?page=user_view&id=<?= $user['id_user'] ?>"
                                        class="btn btn-info btn-sm" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="./index.php?page=user_edit&id=<?= $user['id_user'] ?>"
                                        class="btn btn-warning btn-sm" title="Chỉnh sửa">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="./pages/user_delete.php?id=<?= $user['id_user'] ?>"
                                        onclick="return confirm('Xác nhận xóa người dùng này?')"
                                        class="btn btn-danger btn-sm" title="Xóa">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-muted text-center">Chưa có người dùng nào</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>