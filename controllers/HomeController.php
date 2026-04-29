<?php
require_once __DIR__ . '/../models/Review.php';
require_once __DIR__ . '/../models/BadWord.php';
require_once __DIR__ . '/../models/Setting.php';
require_once __DIR__ . '/../models/Fasilitas.php';

class HomeController {
    public function index() {
        $reviewModel = new Review();
        $reviews = $reviewModel->getAllReviews();

        $badWordModel = new BadWord();
        $badWordsList = $badWordModel->getAll();

        $settingModel = new Setting();
        $settings = $settingModel->getAll();

        $fasilitasModel  = new Fasilitas();
        $fasilitasGrouped = $fasilitasModel->getAllGrouped();

        $settingModel->incrementVisits();

        require_once __DIR__ . '/../views/user/home.php';
    }
}
?>
