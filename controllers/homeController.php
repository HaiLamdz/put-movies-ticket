<?php
    class homeController{
        public $homeModel;
        public $genreModel;

        public function __construct()
        {
            $this->homeModel = new homeModel();
            $this->genreModel = new genreModel();
        }

        public function home(){
        $listMovie = $this->homeModel->listMovies();
        $genres = $this->genreModel->getAllGenre();
        $movieShowings = $this->homeModel->movieShowing();
        $CommingSoons = $this->homeModel->CommingSoon();
        // var_dump($movieShowings);die;
            require_once 'views/home/homePage.php';
        }
    }
?>