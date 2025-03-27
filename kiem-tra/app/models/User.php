<?php
class User {
    private $conn;
    private $table_name = "user";

    public $Id;
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    public function register($username, $password, $fullname, $email) {
        // Kiểm tra username hoặc email đã tồn tại chưa
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username OR email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false; // Username hoặc email đã tồn tại
        }
    
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Thêm người dùng mới
        $query = "INSERT INTO " . $this->table_name . " (username, password, fullname, email, role) 
                  VALUES (:username, :password, :fullname, :email, 'user')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":email", $email);
        return $stmt->execute();
    }
}
?>