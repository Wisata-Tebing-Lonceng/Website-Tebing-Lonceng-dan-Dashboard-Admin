<?php
require_once __DIR__ . '/../config/Database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT id, nama, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($id, $nama, $hash);
        $user = null;
        if ($stmt->fetch()) {
            $user = [
                'id' => $id,
                'nama' => $nama,
                'password' => $hash
            ];
        }
        $stmt->close();
        return $user;
    }

    public function createUser($nama, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $hash);
        $result = $stmt->execute();
        $insert_id = $this->conn->insert_id;
        $stmt->close();
        
        if ($result && $insert_id) {
            return [
                'id' => $insert_id,
                'nama' => $nama,
                'email' => $email
            ];
        }
        return false;
    }

    public function getAdminProfile($username) {
        // Ensure table exists
        $this->conn->query("CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            profile_pic VARCHAR(255) DEFAULT NULL
        )");

        $stmt = $this->conn->prepare("SELECT id, username, password, profile_pic FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        $admin = $res->fetch_assoc();
        $stmt->close();

        // If 'admin' user is missing, create it automatically
        if (!$admin && $username === 'admin') {
            $hash = password_hash('password123', PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hash);
            $stmt->execute();
            $insert_id = $this->conn->insert_id;
            $stmt->close();
            return [
                'id' => $insert_id, 
                'username' => $username, 
                'password' => $hash, 
                'profile_pic' => null
            ];
        }
        
        return $admin;
    }

    public function updateAdminProfile($old_username, $new_username, $password, $profile_pic) {
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("UPDATE admins SET username = ?, password = ?, profile_pic = ? WHERE username = ?");
            $stmt->bind_param("ssss", $new_username, $hash, $profile_pic, $old_username);
        } else {
            $stmt = $this->conn->prepare("UPDATE admins SET username = ?, profile_pic = ? WHERE username = ?");
            $stmt->bind_param("sss", $new_username, $profile_pic, $old_username);
        }
        $res = $stmt->execute();
        $stmt->close();
        return $res;
    }

    public function verifyAdmin($username, $password) {
        $admin = $this->getAdminProfile($username);
        
        if (!$admin) {
            return false;
        }

        // 1. Cek dengan password_verify (untuk password yang di-hash BCrypt)
        if (password_verify($password, $admin['password'])) {
            return true;
        }

        // 2. Cek teks biasa (fallback jika di database diinput manual tanpa hash)
        if ($password === $admin['password']) {
            return true;
        }

        // 3. Khusus untuk default 'password123'
        if ($admin['password'] === 'password123' && $password === 'password123') {
            return true;
        }

        return false;
    }
}
?>
