<?php
// src/views/errors/404.php

ob_start();
?>

<h2>404 - Trang không tìm thấy</h2>
<p>Xin lỗi, trang bạn yêu cầu không tồn tại.</p>
<a href="index.php?action=index">Quay lại trang chủ</a>

<?php
$content = ob_get_clean();
// require_once __DIR__ . '/../product/list.php';