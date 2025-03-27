<?php
class PhongBan {
    private $conn;
    private $table_name = "phongban";

    public $Ma_Phong;
    public $Ten_Phong;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>