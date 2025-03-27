<?php
class Controller {
    protected function loadView($view, $data = []) {
        $viewPath = __DIR__ . '/../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            extract($data); // Chuyển mảng $data thành biến
            require $viewPath;

            
        } else {
            die("View không tồn tại: " . $view);
        }
    }

    protected function redirect($url) {
        header("Location: " . BASE_URL . $url);
        exit();
    }
}
?>