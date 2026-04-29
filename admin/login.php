<?php
session_start();
require_once __DIR__ . '/../controllers/AuthController.php';

$controller = new AuthController();

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    $controller->adminLogout();
}

$controller->adminLoginForm();
?>
