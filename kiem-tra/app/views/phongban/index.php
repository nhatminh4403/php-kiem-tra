<?php
ob_start();

?>
<h2>Danh sách nhân viên</h2>

<a href="<?= BASE_URL ?>phongban/create">Thêm nhân viên</a>

<table>
    <thead>
        <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Phái</th>
            <th>Nơi Sinh</th>
            <th>Mã Phòng</th>
            <th>Lương</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($nhanViens as $nhanVien): ?>
            <tr>
                <td><?= htmlspecialchars($nhanVien['Ma_NV']) ?></td>
                <td><?= htmlspecialchars($nhanVien['Ten_NV']) ?></td>
                <td>
                    <?php if ($nhanVien['Phai'] == 'NAM'): ?>
                        <img src="<?= BASE_URL ?>imgs/man.jpg" alt="Nam" width="20">
                    <?php elseif ($nhanVien['Phai'] == 'NU'): ?>
                        <img src="<?= BASE_URL ?>imgs/woman.jpg" alt="Nữ" width="20">
                    <?php else: ?>
                        Không xác định
                    <?php endif; ?>
                </td>                <td><?= htmlspecialchars($nhanVien['Noi_Sinh']) ?></td>
                <td><?= htmlspecialchars($nhanVien['Ma_Phong']) ?></td>
                <td><?= htmlspecialchars($nhanVien['Luong']) ?></td>
                <td>
                    <a href="<?= BASE_URL ?>nhanvien/edit/<?= htmlspecialchars($nhanVien['Ma_NV']) ?>">Sửa</a>
                    <a href="<?= BASE_URL ?>nhanvien/delete/<?= htmlspecialchars($nhanVien['Ma_NV']) ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php
$content = ob_get_clean();
include __DIR__ . '/../shares/main.php'; ?>