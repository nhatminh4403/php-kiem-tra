<?php
class NhanVien {
    private $conn;
    private $table_name = "nhanvien";

    public $Ma_NV;
    public $Ten_NV;
    public $Phai;
    public $Noi_Sinh;
    public $Ma_Phong;
    public $Luong;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read($page = 1, $limit = 5) {
        $start = ($page - 1) * $limit;
        $query = "SELECT NV.*, PB.Ten_Phong FROM " . $this->table_name . " NV 
                  LEFT JOIN PHONGBAN PB ON NV.Ma_Phong = PB.Ma_Phong 
                  LIMIT :start, :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function getTotal() {
        $query = "SELECT COUNT(*) FROM " . $this->table_name;
        return $this->conn->query($query)->fetchColumn();
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET 
                  Ma_NV=:Ma_NV, Ten_NV=:Ten_NV, Phai=:Phai, Noi_Sinh=:Noi_Sinh, Ma_Phong=:Ma_Phong, Luong=:Luong";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Ma_NV", $this->Ma_NV);
        $stmt->bindParam(":Ten_NV", $this->Ten_NV);
        $stmt->bindParam(":Phai", $this->Phai);
        $stmt->bindParam(":Noi_Sinh", $this->Noi_Sinh);
        $stmt->bindParam(":Ma_Phong", $this->Ma_Phong);
        $stmt->bindParam(":Luong", $this->Luong);
        return $stmt->execute();
    }

    public function readOne($id) {
        $query = "SELECT NV.*, PB.Ten_Phong FROM " . $this->table_name . " NV 
                  LEFT JOIN PHONGBAN PB ON NV.Ma_Phong = PB.Ma_Phong 
                  WHERE NV.Ma_NV = :Ma_NV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Ma_NV", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET 
                  Ten_NV=:Ten_NV, Phai=:Phai, Noi_Sinh=:Noi_Sinh, Ma_Phong=:Ma_Phong, Luong=:Luong 
                  WHERE Ma_NV=:Ma_NV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Ma_NV", $this->Ma_NV);
        $stmt->bindParam(":Ten_NV", $this->Ten_NV);
        $stmt->bindParam(":Phai", $this->Phai);
        $stmt->bindParam(":Noi_Sinh", $this->Noi_Sinh);
        $stmt->bindParam(":Ma_Phong", $this->Ma_Phong);
        $stmt->bindParam(":Luong", $this->Luong);
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE Ma_NV = :Ma_NV";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Ma_NV", $id);
        return $stmt->execute();
    }
}
?>