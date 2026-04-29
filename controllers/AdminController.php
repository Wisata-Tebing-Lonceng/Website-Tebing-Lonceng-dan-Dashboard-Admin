<?php
require_once __DIR__ . '/../models/Setting.php';
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/Fasilitas.php';
require_once __DIR__ . '/../models/User.php';

class AdminController {

    private function requireAuth() {
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            header("Location: login.php");
            exit;
        }
    }

    public function overview() {
        $this->requireAuth();

        $reviewModel  = new Review();
        $totalReviews = $reviewModel->countAll();
        $reviews      = $reviewModel->getRecent(5);

        $settingModel = new Setting();
        $settings = $settingModel->getAll();
        $pageVisits = isset($settings['page_visits']) ? $settings['page_visits'] : 0;

        require_once __DIR__ . '/../views/admin/overview.php';
    }
    public function dashboard() {
        $this->requireAuth();
        $settingModel = new Setting();
        $settings = $settingModel->getAll();
        $pageVisits = isset($settings['page_visits']) ? $settings['page_visits'] : 0;

        require_once __DIR__ . '/../views/admin/dashboard.php';
    }

    public function fasilitas() {
        $this->requireAuth();

        $fasilitasModel = new Fasilitas();
        $fasilitas      = $fasilitasModel->getAllGrouped();

        $settingModel = new Setting();
        $settings     = $settingModel->getAll();
        $pageVisits   = isset($settings['page_visits']) ? $settings['page_visits'] : 0;

        require_once __DIR__ . '/../views/admin/fasilitas.php';
    }

    public function reviews() {
        $this->requireAuth();

        $reviewModel = new Review();
        $reviews     = $reviewModel->getAllForAdmin();
        $totalReviews = count($reviews);

        $settingModel = new Setting();
        $settings     = $settingModel->getAll();
        $pageVisits   = isset($settings['page_visits']) ? $settings['page_visits'] : 0;

        require_once __DIR__ . '/../views/admin/reviews.php';
    }

    public function galleries() {
        $this->requireAuth();
        
        require_once __DIR__ . '/../models/Gallery.php';
        $galleryModel = new Gallery();
        $galleries = $galleryModel->getAllForAdmin();

        $settingModel = new Setting();
        $settings     = $settingModel->getAll();
        $pageVisits   = isset($settings['page_visits']) ? $settings['page_visits'] : 0;
        
        require_once __DIR__ . '/../views/admin/galleries.php';
    }

    public function manageGallery() {
        header('Content-Type: application/json');
        
        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        require_once __DIR__ . '/../models/Gallery.php';
        $action = $_POST['action'] ?? '';
        $galleryModel = new Gallery();

        switch ($action) {
            case 'add':
                $caption = trim($_POST['caption'] ?? '');

                if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
                    echo json_encode(['success' => false, 'message' => 'File gambar wajib diunggah.']);
                    exit;
                }

                $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
                $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
                if (!in_array($ext, $allowedExt)) {
                    echo json_encode(['success' => false, 'message' => 'Format file tidak didukung (JPG/PNG/WEBP).']);
                    exit;
                }
                if ($_FILES['gambar']['size'] > 10 * 1024 * 1024) {
                    echo json_encode(['success' => false, 'message' => 'Ukuran file terlalu besar (maks 10 MB).']);
                    exit;
                }

                $uploadDir = __DIR__ . '/../assets/img/galleries/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $newFilename = 'gallery_admin_' . time() . '_' . rand(100, 999) . '.' . $ext;
                $destPath    = $uploadDir . $newFilename;

                if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $destPath)) {
                    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan file.']);
                    exit;
                }

                $imagePath = 'assets/img/galleries/' . $newFilename;
                $newId = $galleryModel->addByAdmin($caption, $imagePath);

                if ($newId) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Foto berhasil ditambahkan.',
                        'gallery' => [
                            'id'         => $newId,
                            'image_path' => $imagePath,
                            'caption'    => $caption,
                            'nama'       => 'Admin',
                            'email'      => '',
                            'status'     => 'approved',
                            'created_at' => date('Y-m-d H:i:s'),
                        ]
                    ]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ke database.']);
                }
                break;

            case 'approve':
            case 'reject':
            case 'delete':
                $id = (int)($_POST['id'] ?? 0);
                if ($id <= 0) {
                    echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
                    exit;
                }
                if ($action === 'approve') {
                    $ok = $galleryModel->updateStatus($id, 'approved');
                    echo json_encode(['success' => $ok, 'message' => $ok ? 'Foto berhasil disetujui.' : 'Gagal menyetujui foto.']);
                } elseif ($action === 'reject') {
                    $ok = $galleryModel->updateStatus($id, 'rejected');
                    echo json_encode(['success' => $ok, 'message' => $ok ? 'Foto berhasil ditolak.' : 'Gagal menolak foto.']);
                } else {
                    $ok = $galleryModel->delete($id);
                    echo json_encode(['success' => $ok, 'message' => $ok ? 'Foto berhasil dihapus.' : 'Gagal menghapus foto.']);
                }
                break;

            default:
                echo json_encode(['success' => false, 'message' => 'Aksi tidak dikenal.']);
        }
    }


    public function manageReview() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $action = $_POST['action'] ?? '';
        $reviewModel = new Review();

        switch ($action) {

            case 'add':
                $nama  = trim($_POST['nama'] ?? '');
                $kesan = trim($_POST['kesan'] ?? '');
                if (empty($nama) || empty($kesan)) {
                    echo json_encode(['success' => false, 'message' => 'Nama dan ulasan wajib diisi.']);
                    exit;
                }
                // Admin manually adding review -> automatically approved
                $result = $reviewModel->addByAdmin($nama, $kesan);
                if ($result) {
                    $reviewModel->updateStatus($result['id'], 'approved');
                    $result['status'] = 'approved';
                    echo json_encode(['success' => true, 'message' => 'Review berhasil ditambahkan.', 'review' => $result]);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Gagal menambahkan review.']);
                }
                break;

            case 'edit':
                $id    = (int)($_POST['id'] ?? 0);
                $nama  = trim($_POST['nama'] ?? '');
                $kesan = trim($_POST['kesan'] ?? '');
                if ($id <= 0 || empty($nama) || empty($kesan)) {
                    echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
                    exit;
                }
                $ok = $reviewModel->update($id, $nama, $kesan);
                echo json_encode([
                    'success' => $ok,
                    'message' => $ok ? 'Review berhasil diperbarui.' : 'Gagal memperbarui review.'
                ]);
                break;

            case 'approve':
                $id = (int)($_POST['id'] ?? 0);
                if ($id <= 0) {
                    echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
                    exit;
                }
                $ok = $reviewModel->updateStatus($id, 'approved');
                echo json_encode(['success' => $ok, 'message' => $ok ? 'Review berhasil disetujui.' : 'Gagal menyetujui review.']);
                break;

            case 'reject':
                $id = (int)($_POST['id'] ?? 0);
                if ($id <= 0) {
                    echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
                    exit;
                }
                $ok = $reviewModel->updateStatus($id, 'rejected');
                echo json_encode(['success' => $ok, 'message' => $ok ? 'Review berhasil ditolak.' : 'Gagal menolak review.']);
                break;

            case 'delete':
                $id = (int)($_POST['id'] ?? 0);
                if ($id <= 0) {
                    echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
                    exit;
                }
                $ok = $reviewModel->delete($id);
                echo json_encode([
                    'success' => $ok,
                    'message' => $ok ? 'Review berhasil dihapus.' : 'Gagal menghapus review.'
                ]);
                break;

            default:
                echo json_encode(['success' => false, 'message' => 'Aksi tidak dikenal.']);
        }
    }

    public function updateFasilitas() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $id       = (int)($_POST['id'] ?? 0);
        $judul    = trim($_POST['judul'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');

        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
            exit;
        }

        $fasilitasModel = new Fasilitas();
        $item = $fasilitasModel->getById($id);

        if (!$item) {
            echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
            exit;
        }

        $gambarPath = $item['gambar'];
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../assets/img/fasilitas/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            if (!in_array($ext, $allowedExt)) {
                echo json_encode(['success' => false, 'message' => 'Format file tidak didukung. Gunakan JPG, PNG, atau WEBP.']);
                exit;
            }

            if ($_FILES['gambar']['size'] > 10 * 1024 * 1024) {
                echo json_encode(['success' => false, 'message' => 'Ukuran file terlalu besar (maks 10 MB).']);
                exit;
            }

            $newFilename = 'fas_' . $id . '_' . time() . '.' . $ext;
            $destPath    = $uploadDir . $newFilename;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $destPath)) {
                if (strpos($item['gambar'], 'assets/img/fasilitas/') !== false) {
                    $oldPath = __DIR__ . '/../' . $item['gambar'];
                    if (file_exists($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $gambarPath = 'assets/img/fasilitas/' . $newFilename;
            } else {
                echo json_encode(['success' => false, 'message' => 'Gagal mengupload gambar.']);
                exit;
            }
        }

        $ok = $fasilitasModel->updateFull($id, $judul, $deskripsi, $gambarPath);

        if ($ok) {
            echo json_encode([
                'success'    => true,
                'message'    => 'Fasilitas berhasil diperbarui.',
                'gambar_url' => $gambarPath
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan ke database.']);
        }
    }

    public function settings() {
        $this->requireAuth();

        $userModel = new User();
        $admin = $userModel->getAdminProfile($_SESSION['admin_username']);

        $settingModel = new Setting();
        $settings     = $settingModel->getAll();
        $pageVisits   = isset($settings['page_visits']) ? $settings['page_visits'] : 0;

        require_once __DIR__ . '/../views/admin/settings.php';
    }

    public function updateAdminProfile() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $oldUsername = $_SESSION['admin_username'];
        $newUsername = trim($_POST['username'] ?? '');
        $password    = $_POST['password'] ?? '';
        
        if (empty($newUsername)) {
            echo json_encode(['success' => false, 'message' => 'Username wajib diisi.']);
            exit;
        }

        $userModel = new User();
        $admin = $userModel->getAdminProfile($oldUsername);
        $profilePic = $admin['profile_pic'];

        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../assets/img/admin/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
            if (!in_array($ext, $allowedExt)) {
                echo json_encode(['success' => false, 'message' => 'Format file tidak didukung.']);
                exit;
            }

            $newFilename = 'admin_' . time() . '.' . $ext;
            $destPath    = $uploadDir . $newFilename;

            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $destPath)) {
                if ($profilePic && strpos($profilePic, 'assets/img/admin/') !== false) {
                    $oldPath = __DIR__ . '/../' . $profilePic;
                    if (file_exists($oldPath)) @unlink($oldPath);
                }
                $profilePic = 'assets/img/admin/' . $newFilename;
            }
        }

        $ok = $userModel->updateAdminProfile($oldUsername, $newUsername, $password, $profilePic);

        if ($ok) {
            $_SESSION['admin_username'] = $newUsername;
            $_SESSION['admin_profile_pic'] = $profilePic;
            echo json_encode([
                'success' => true,
                'message' => 'Profil berhasil diperbarui.',
                'username' => $newUsername,
                'profile_pic' => $profilePic
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui profil. Mungkin username sudah digunakan.']);
        }
    }

    public function updateContent() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $settingModel = new Setting();

        $fields = [
            'hero_title'   => $_POST['hero_title']   ?? '',
            'hero_subtitle'=> $_POST['hero_subtitle'] ?? '',
            'sejarah_text' => $_POST['sejarah_text']  ?? '',
            'acc1_title'   => $_POST['acc1_title']    ?? '',
            'acc1_content' => $_POST['acc1_content']  ?? '',
            'acc2_title'   => $_POST['acc2_title']    ?? '',
            'acc2_content' => $_POST['acc2_content']  ?? '',
            'acc3_title'   => $_POST['acc3_title']    ?? '',
            'acc3_content' => $_POST['acc3_content']  ?? '',
            'open_days'    => $_POST['open_days']     ?? '',
            'open_hours'   => $_POST['open_hours']    ?? '',
            'ticket_price' => $_POST['ticket_price']  ?? '',
            'ticket_price_student' => $_POST['ticket_price_student'] ?? '',
            'ticket_price_child' => $_POST['ticket_price_child'] ?? '',
            'ticket_quota' => $_POST['ticket_quota']  ?? '',
            'hs_title'     => $_POST['hs_title'] ?? '',
            'hs_acc1_title'=> $_POST['hs_acc1_title'] ?? '',
            'hs_acc1_content'=> $_POST['hs_acc1_content'] ?? '',
            'hs_acc2_title'=> $_POST['hs_acc2_title'] ?? '',
            'hs_acc2_content'=> $_POST['hs_acc2_content'] ?? '',
            'hs_acc3_title'=> $_POST['hs_acc3_title'] ?? '',
            'hs_acc3_content'=> $_POST['hs_acc3_content'] ?? '',
            'hs_acc4_title'=> $_POST['hs_acc4_title'] ?? '',
            'hs_acc4_content'=> $_POST['hs_acc4_content'] ?? '',
            'hs_stat_rating'=> $_POST['hs_stat_rating'] ?? '',
            'hs_stat_kabin'=> $_POST['hs_stat_kabin'] ?? '',
            'hs_stat_privasi'=> $_POST['hs_stat_privasi'] ?? '',
            'hs_wa_link'   => $_POST['hs_wa_link'] ?? '',
        ];

        $success = true;
        foreach ($fields as $key => $value) {
            if ($value !== '') {
                $success = $success && $settingModel->update($key, $value);
            }
        }

        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Konten berhasil diperbarui']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui konten']);
        }
    }

    public function updateWhyImage() {
        header('Content-Type: application/json');

        if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
            exit;
        }

        $index = (int)($_POST['image_index'] ?? 0);
        if ($index < 1 || $index > 3) {
            echo json_encode(['success' => false, 'message' => 'Index gambar tidak valid.']);
            exit;
        }

        if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
            echo json_encode(['success' => false, 'message' => 'Gagal menerima file.']);
            exit;
        }

        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
        if (!in_array($ext, $allowedExt)) {
            echo json_encode(['success' => false, 'message' => 'Format file tidak didukung (JPG/PNG/WEBP).']);
            exit;
        }
        if ($_FILES['gambar']['size'] > 8 * 1024 * 1024) {
            echo json_encode(['success' => false, 'message' => 'Ukuran file terlalu besar (maks 8 MB).']);
            exit;
        }

        $uploadDir = __DIR__ . '/../assets/img/why/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $settingKey  = 'why_img' . $index;
        $newFilename = 'why_' . $index . '_' . time() . '.' . $ext;
        $destPath    = $uploadDir . $newFilename;

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $destPath)) {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan file.']);
            exit;
        }

        // Delete old uploaded file (only if it's in assets/img/why/)
        $settingModel = new Setting();
        $allSettings  = $settingModel->getAll();
        $oldPath      = $allSettings[$settingKey] ?? '';
        if (strpos($oldPath, 'assets/img/why/') !== false) {
            $oldFull = __DIR__ . '/../' . $oldPath;
            if (file_exists($oldFull)) @unlink($oldFull);
        }

        $relativePath = 'assets/img/why/' . $newFilename;
        $settingModel->update($settingKey, $relativePath);

        echo json_encode([
            'success'    => true,
            'message'    => 'Gambar berhasil diperbarui.',
            'gambar_url' => $relativePath
        ]);
    }
}
?>

