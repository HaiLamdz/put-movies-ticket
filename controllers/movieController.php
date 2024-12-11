<?php
class movieController
{
    public $movieModel;
    public $genreModel;
    public $homeModel;

    public function __construct()
    {
        $this->movieModel = new movieModel();
        $this->genreModel = new genreModel();
        $this->homeModel = new homeModel();
    }

    public function detailMovies()
    {
        $movie_id = $_GET['movie_id'];
        $genres = $this->genreModel->getAllGenre();
        $detailMovies = $this->movieModel->detailMovie($movie_id);
        $listBinhLuans= $this->movieModel->getAllBinhLuan($movie_id);
        $latestMovies = $this->movieModel->latestMovie();
        // var_dump($listBinhLuans);die;

        require_once 'views/detailMovies/detailMovie.php';
    }

    public function insertComment()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $movies = $_POST['movie'];
            $custumers = $_SESSION['user']['id'];
            $comment = $_POST['content'];
            $rating = $_POST['rating'];
            // var_dump($_POST);die;
            if ($this->movieModel->insertBinhLuan($movies, $custumers, $rating, $comment)) {
                header('Location: ' . BASE_URL . '?act=detailMovies&movie_id=' . $movies);
                exit();
            } else {
                echo 'loi khong the them binh luan';
                header('Location: ' . BASE_URL . '?act=detailMovies&movie_id=' . $movies);
            }
        }
    }

    public function movieOfgenre(){
        $genre_id = $_GET['genre_id'];
        $genres = $this->genreModel->getAllGenre();
        $GenreOfId = $this->genreModel->getGenreOfId($genre_id);
        $movieOfGenres = $this->movieModel->movieOfGenre($genre_id);
        // var_dump($movieOfGenres);die;
        require_once './views/movies/movieOfgenre.php';
    }
}
