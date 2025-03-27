<?php
include_once __DIR__ . '/../models/NhanVien.php';
include_once __DIR__ . '/../models/PhongBan.php';
include_once __DIR__ . '/../models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->user->login($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header('Location: index.php?controller=nhanvien&action=index');
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu!";
                 include_once __DIR__ . '/../views/user/login.php';
            }
        } else {
            include_once __DIR__ . '/../views/user/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?controller=user&action=login');
    }
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            if ($this->user->register($username, $password, $fullname, $email)) {
                header('Location: index.php?controller=user&action=login');
            } else {
                $error = "Tên đăng nhập hoặc email đã tồn tại!";
                include_once  __DIR__ . '/../views/user/register.php';
            }
        } else {
            include_once  __DIR__ . '/../views/user/register.php';
        }
    }
}
?>  