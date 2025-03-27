<?php include_once __DIR__ . '/../layout/header.php'; ?>

<h1 class="text-center">THÊM NHÂN VIÊN</h1>
<form action="index.php?controller=nhanvien&action=add" method="post" class="row g-3">
    <div class="col-md-6">
        <label for="Ma_NV" class="form-label">Mã NV</label>
        <input type="text" class="form-control" id="Ma_NV" name="Ma_NV" required>
    </div>
    <div class="col-md-6">
        <label for="Ten_NV" class="form-label">Tên NV</label>
        <input type="text" class="form-control" id="Ten_NV" name="Ten_NV" required>
    </div>
    <div class="col-md-6">
        <label for="Phai" class="form-label">Giới tính</label>
        <select class="form-select" id="Phai" name="Phai">
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="Noi_Sinh" class="form-label">Nơi Sinh</label>
        <input type="text" class="form-control" id="Noi_Sinh" name="Noi_Sinh">
    </div>
    <div class="col-md-6">
        <label for="Ma_Phong" class="form-label">Phòng Ban</label>
        <select class="form-select" id="Ma_Phong" name="Ma_Phong">
            <?php while ($row = $phongban_stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?php echo $row['Ma_Phong']; ?>"><?php echo $row['Ten_Phong']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="Luong" class="form-label">Lương</label>
        <input type="number" class="form-control" id="Luong" name="Luong" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Thêm</button>
    </div>
</form>

<?php include_once __DIR__ . '/../layout/footer.php'; ?>
