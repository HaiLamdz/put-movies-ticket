<?php
class showTimeController
{
    public $modelShowTime;
    public $modelMovies;
    public $modelScreen;
    public $modelCinema;

    public function __construct()
    {
        $this->modelShowTime = new modelShowTime();
        $this->modelMovies = new modelMovies();
        $this->modelScreen = new modelScreen();
        $this->modelCinema = new modelCinema();
    }

    // Thêm lịch chiếu auto
    public function insertShowTimeAutos() {
        if($this->modelShowTime->insertShowTimeAuto()){
            header('Location: ' . BASE_URL_ADMIN . '?act=listShowTimes');
            exit();
        }
    }

    public function listShowTimes()
    {
        $this->modelShowTime->updateShowtimeStatus();
        $listShowTimes = $this->modelShowTime->listShowTime();
        // var_dump($listShowTimes);die;
        require_once 'views/showTimes/listShowTime.php';
    }

    public function insertShowTimes()
    {
        $listMovies = $this->modelMovies->listMoviesOfDay();
        $listCinemas = $this->modelCinema->listCinema();
        $listScreens = $this->modelScreen->listScreen();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $movie = $_POST["movie"];
            $cinema = $_POST["cinema"];
            $screen = $_POST["screen"];
            $show_date = $_POST["show_date"];
            $show_time = $_POST["show_time"];
            $status = $_POST["status"];

            // var_dump($_POST);die;

            $errors = [];
            if (empty($movie)) {
                $errors['movie'] = 'Tên thể loại không được để trống';
            }
            if (empty($cinema)) {
                $errors['cinema'] = 'Tên thể loại không được để trống';
            }
            if (empty($screen)) {
                $errors['screen'] = 'Tên thể loại không được để trống';
            }
            if (empty($show_date)) {
                $errors['show_date'] = 'Tên thể loại không được để trống';
            }
            if (empty($show_time)) {
                $errors['show_time'] = 'Tên thể loại không được để trống';
            }
            if (empty($status)) {
                $errors['status'] = 'Tên thể loại không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=insertShowTimes');
                exit();
            }


            if ($this->modelShowTime->insertShowTime($movie, $cinema, $screen, $show_date, $show_time, $status)) {
                header("Location: " . BASE_URL_ADMIN . '?act=listShowTimes');
                exit();
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=insertShowTimes');
                exit();
            }
        }
        require_once 'views/showTimes/insertShowTime.php';
    }

    public function updateShowTimes()
    {
        $showtime_id = $_GET['showtime_id'];
        // var_dump($showtime_id);die;
        $showTimes = $this->modelShowTime->detailShowTime($showtime_id);
        $listMovies = $this->modelMovies->listMovies();
        $listCinemas = $this->modelCinema->listCinema();
        $listScreens = $this->modelScreen->listScreen();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $movie = $_POST["movie"];
            $cinema = $_POST["cinema"];
            $screen = $_POST["screen"];
            $show_date = $_POST["show_date"];
            $show_time = $_POST["show_time"];
            $status = $_POST["status"];

            // var_dump($_POST);die;

            $errors = [];
            if (empty($movie)) {
                $errors['movie'] = 'Tên thể loại không được để trống';
            }
            if (empty($cinema)) {
                $errors['cinema'] = 'Tên thể loại không được để trống';
            }
            if (empty($screen)) {
                $errors['screen'] = 'Tên thể loại không được để trống';
            }
            if (empty($show_date)) {
                $errors['show_date'] = 'Tên thể loại không được để trống';
            }
            if (empty($show_time)) {
                $errors['show_time'] = 'Tên thể loại không được để trống';
            }
            if (empty($status)) {
                $errors['status'] = 'Tên thể loại không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=updateShowTimes');
                exit();
            }


            if ($this->modelShowTime->updateShowTime($showtime_id ,$movie, $cinema, $screen, $show_date, $show_time, $status)) {
                header("Location: " . BASE_URL_ADMIN . '?act=listShowTimes');
                exit();
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=updateShowTimes');
                exit();
            }
        }
        require_once 'views/showTimes/updateShowTime.php';
    }

    public function deleteShowTimes()
    {
        $showtime_id = $_GET['showtime_id'];
        $showtime = $this->modelShowTime->detailShowTime($showtime_id);

        if ($showtime) {
            $this->modelShowTime->destroyShowTime($showtime_id);
            header("location: " . BASE_URL_ADMIN . '?act=listShowTimes');
            exit();
        } else {
            echo '<script> alert(không xóa đc lịch chiếu phim) </script>';
            header("location: " . BASE_URL_ADMIN . '?act=listShowTimes');
            exit();
        }
    }
}
