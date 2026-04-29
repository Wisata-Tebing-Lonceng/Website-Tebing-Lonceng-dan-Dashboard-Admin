<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    
    public function userLogin() {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['auth_error'] = "Email dan password wajib diisi.";
            header("Location: ../../index.php#reviews");
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user) {
            // Email sudah ada -> login
            if ($user['password'] && password_verify($password, $user['password'])) {
                $_SESSION['user_id']      = $user['id'];
                $_SESSION['user_nama']    = $user['nama'];
                $_SESSION['user_email']   = $email;
                $_SESSION['login_method'] = 'email';
            } else {
                $_SESSION['auth_error'] = "Password salah.";
            }
        } else {
            // Email belum ada -> daftar otomatis + login
            if (strlen($password) < 6) {
                $_SESSION['auth_error'] = "Password minimal 6 karakter.";
                header("Location: ../../index.php#reviews");
                exit;
            }
            $nama = ucfirst(explode('@', $email)[0]);
            $newUser = $userModel->createUser($nama, $email, $password);
            
            if ($newUser) {
                $_SESSION['user_id']      = $newUser['id'];
                $_SESSION['user_nama']    = $newUser['nama'];
                $_SESSION['user_email']   = $newUser['email'];
                $_SESSION['login_method'] = 'email';
            } else {
                $_SESSION['auth_error'] = "Gagal mendaftar pengguna baru.";
            }
        }

        header("Location: ../../index.php#reviews");
        exit;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../../index.php");
        exit;
    }

    public function adminLogout() {
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_username']);
        unset($_SESSION['admin_profile_pic']);
        header("Location: login.php");
        exit;
    }

    public function adminLoginForm() {
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            header("Location: overview.php");
            exit;
        }
        require_once __DIR__ . '/../views/admin/login.php';
    }

    public function adminLogin() {
        header('Content-Type: application/json');

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'message' => 'Username dan password wajib diisi.']);
            exit;
        }

        $userModel = new User();
        if ($userModel->verifyAdmin($username, $password)) {
            $admin = $userModel->getAdminProfile($username);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_profile_pic'] = $admin['profile_pic'];
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Username atau password salah!']);
        }
    }
}
?>
