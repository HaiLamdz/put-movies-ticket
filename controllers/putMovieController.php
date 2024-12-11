<?php
class putMovieController
{
    public $putMovieModel;
    public $cinemaModel;
    public $movieModel;
    public $genreModel;

    public function __construct()
    {
        $this->putMovieModel = new putMovieModel();
        $this->cinemaModel = new cinemaModel();
        $this->movieModel = new movieModel();
        $this->genreModel = new genreModel();
    }

    public function putMovies()
    {
        $listCinemas = $this->cinemaModel->getAllCinema();
        $listMovies = $this->cinemaModel->getAllCinema();
        // var_dump($listCinemas);die;
        require_once './views/put-movies/putMovie.php';
    }

    public function getMovies()
    {
        header('Content-Type: application/json'); // Thiết lập header để phản hồi là JSON
        $cinema_id = $_GET['cinema_id'] ?? null;
        if ($cinema_id) {
            // Giả sử bạn lấy danh sách phim từ cơ sở dữ liệu dựa trên cinema_id
            $getMovies = $this->putMovieModel->getMovie($cinema_id);            // Hàm giả lấy phim từ DB
            echo json_encode($getMovies); // Trả về JSON
        } else {
            echo json_encode([]); // Trả về mảng trống nếu không có cinema_id
        }
    }

    public function showtimes() {
        header('Content-Type: application/json'); // Thiết lập header để phản hồi là JSON
        $cinema_id = $_GET['cinema_id'] ?? null;
        $movie_id = $_GET['movie_id'] ?? null;
        if ($cinema_id && $movie_id) {
            // Giả sử bạn lấy danh sách phim từ cơ sở dữ liệu dựa trên cinema_id
            $showtimes = $this->putMovieModel->showtime($cinema_id, $movie_id); // Hàm giả lấy phim từ DB
            // var_dump($showtimes);die;
            echo json_encode($showtimes); // Trả về JSON
        } else {
            echo json_encode([]); // Trả về mảng trống nếu không có cinema_id
        }
    }

    public function putMovieNow() {
        $cinema_id = $_GET['cinema_id'];
        $movie_id = $_GET['movie_id'];
        $showtime_id = $_GET['showtime_id'];
        // var_dump($_GET);
        $genres = $this->genreModel->getAllGenre();
        $detailMovies = $this->movieModel->detailMovie($movie_id);
        $listScreens = $this->putMovieModel->listScreen();
        // var_dump($listScreens);die;
        require_once './views/put-movies/putMovieNow.php';

        
    }

    
    public function seats (){
        header('Content-Type: application/json'); // Thiết lập header để phản hồi là JSON
        $screen_id = $_GET['screen_id'] ?? null;
        if ($screen_id) {
            // Giả sử bạn lấy danh sách phim từ cơ sở dữ liệu dựa trên cinema_id
            $getSeats = $this->putMovieModel->getAllSeat($screen_id);   // Hàm giả lấy phim từ DB
            echo json_encode($getSeats); // Trả về JSON
        } else {
            echo json_encode([]); // Trả về mảng trống nếu không có cinema_id
        }
    }
}
