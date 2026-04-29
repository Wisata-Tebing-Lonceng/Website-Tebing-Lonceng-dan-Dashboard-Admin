<?php
// models/Gallery.php
require_once __DIR__ . '/../config/Database.php';

class Gallery {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function addByAdmin($caption, $imagePath) {
        // Get first valid user_id as placeholder for admin-uploaded photos
        // (galleries.user_id is a NOT NULL FK to users table)
        $res = $this->conn->query("SELECT id FROM users ORDER BY id ASC LIMIT 1");
        $row = $res ? $res->fetch_assoc() : null;
        $userId = $row ? (int)$row['id'] : 0;

        if ($userId <= 0) {
            return false;
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO galleries (user_id, image_path, caption, status, created_at) VALUES (?, ?, ?, 'approved', NOW())"
        );
        $stmt->bind_param("iss", $userId, $imagePath, $caption);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function getAllForAdmin() {

        $stmt = $this->conn->prepare("
            SELECT g.*, u.nama, u.email 
            FROM galleries g 
            JOIN users u ON g.user_id = u.id 
            ORDER BY g.created_at DESC
        ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE galleries SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        // Find image path first to delete the file
        $stmt = $this->conn->prepare("SELECT image_path FROM galleries WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        if ($result) {
            $filePath = __DIR__ . '/../' . $result['image_path'];
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $stmt = $this->conn->prepare("DELETE FROM galleries WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
