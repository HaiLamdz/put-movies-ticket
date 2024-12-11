<?php 
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ
require_once './commons/phpmailer/PHPMailer.php'; // Hàm hỗ trợ
require_once './commons/phpmailer/Exception.php'; // Hàm hỗ trợ
require_once './commons/phpmailer/SMTP.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/movieController.php';
require_once './controllers/authController.php';
require_once './controllers/acountController.php';
require_once './controllers/putMovieController.php';

// Require toàn bộ file Models
require_once './models/homeModel.php';
require_once './models/movieModel.php';
require_once './models/genreModel.php';
require_once './models/authModel.php';
require_once './models/accModel.php';
require_once './models/putMovieModel.php';
require_once './models/cinemaModel.php';

// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']); // Kiểm tra giá trị

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
$controller =  new authController();
$controller->handleRequest();
match ($act) {
    // Trang chủ
    '/' => (new HomeController()) -> home(),

    
    'myAccount' => (new accountController()) -> myAccount(), 
    'update_Account' => (new accountController()) -> update_Account(), 

    'signUp' => (new authController()) -> signUp(),
    'logIn' => (new authController()) -> logIn(),
    'logout' => (new authController()) -> logout(),
    'verify' => (new authController())->kiem_tra_ma_xac_thuc(),

    'detailMovies' => (new movieController()) -> detailMovies(),
    'insertComment' => (new movieController()) -> insertComment(),
    'movieOfgenre' => (new movieController())-> movieOfgenre(),

    'putMovies' => (new putMovieController()) -> putMovies(),
    'getMovies' => (new putMovieController()) -> getMovies(),
    'showtimes' => (new putMovieController()) -> showtimes(),
    'putMovieNow' => (new putMovieController()) -> putMovieNow(),
    'seats' => (new putMovieController()) -> seats(),

};