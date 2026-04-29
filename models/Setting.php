<?php
require_once __DIR__ . '/../config/Database.php';

class Setting {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
        $this->initTable();
    }

    private function initTable() {
        // Create table
        $sql = "CREATE TABLE IF NOT EXISTS settings (
            `key` VARCHAR(50) PRIMARY KEY,
            `value` TEXT NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;";
        $this->conn->query($sql);

        // Insert defaults if empty
        $result = $this->conn->query("SELECT COUNT(*) as count FROM settings");
        if ($result && $result->fetch_assoc()['count'] == 0) {
            $defaults = [
                'hero_title'   => 'Menyatu Dengan Alam, Menyentuh Awan',
                'hero_subtitle'=> 'Rasakan ketenangan di puncak tertinggi Tebing Lonceng, destinasi ekowisata premium di jantung Jawa Barat.',
                'sejarah_text' => "Tebing Lonceng, awalnya dikenal oleh masyarakat lokal sebagai 'Batu Berdering', memiliki sejarah panjang yang membentang lebih dari dua abad.\n\nNama tersebut disematkan karena formasi batuan unik di puncak tebing yang, ketika diterpa angin kencang dari lembah, menghasilkan resonansi rendah menyerupai suara lonceng gereja kuno.",
                'page_visits'  => '0',
                'acc1_title'   => 'Sejarah Singkat',
                'acc1_content' => 'Gunung Lonceng adalah saksi bisu perjuangan di tepian Sungai Mahakam. Dahulu, puncak ini merupakan titik intai strategis para pejuang untuk memantau pergerakan kapal yang masuk ke Samarinda.',
                'acc2_title'   => 'Pemberdayaan Warga',
                'acc2_content' => 'Tempat ini lahir dari semangat gotong royong warga Mangkupalas. Bagi kami, Tebing Lonceng bukan sekadar objek wisata, melainkan rumah bersama untuk tumbuh dan berdaya.',
                'acc3_title'   => 'Pesona Ketinggian',
                'acc3_content' => 'Nikmati cara terbaik melihat Samarinda dari ketinggian. Dengan panorama megah dan berbagai spot foto ikonik, lengkapi petualangan Anda bersama kami.',
                'open_days'    => 'SENIN - MINGGU',
                'open_hours'   => '07.00 - 23.00',
                'why_img1'     => 'assets/img/1.webp',
                'why_img2'     => 'assets/img/2.webp',
                'why_img3'     => 'assets/img/3.webp',
                'ticket_price' => '15.000',
                'ticket_quota' => '100',
            ];
            $stmt = $this->conn->prepare("INSERT IGNORE INTO settings (`key`, `value`) VALUES (?, ?)");
            foreach ($defaults as $k => $v) {
                $stmt->bind_param("ss", $k, $v);
                $stmt->execute();
            }
        } else {
            // Ensure all keys exist for existing databases
            $ensureKeys = [
                'page_visits'  => '0',
                'acc1_title'   => 'Sejarah Singkat',
                'acc1_content' => 'Gunung Lonceng adalah saksi bisu perjuangan di tepian Sungai Mahakam. Dahulu, puncak ini merupakan titik intai strategis para pejuang untuk memantau pergerakan kapal yang masuk ke Samarinda.',
                'acc2_title'   => 'Pemberdayaan Warga',
                'acc2_content' => 'Tempat ini lahir dari semangat gotong royong warga Mangkupalas. Bagi kami, Tebing Lonceng bukan sekadar objek wisata, melainkan rumah bersama untuk tumbuh dan berdaya.',
                'acc3_title'   => 'Pesona Ketinggian',
                'acc3_content' => 'Nikmati cara terbaik melihat Samarinda dari ketinggian. Dengan panorama megah dan berbagai spot foto ikonik, lengkapi petualangan Anda bersama kami.',
                'open_days'    => 'SENIN - MINGGU',
                'open_hours'   => '07.00 - 23.00',
                'why_img1'     => 'assets/img/1.webp',
                'why_img2'     => 'assets/img/2.webp',
                'why_img3'     => 'assets/img/3.webp',
                'ticket_price' => '15.000',
                'ticket_quota' => '100',
            ];
            $stmt = $this->conn->prepare("INSERT IGNORE INTO settings (`key`, `value`) VALUES (?, ?)");
            foreach ($ensureKeys as $k => $v) {
                $stmt->bind_param('ss', $k, $v);
                $stmt->execute();
            }
            $stmt->close();
        }
    }

    public function incrementVisits() {
        $stmt = $this->conn->prepare("UPDATE settings SET value = value + 1 WHERE `key` = 'page_visits'");
        $stmt->execute();
        $stmt->close();
    }

    public function getAll() {
        $settings = [];
        $result = $this->conn->query("SELECT `key`, `value` FROM settings");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $settings[$row['key']] = $row['value'];
            }
        }
        return $settings;
    }

    public function update($key, $value) {
        $stmt = $this->conn->prepare("REPLACE INTO settings (`key`, `value`) VALUES (?, ?)");
        $stmt->bind_param("ss", $key, $value);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}
?>
