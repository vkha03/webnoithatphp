<?php
require './handle/handle_request.php';
?>

<div class="container py-4">
    <h3 class="fw-bold mb-4 text-center">
        <i class="bi bi-headset me-2"></i>Danh sách yêu cầu hỗ trợ
    </h3>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-info text-center">
            <tr>
                <th>ID</th>
                <th>Người gửi</th>
                <th>Chủ đề</th>
                <th>Nội dung yêu cầu</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center fw-semibold">#<?= $row['id_requirement'] ?></td>
                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td><?= htmlspecialchars($row['description'] ?? 'Không có nội dung') ?></td>
                        <td class="text-center">
                            <form method="POST" action="./index.php?page=handle_request" class="d-inline">
                                <input type="hidden" name="update_requirement" value="<?= $row['id_requirement'] ?>">
                                <div class="input-group input-group-sm">
                                    <select name="status" class="form-select">
                                        <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Chưa xử lý</option>
                                        <option value="in_progress" <?= $row['status'] == 'in_progress' ? 'selected' : '' ?>>Đang xử lý</option>
                                        <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="cancelled" <?= $row['status'] == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-warning">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="./index.php?page=handle_request&delete_requirement=<?= $row['id_requirement'] ?>"
                                onclick="return confirm('Bạn có chắc muốn xóa yêu cầu này không?');"
                                class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Chưa có yêu cầu nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>