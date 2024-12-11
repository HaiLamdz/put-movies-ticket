<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';
require_once './controllers/genreControler.php';
require_once './controllers/cinemaController.php';
require_once './controllers/screenController.php';
require_once './controllers/showTimeController.php';

// Require toàn bộ file Models
require_once './models/movies.php';
require_once './models/genres.php';
require_once './models/cinemas.php';
require_once './models/screens.php';
require_once './models/showTimes.php';

// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']); // Kiểm tra giá trị

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    'listMovies' => (new HomeController()) -> home(),
    'insertMovies' => (new HomeController()) -> insertMovies(),
    'detailMovies' => (new HomeController()) -> detailMovies(),
    'updateMovies' => (new HomeController()) -> updateMovies(),
    'updateTrailer' => (new HomeController()) -> updateTrailer(),
    'deleteMovies' => (new HomeController()) -> deleteMovies(),

    'listGenres' => (new genreControler()) -> listGenres(),
    'insertGenres' => (new genreControler()) -> insertGenres(),
    'updateGenres' => (new genreControler()) -> updateGenres(),
    'deleteGenres' => (new genreControler()) -> deleteGenres(),

    'listCinemas' => (new cinemaControler()) -> listCinemas(),
    'insertCinemas' => (new cinemaControler()) -> insertCinemas(),
    'updateCinemas' => (new cinemaControler()) -> updateCinemas(),
    'deleteCinemas' => (new cinemaControler()) -> deleteCinemas(),

    'listScreens' => (new screenController()) -> listScreens(),
    'insertScreens' => (new screenController()) -> insertScreens(),
    'updateScreens' => (new screenController()) -> updateScreens(),
    'deleteScreens' => (new screenController()) -> deleteScreens(),

    'listShowTimes' => (new showTimeController()) -> listShowTimes(),
    'insertShowTimes' => (new showTimeController()) -> insertShowTimes(),
    'updateShowTimes' => (new showTimeController()) -> updateShowTimes(),
    'deleteShowTimes' => (new showTimeController()) -> deleteShowTimes(),
    // route thêm lịch chiếu auto
    'insertShowTimeAutos' => (new showTimeController()) -> insertShowTimeAutos(),

    'seats' => (new screenController()) -> seats(),



};