<?php
// aksi_reviews.php
session_start();
require_once __DIR__ . '/../../controllers/AdminController.php';

$controller = new AdminController();
$controller->manageReview();
?>
