<?php
require_once __DIR__ . '/../config/Database.php';

class Review {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    /** Semua review (termasuk id) untuk tampilan user carousel, hanya yang approved */
    public function getAllReviews(): array {
        $reviews = [];
        $result = $this->conn->query(
            "SELECT id, nama, kesan, created_at FROM reviews WHERE status = 'approved' ORDER BY created_at DESC"
        );
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
        }
        return $reviews;
    }

    /** Semua review dengan info user, untuk panel admin */
    public function getAllForAdmin(): array {
        $reviews = [];
        $result = $this->conn->query(
            "SELECT r.id, r.nama, r.kesan, r.status, r.created_at,
                    u.email
             FROM reviews r
             LEFT JOIN users u ON r.user_id = u.id
             ORDER BY r.created_at DESC"
        );
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
        }
        return $reviews;
    }

    /** Update status review */
    public function updateStatus(int $id, string $status): bool {
        $stmt = $this->conn->prepare("UPDATE reviews SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function getRecent(int $limit = 5): array {
        $reviews = [];
        $stmt = $this->conn->prepare(
            "SELECT id, nama, kesan, created_at, status FROM reviews ORDER BY created_at DESC LIMIT ?"
        );
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $reviews[] = $row;
            }
        }
        $stmt->close();
        return $reviews;
    }

    public function countAll(): int {
        $result = $this->conn->query("SELECT COUNT(*) as total FROM reviews");
        if ($result) {
            return (int) $result->fetch_assoc()['total'];
        }
        return 0;
    }

    /** Tambah review dari pengunjung — selalu masuk sebagai 'pending' untuk dimoderasi admin */
    public function addReview(int $userId, string $nama, string $kesan): bool {
        $status = 'pending';
        $stmt = $this->conn->prepare(
            "INSERT INTO reviews (user_id, nama, kesan, status) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isss", $userId, $nama, $kesan, $status);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }

    public function addByAdmin(string $nama, string $kesan): array|false {
        $emailAdmin = 'admin_review@system';
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $emailAdmin);
        $stmt->execute();
        $stmt->bind_result($adminUserId);
        $exists = $stmt->fetch();
        $stmt->close();

        if (!$exists) {
            $namaAdmin = 'Admin System';
            $passAdmin = '';
            $stmt = $this->conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $namaAdmin, $emailAdmin, $passAdmin);
            $stmt->execute();
            $adminUserId = $this->conn->insert_id;
            $stmt->close();
        }

        $status = 'approved'; // Admin-added reviews are immediately approved
        $stmt = $this->conn->prepare(
            "INSERT INTO reviews (user_id, nama, kesan, status) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("isss", $adminUserId, $nama, $kesan, $status);
        $ok = $stmt->execute();
        $id = $this->conn->insert_id;
        $stmt->close();

        if ($ok && $id) {
            return [
                'id'         => $id,
                'nama'       => $nama,
                'kesan'      => $kesan,
                'created_at' => date('Y-m-d H:i:s'),
                'email'      => null
            ];
        }
        return false;
    }

    /** Edit review (nama + kesan) */
    public function update(int $id, string $nama, string $kesan): bool {
        $stmt = $this->conn->prepare(
            "UPDATE reviews SET nama = ?, kesan = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $nama, $kesan, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /** Hapus review */
    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id = ?");
        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /** Ambil satu review by id */
    public function getById(int $id): ?array {
        $stmt = $this->conn->prepare(
            "SELECT id, nama, kesan, created_at FROM reviews WHERE id = ?"
        );
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }
}
?>

