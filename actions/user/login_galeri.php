<?php
session_start();
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../models/User.php';

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$redirect = '../../views/user/galeri.php';

if (empty($email) || empty($password)) {
    $_SESSION['galeri_auth_error'] = "Email dan password wajib diisi.";
    header("Location: $redirect");
    exit;
}

$userModel = new User();
$user      = $userModel->findByEmail($email);

if ($user) {
    if ($user['password'] && password_verify($password, $user['password'])) {
        $_SESSION['user_id']      = $user['id'];
        $_SESSION['user_nama']    = $user['nama'];
        $_SESSION['user_email']   = $email;
        $_SESSION['login_method'] = 'email';
        unset($_SESSION['galeri_auth_error']);
    } else {
        $_SESSION['galeri_auth_error'] = "Password salah.";
    }
} else {
    // Auto-register jika email belum terdaftar
    if (strlen($password) < 6) {
        $_SESSION['galeri_auth_error'] = "Password minimal 6 karakter.";
        header("Location: $redirect");
        exit;
    }
    $nama    = ucfirst(explode('@', $email)[0]);
    $newUser = $userModel->createUser($nama, $email, $password);

    if ($newUser) {
        $_SESSION['user_id']      = $newUser['id'];
        $_SESSION['user_nama']    = $newUser['nama'];
        $_SESSION['user_email']   = $newUser['email'];
        $_SESSION['login_method'] = 'email';
        unset($_SESSION['galeri_auth_error']);
    } else {
        $_SESSION['galeri_auth_error'] = "Gagal mendaftar. Coba lagi.";
    }
}

header("Location: $redirect");
exit;
