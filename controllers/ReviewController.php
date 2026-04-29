<?php
require_once __DIR__ . '/../models/Review.php';

class ReviewController {
    
    public function add() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false, 'message' => 'Silakan login terlebih dahulu.']);
            exit;
        }

        $kesan = trim($_POST['kesan'] ?? '');
        if (empty($kesan)) {
            echo json_encode(['success' => false, 'message' => 'Ulasan tidak boleh kosong.']);
            exit;
        }

        $userId = $_SESSION['user_id'];
        $nama   = $_SESSION['user_nama'];

        $reviewModel = new Review();
        $success = $reviewModel->addReview($userId, $nama, $kesan);

        if ($success) {
            echo json_encode([
                'success' => true,
                'review'  => [
                    'nama'  => $nama,
                    'kesan' => htmlspecialchars($kesan)
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ulasan.']);
        }
    }
}
?>
