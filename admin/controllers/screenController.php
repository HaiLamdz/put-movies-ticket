<?php
class screenController
{
    public $modelScreen;

    public function __construct()
    {
        $this->modelScreen = new modelScreen();
    }
    public function listScreens()
    {
        $listScreens = $this->modelScreen->listScreen();
        // var_dump($listScreens);die;
        require_once 'views/screens/listScreen.php';
    }

    public function insertScreens()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $screen = $_POST["screen"];
            $seat = $_POST["seat"];
            $cinema = $_POST["cinema"];

            // var_dump($_POST);die;

            $errors = [];
            if (empty($screen)) {
                $errors['screen'] = 'Tên thể loại không được để trống';
            }
            if (empty($seat)) {
                $errors['seat'] = 'Tên thể loại không được để trống';
            }
            if (empty($cinema)) {
                $errors['cinema'] = 'Tên thể loại không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=insertScreens');
                exit();
            }


            if ($this->modelScreen->insertScreen($cinema, $screen, $seat)) {
                header("Location: " . BASE_URL_ADMIN . '?act=listScreens');
                exit();
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=insertScreens');
                exit();
            }
        }

        require_once 'views/screens/insertScreen.php';
    }

    public function updateScreens()
    {
        ob_start();
        // dlấy ra thông tin danh mục cần sửa
        $screen_id = $_GET['screen_id'];
        $screen = $this->modelScreen->detailScreen($screen_id);
        // var_dump($Cinema);die();
        if ($screen) {
            require_once 'views/screens/updateScreen.php';
        } else {
            header("location: " . BASE_URL_ADMIN . '?act=listScreens');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $screen_id  = $_POST['screen_id'];
            $screen_name = $_POST["screen_name"];
            $seat_capacity = $_POST["seat_capacity"] ?? " ";
            $cinema_id = $_POST["cinema_id"] ?? " ";
            // var_dump($_POST);die;
            $errors = [];
            if (empty($screen_name)) {
                $errors['screen_name'] = 'Tên thể loại không được để trống';
            }
            if (empty($seat_capacity)) {
                $errors['seat_capacity'] = 'Tên thể loại không được để trống';
            }
            if (empty($cinema_id)) {
                $errors['cinema_id'] = 'Tên thể loại không được để trống';
            }

            if ($this->modelScreen->editScreen($screen_id , $screen_name, $seat_capacity, $cinema_id)) {
                header("location: " . BASE_URL_ADMIN . '?act=listScreens');
                exit();
            } else {
                // trả về form
                $Cinema = ['screen_id' => $screen_id, 'screen_name' => $screen_name, 'seat_capacity' => $seat_capacity , 'cinema_id' => $cinema_id];
                require_once 'views/Cinema/updateScreen.php';
            }
        }
    }

    public function deleteScreens()
    {
        $screen_id  = $_GET['screen_id'];
        $cinema = $this->modelScreen->detailScreen($screen_id);

        if ($cinema) {
            $this->modelScreen->destroyScreen($screen_id);
            header("location: " . BASE_URL_ADMIN . '?act=listScreens');
            exit();
        } else {
            echo '<script> alert(không xóa đc thể loại phim) </script>';
            header("location: " . BASE_URL_ADMIN . '?act=listScreens');
            exit();
        }
    }

    public function seats (){
        header('Content-Type: application/json'); // Thiết lập header để phản hồi là JSON
        $screen_id = $_GET['screen_id'] ?? null;
        if ($screen_id) {
            // Giả sử bạn lấy danh sách phim từ cơ sở dữ liệu dựa trên cinema_id
            $getSeats = $this->modelScreen->getAllSeat($screen_id);   // Hàm giả lấy phim từ DB
            echo json_encode($getSeats); // Trả về JSON
        } else {
            echo json_encode([]); // Trả về mảng trống nếu không có cinema_id
        }
    }
    
}
