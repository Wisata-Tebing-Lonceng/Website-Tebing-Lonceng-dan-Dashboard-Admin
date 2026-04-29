<?php
require_once __DIR__ . '/../config/Database.php';

class Fasilitas {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
        $this->initTable();
    }

    private function initTable() {
        // Buat tabel jika belum ada
        $sql = "CREATE TABLE IF NOT EXISTS fasilitas (
            id INT NOT NULL AUTO_INCREMENT,
            kategori VARCHAR(50) NOT NULL COMMENT 'spotfoto atau homestay',
            judul VARCHAR(200) DEFAULT NULL,
            deskripsi TEXT DEFAULT NULL,
            gambar VARCHAR(255) DEFAULT NULL,
            urutan INT DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $this->conn->query($sql);

        // Seed data default jika tabel kosong
        $result = $this->conn->query("SELECT COUNT(*) as count FROM fasilitas");
        if ($result && $result->fetch_assoc()['count'] == 0) {
            $defaults = [
                // Spot Foto
                ['spotfoto', 'Tebing Utama',    'Tebing Utama — titik pandang paling ikonik dengan pemandangan langsung ke Sungai Mahakam.',              'assets/img/2.webp',  1],
                ['spotfoto', 'Panorama 180°',   'Panorama 180° — spot terbuka dengan latar langit dan hamparan kota Samarinda.',                           'assets/img/5.webp',  2],
                ['spotfoto', 'Koridor Hijau',   'Koridor Hijau — jalur yang rindang dengan estetika alami yang sempurna untuk foto.',                       'assets/img/9.webp',  3],
                ['spotfoto', 'Spot Senja',      'Spot Senja — lokasi terbaik untuk menikmati dan mengabadikan golden hour Samarinda.',                      'assets/img/11.webp', 4],
                // Homestay (4 foto carousel)
                ['homestay', 'Homestay 1', 'Kamar dengan pemandangan kota Samarinda yang menakjubkan.', 'assets/img/16.webp', 1],
                ['homestay', 'Homestay 2', 'Suasana kamar yang hangat dan nyaman.',                     'assets/img/10.webp', 2],
                ['homestay', 'Homestay 3', 'Area santai dengan view alam yang menenangkan.',            'assets/img/8.webp',  3],
                ['homestay', 'Homestay 4', 'Nikmati momen terbangun di atas ketinggian.',              'assets/img/18.webp', 4],
            ];

            $stmt = $this->conn->prepare(
                "INSERT INTO fasilitas (kategori, judul, deskripsi, gambar, urutan) VALUES (?, ?, ?, ?, ?)"
            );
            foreach ($defaults as $row) {
                $stmt->bind_param("ssssi", $row[0], $row[1], $row[2], $row[3], $row[4]);
                $stmt->execute();
            }
        }
    }

    /** Ambil semua fasilitas, dikelompokkan per kategori */
    public function getAllGrouped(): array {
        $grouped = [];
        $result = $this->conn->query(
            "SELECT * FROM fasilitas ORDER BY kategori ASC, urutan ASC"
        );
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $grouped[$row['kategori']][] = $row;
            }
        }
        return $grouped;
    }

    /** Ambil fasilitas berdasarkan kategori */
    public function getByKategori(string $kategori): array {
        $stmt = $this->conn->prepare(
            "SELECT * FROM fasilitas WHERE kategori = ? ORDER BY urutan ASC"
        );
        $stmt->bind_param("s", $kategori);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /** Ambil satu fasilitas by ID */
    public function getById(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM fasilitas WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ?: null;
    }

    /** Update deskripsi & judul (tanpa gambar) */
    public function update(int $id, string $judul, string $deskripsi): bool {
        $stmt = $this->conn->prepare(
            "UPDATE fasilitas SET judul = ?, deskripsi = ? WHERE id = ?"
        );
        $stmt->bind_param("ssi", $judul, $deskripsi, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /** Update gambar saja */
    public function updateGambar(int $id, string $gambarPath): bool {
        $stmt = $this->conn->prepare("UPDATE fasilitas SET gambar = ? WHERE id = ?");
        $stmt->bind_param("si", $gambarPath, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    /** Update lengkap (judul, deskripsi, gambar) */
    public function updateFull(int $id, string $judul, string $deskripsi, string $gambarPath): bool {
        $stmt = $this->conn->prepare(
            "UPDATE fasilitas SET judul = ?, deskripsi = ?, gambar = ? WHERE id = ?"
        );
        $stmt->bind_param("sssi", $judul, $deskripsi, $gambarPath, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
?>
