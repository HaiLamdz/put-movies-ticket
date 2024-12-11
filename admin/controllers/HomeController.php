<?php

class HomeController
{
    public $modelMovies;

    public function __construct()
    {
        $this->modelMovies = new modelMovies();
    }

    public function home()
    {
        $this->modelMovies->updateMovieStatus();
        $listMovie = $this->modelMovies->listMovies();
        // var_dump($listMovie['trailer_url']);
        // var_dump($listMovie);die();
        require_once 'views/movies/listMovie.php';
    }
    public function insertMovies()
    {
        $genres = $this->modelMovies->getAllGenre();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $mota = $_POST['mota'];
            $theLoai = $_POST['theLoai'];
            $thoiLuong = $_POST['thoiLuong'];
            $ngayPhatHanh = $_POST['ngayPhatHanh'];
            $trailer = $_POST['trailer'];
            $daoDien = $_POST['daoDien'];
            $dienVien = $_POST['dienVien'];
            $trangThai = $_POST['trangThai'];

            $hinhAnh = $_FILES['hinhAnh'];

            // var_dump($hinhAnh);
            $file_thumb = uploadFile($hinhAnh, './uploads/');
            // var_dump($name, $mota, $theLoai, $thoiLuong, $ngayPhatHanh, $trailer, $trangThai, $daoDien, $dienVien, $file_thumb);
            // exit();

            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên sản phẩm ko được để trống';
            }
            if (empty($mota)) {
                $errors['mota'] = 'giá sản phẩm ko được để trống';
            }
            if (empty($theLoai)) {
                $errors['theLoai'] = 'Giá khuyễn mãi ko được để trống';
            }
            if (empty($thoiLuong)) {
                $errors['thoiLuong'] = 'Số lượng ko được để trống';
            }
            if (empty($ngayPhatHanh)) {
                $errors['ngayPhatHanh'] = 'Ngày nhập ko được để trống';
            }
            if (empty($trailer)) {
                $errors['trailer'] = 'danh mục  ko được để trống';
            }
            if (empty($daoDien)) {
                $errors['daoDien'] = 'trạng thái ko được để trống';
            }
            if (empty($dienVien)) {
                $errors['dienVien'] = 'trạng thái ko được để trống';
            }
            if (empty($hinhAnh['name'])) {
                $errors['hinhAnh'] = 'hinhf anhr sp ko được để trống';
            }

            // $_SESSION['errors'] = $errors;
            // Nếu có lỗi, lưu thông báo lỗi vào session
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=insertMovies');
                exit();
            }

            if ($this->modelMovies->insertMovies($name, $mota, $theLoai, $thoiLuong, $ngayPhatHanh, $trailer, $trangThai, $daoDien, $dienVien, $file_thumb)) {
                header("location: " . BASE_URL_ADMIN . '?act=listMovies');
                exit;
            } else {
                var_dump('Ko thanh cong');
            }
        }
        require_once 'views/movies/insertMovie.php';
    }

    public function detailMovies()
    {
        $movie_id = $_GET['movie_id'];
        $movies = $this->modelMovies->detailMovies($movie_id);
        $listMovie = $this->modelMovies->listMovies();
        // var_dump($movies['title']);die();
        require_once 'views/movies/detailMovie.php';
    }
    public function updateMovies()
    {
        $movie_id = $_GET['movie_id'];
        $movies = $this->modelMovies->detailMovies($movie_id);
        $genres = $this->modelMovies->getAllGenre();
        $Old_file = $movies['poster_url'];
        // var_dump($genres);die;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $genre = $_POST['genre'];
            $status = $_POST['status'];
            $description = $_POST['description'];
            $file_thumb = $Old_file;
            if (empty($_FILES['poster']['name'])) {
                $poster = "";
            } else {
                $poster = $_FILES['poster'];
                //lưu hình ảnh vào 
                $file_thumb = uploadFile($poster, './uploads/');
                // nếu có ảnh mới thì xóa ảnh cũ
                if (!empty($Old_file)) {
                    deleteFile($Old_file);
                }
            }
            // var_dump($_POST);die;
            // var_dump($title, $poster, $genre, $status, $description);die;
            $errors = [];
            if (empty($title)) {
                $errors['title'] = 'Tên sản phẩm ko được để trống';
            }
            if (empty($description)) {
                $errors['description'] = 'giá sản phẩm ko được để trống';
            }

            // $_SESSION['errors'] = $errors;
            // Nếu có lỗi, lưu thông báo lỗi vào session
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=insertMovies');
                exit();
            }
            if ($this->modelMovies->editMovies($movie_id, $title, $file_thumb, $genre, $status, $description)) {
                header("location: " . BASE_URL_ADMIN . '?act=listMovies');
                exit();
            } else {
                header("location: " . BASE_URL_ADMIN . '?act=updateMovies&movie_id=' . $movie_id);
            }
        }
        require_once 'views/movies/updateMovie.php';
    }

    function updateTrailer()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $movie_id = $_POST['movie_id'];
            // var_dump($movie_id);
            // die;
            $trailer = $_POST['trailer'];
            if($trailer){
                $this->modelMovies->editTrailer($movie_id, $trailer);
                header("location: " . BASE_URL_ADMIN . '?act=updateMovies&movie_id=' . $movie_id);
                exit();
            }else{
                header("location: " . BASE_URL_ADMIN . '?act=updateMovies&movie_id=' . $movie_id);
                exit();
            }
        }
    }

    public function deleteMovies()
    {
        $movie_id = $_GET['movie_id'];
        $movies = $this->modelMovies->detailMovies($movie_id);
        if ($movies) {

            deleteFile($movies['poster_url']);

            $this->modelMovies->destroyMovies($movie_id);
            header("location: " . BASE_URL_ADMIN . '?act=listMovies');
            exit();
        }
    }
}
