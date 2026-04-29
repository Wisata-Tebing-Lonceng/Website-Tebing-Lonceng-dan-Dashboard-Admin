<?php
// admin_overview.php — entry point untuk Dashboard Overview
session_start();
require_once __DIR__ . '/../controllers/AdminController.php';

$controller = new AdminController();
$controller->overview();
?>
