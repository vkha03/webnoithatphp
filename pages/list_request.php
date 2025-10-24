<?php
$result = $connect->query("
    SELECT r.id_requirement, u.full_name, r.title, r.status, r.created_at 
    FROM requirements r
    JOIN users u ON r.id_user = u.id_user
    ORDER BY r.created_at DESC
");
?>

<div class="container py-4">
    <h3 class="fw-bold mb-4 text-center"><i class="bi bi-headset me-2"></i>Danh sách yêu cầu hỗ trợ</h3>
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-info">
            <tr>
                <th>ID</th>
                <th>Người gửi</th>
                <th>Chủ đề</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>#<?= $row['id_requirement'] ?></td>
                        <td><?= htmlspecialchars($row['full_name']) ?></td>
                        <td><?= htmlspecialchars($row['title']) ?></td>
                        <td>
                            <?php
                            $statusColor = match ($row['status']) {
                                'Đang xử lý' => 'warning',
                                'Hoàn tất' => 'success',
                                'Đã hủy' => 'danger',
                                default => 'secondary'
                            };
                            ?>
                            <span class="badge bg-<?= $statusColor ?>"><?= $row['status'] ?></span>
                        </td>
                        <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Chưa có yêu cầu nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>