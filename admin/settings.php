<?php
// admin_settings.php — entry point untuk Pengaturan Akun
session_start();
require_once __DIR__ . '/../controllers/AdminController.php';

$controller = new AdminController();
$controller->settings();
?>
