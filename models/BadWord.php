<?php
require_once __DIR__ . '/../config/Database.php';

class BadWord {
    private $conn;

    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        $badWordsList = [];
        $result = $this->conn->query("SELECT word FROM bad_words");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $badWordsList[] = strtolower($row['word']);
            }
        }
        return $badWordsList;
    }
}
?>
