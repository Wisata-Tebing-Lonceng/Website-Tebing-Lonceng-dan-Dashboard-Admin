<?php
// actions/user/upload_galeri.php
session_start();
require_once '../../config/Database.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Anda harus login untuk mengunggah foto.']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
    exit;
}

if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['status' => 'error', 'message' => 'Tidak ada file yang diunggah atau terjadi kesalahan saat mengunggah.']);
    exit;
}

$file = $_FILES['foto'];
$caption = isset($_POST['caption']) ? trim($_POST['caption']) : null;
$userId = $_SESSION['user_id'];

// Validasi ukuran (Max 5MB)
if ($file['size'] > 5 * 1024 * 1024) {
    echo json_encode(['status' => 'error', 'message' => 'Ukuran foto maksimal 5MB.']);
    exit;
}

// Validasi tipe file
$allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimeType = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);

if (!in_array($mimeType, $allowedTypes)) {
    echo json_encode(['status' => 'error', 'message' => 'Tipe file tidak didukung. Harap unggah format JPG, PNG, atau WEBP.']);
    exit;
}

// Persiapkan direktori
$uploadDir = '../../assets/img/galeri/';
if (!file_exists($uploadDir)) {
    if (!mkdir($uploadDir, 0777, true)) {
        echo json_encode(['status' => 'error', 'message' => 'Gagal membuat direktori unggahan.']);
        exit;
    }
}

// Generate nama file unik
$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
$filename = uniqid('gallery_') . '_' . time() . '.' . $extension;
$destination = $uploadDir . $filename;
$dbPath = 'assets/img/galeri/' . $filename;

// Pindahkan file
if (!move_uploaded_file($file['tmp_name'], $destination)) {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan foto.']);
    exit;
}

// Simpan ke database
$conn = Database::getConnection();
$stmt = $conn->prepare("INSERT INTO galleries (user_id, image_path, caption, status) VALUES (?, ?, ?, 'pending')");
$stmt->bind_param("iss", $userId, $dbPath, $caption);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Foto berhasil diunggah dan menunggu persetujuan.']);
} else {
    // Jika gagal insert ke DB, hapus file yang sudah terunggah
    unlink($destination);
    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
}

$stmt->close();
$conn->close();
?>
