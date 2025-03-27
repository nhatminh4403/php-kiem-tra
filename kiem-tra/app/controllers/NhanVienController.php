<?php
include_once __DIR__ . '/../models/NhanVien.php';
include_once __DIR__ . '/../models/PhongBan.php';

class NhanVienController {
    private $db;
    private $nhanvien;
    private $phongban;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->nhanvien = new NhanVien($this->db);
        $this->phongban = new PhongBan($this->db);
    }

    public function index() {
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $stmt = $this->nhanvien->read($page);
        $total = $this->nhanvien->getTotal();
        $pages = ceil($total / 5);
        include_once __DIR__ . '/../views/nhanvien/index.php';
    }

    public function add() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->nhanvien->Ma_NV = $_POST['Ma_NV'];
            $this->nhanvien->Ten_NV = $_POST['Ten_NV'];
            $this->nhanvien->Phai = $_POST['Phai'];
            $this->nhanvien->Noi_Sinh = $_POST['Noi_Sinh'];
            $this->nhanvien->Ma_Phong = $_POST['Ma_Phong'];
            $this->nhanvien->Luong = $_POST['Luong'];
            if ($this->nhanvien->create()) {
                header('Location: index.php?controller=nhanvien&action=index');
            }
        }
        $phongban_stmt = $this->phongban->readAll();
        include_once __DIR__ . '/../views/nhanvien/add.php';
    }

    public function edit() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->nhanvien->Ma_NV = $_POST['Ma_NV'];
            $this->nhanvien->Ten_NV = $_POST['Ten_NV'];
            $this->nhanvien->Phai = $_POST['Phai'];
            $this->nhanvien->Noi_Sinh = $_POST['Noi_Sinh'];
            $this->nhanvien->Ma_Phong = $_POST['Ma_Phong'];
            $this->nhanvien->Luong = $_POST['Luong'];
            if ($this->nhanvien->update()) {
                header('Location: index.php?controller=nhanvien&action=index');
            }
        }
        $nhanvien = $this->nhanvien->readOne($id);
        $phongban_stmt = $this->phongban->readAll();
        include_once __DIR__ . '/../views/nhanvien/edit.php';
    }

    public function delete() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
        $id = $_GET['id'];
        if ($this->nhanvien->delete($id)) {
            header('Location: index.php?controller=nhanvien&action=index');
        }
    }
}
?>