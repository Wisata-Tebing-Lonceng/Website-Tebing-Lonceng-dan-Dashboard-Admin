<?php
session_start();
require_once __DIR__ . '/../../controllers/ReviewController.php';

$controller = new ReviewController();
$controller->add();
?>