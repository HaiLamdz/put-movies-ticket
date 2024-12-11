<?php
class cinemaControler
{
    public $modelCinema;

    public function __construct()
    {
        $this->modelCinema = new modelCinema();
    }

    public function listCinemas()
    {
        $listCinemas = $this->modelCinema->listCinema();
        require_once 'views/cinemas/listCinema.php';
    }

    public function insertCinemas()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $name = $_POST["name"];
            $address = $_POST["address"];
            $city = $_POST["city"];
            $phone_number = $_POST["phone_number"];

            
            $hinhAnh = $_FILES["hinhAnh"] ?? "";

            // var_dump($hinhAnh);
            
            // var_dump($hinhAnh);die;
            $file_thumb = uploadFile($hinhAnh, './uploads/');

            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên thể loại không được để trống';
            }
            if (empty($address)) {
                $errors['address'] = 'Tên thể loại không được để trống';
            }
            if (empty($city)) {
                $errors['city'] = 'Tên thể loại không được để trống';
            }
            if (empty($phone_number)) {
                $errors['phone_number'] = 'Tên thể loại không được để trống';
            }
            if (empty($hinhAnh)) {
                $errors['hinhAnh'] = 'Ảnh thể loại không được để trống';
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: " . BASE_URL_ADMIN . '?act=insertCinemas');
                exit();
            }


            if ($this->modelCinema->insertCinema($name, $file_thumb,  $address, $city, $phone_number)) {
                header("Location: " . BASE_URL_ADMIN . '?act=listCinemas');
                exit();
            } else {
                header("Location: " . BASE_URL_ADMIN . '?act=insertCinemas');
                exit();
            }
        }

        require_once 'views/cinemas/insertCinema.php';
    }

    public function updateCinemas()
    {
        ob_start();
        // dlấy ra thông tin danh mục cần sửa
        $cinema_id = $_GET['cinema_id'];
        $cinema = $this->modelCinema->detailCinema($cinema_id);
        // var_dump($Cinema);die();
        $Old_file = $cinema['image_cinema'];
        if ($cinema) {
            require_once 'views/cinemas/updateCinema.php';
        } else {
            header("location: " . BASE_URL_ADMIN . '?act=listCinemas');
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dwuc liệu
            $cinema_id = $_POST['cinema_id'];
            $name = $_POST["name"];
            $address = $_POST["address"] ?? " ";
            $city = $_POST["city"] ?? " ";
            $phone_number = $_POST["phone_number"] ?? " ";
            $file_thumb = $Old_file;
            if (empty($_FILES['hinhAnh']['name'])) {
                $hinhAnh = "";
            } else {
                $hinhAnh = $_FILES['hinhAnh'];
                //lưu hình ảnh vào 
                $file_thumb = uploadFile($hinhAnh, './uploads/');
                // nếu có ảnh mới thì xóa ảnh cũ
                if (!empty($Old_file)) {
                    deleteFile($Old_file);
                }
            }
            // var_dump($_POST);die;
            $errors = [];
            if (empty($name)) {
                $errors['name'] = 'Tên thể loại không được để trống';
            }
            if (empty($address)) {
                $errors['address'] = 'Tên thể loại không được để trống';
            }
            if (empty($city)) {
                $errors['city'] = 'Tên thể loại không được để trống';
            }
            if (empty($phone_number)) {
                $errors['phone_number'] = 'Tên thể loại không được để trống';
            }

            if ($this->modelCinema->editCinema($cinema_id, $name, $file_thumb, $address, $city, $phone_number)) {
                header("location: " . BASE_URL_ADMIN . '?act=listCinemas');
                exit();
            } else {
                // trả về form
                $Cinema = ['cinema_id' => $cinema_id, 'name' => $name, 'address' => $address];
                require_once 'views/Cinema/updateCinema.php';
            }
        }
    }

    public function deleteCinemas()
    {
        $cinema_id = $_GET['cinema_id'];
        $cinema = $this->modelCinema->detailCinema($cinema_id);

        if ($cinema) {
            $this->modelCinema->destroyCinemas($cinema_id);
            header("location: " . BASE_URL_ADMIN . '?act=listCinemas');
            exit();
        } else {
            echo '<script> alert(không xóa đc thể loại phim) </script>';
            header("location: " . BASE_URL_ADMIN . '?act=listCinemas');
            exit();
        }
    }
}
