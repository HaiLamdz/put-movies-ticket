<?php
class genreControler
{
    public $modelGenre;

    public function __construct()
    {
        $this->modelGenre = (new modelGenre);
    }

    public function listGenres()
    {
        $genres = $this->modelGenre->getAllGenre();
        require_once 'views/genre/listGenre.php';
    }
    public function insertGenres()
    {
        ob_start();
        require_once 'views/genre/insertGenre.php';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $name = $_POST["name"];
            $mota = $_POST["mota"];
            //validate
            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên thể loại không được để trống';
            }
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=insertGenres');
                exit();
            }


            if ($this->modelGenre->addGenre($name, $mota)) {
                header("Location: " . BASE_URL_ADMIN . '?act=listGenres');
                exit();
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=insertGenres');
                exit();
            }
        }
    }

    public function updateGenres(){
        ob_start();
        // dlấy ra thông tin danh mục cần sửa
        $genre_id = $_GET['genre_id'];
        $genre = $this->modelGenre->detailGenre($genre_id);
        // var_dump($genre);die();
        if($genre){
            require_once 'views/genre/updateGenre.php';    
        }else{
            header("location: " . BASE_URL_ADMIN . '?act=listGenres');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $genre_id = $_POST['genre_id'];
            $name = $_POST["name"];
            $mota = $_POST["mota"] ?? " ";
            // var_dump($_POST);die;
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên danh mục ko dcd để trống';
            }

            if ( $this->modelGenre->editGenre($genre_id, $name, $mota)) {
                header("location: " . BASE_URL_ADMIN . '?act=listGenres');
                exit();
            }else{
                // trả về form
                $genre = ['genre_id' => $genre_id, 'name' => $name, 'mota'=>$mota];
                require_once 'views/genre/updateGenre.php';
            }
        }
    }
    
    public function deleteGenres(){
        // ob_start();
        $genre_id = $_GET['genre_id'];
        $danhmuc = $this->modelGenre->detailGenre($genre_id);

        if($danhmuc){
            $this->modelGenre->destroyGenres($genre_id);
            header("location: " . BASE_URL_ADMIN . '?act=listGenres');
            exit();
        }else{
           echo '<script> alert(không xóa đc thể loại phim) </script>';
           header("location: " . BASE_URL_ADMIN . '?act=listGenres');
            exit();
        }
    }
}
