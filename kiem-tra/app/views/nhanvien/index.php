<?php include_once __DIR__ . '/../layout/header.php'; ?>

<h1 class="text-center">THÔNG TIN NHÂN VIÊN</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Giới tính</th>
            <th>Nơi Sinh</th>
            <th>Tên Phòng</th>
            <th>Lương</th>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
            <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <td><?php echo $row['Ma_NV']; ?></td>
            <td><?php echo $row['Ten_NV']; ?></td>
            <td>
                <?php if ($row['Phai'] == 'NU'): ?>
                    <img src="imgs/woman.jpg" alt="Nữ" width="50">
                <?php else: ?>
                    <img src="imgs/man.jpg" alt="Nam" width="50">
                <?php endif; ?>
            </td>
            <td><?php echo $row['Noi_Sinh']; ?></td>
            <td><?php echo $row['Ten_Phong']; ?></td>
            <td><?php echo $row['Luong']; ?></td>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
            <td>
                <a href="index.php?controller=nhanvien&action=edit&id=<?php echo $row['Ma_NV']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                <a href="index.php?controller=nhanvien&action=delete&id=<?php echo $row['Ma_NV']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<div class="d-flex justify-content-center">
    <?php for ($i = 1; $i <= $pages; $i++): ?>
        <a href="index.php?controller=nhanvien&action=index&page=<?php echo $i; ?>" class="btn btn-outline-primary mx-1 <?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<?php include_once __DIR__ . '/../layout/footer.php'; ?>
