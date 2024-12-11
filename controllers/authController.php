<?php
class authController
{
    public $authModel;

    public function __construct()
    {
        $this->authModel = new authModel();
    }

    public function handleRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['action']) && $_POST['action'] === 'register') {
                $this->signUp();
            } elseif (isset($_POST['action']) && $_POST['action'] === 'verify') {
                $this->kiem_tra_ma_xac_thuc();
            }
        }
    }

    public function signUp()
    {
        // var_dump('abc');die;
        if (empty($_POST['email'])) {
            // var_dump('abc');die;
            require './views/auth/signup.php';
            die;
            // var_dump($_POST);die;

            // if ($this->authModel->dangky($name, $email, $password, $passwordConfirm)) {
            //     header("Location: " . BASE_URL . '?act=logIn');
            //     exit();
            // } else {
            //     header("Location: " . BASE_URL . '?act=signUp');
            //     exit();
            // }
        };
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $ma_xac_thuc = $this->authModel->dangky($name, $email, $password, $passwordConfirm);

        if ($ma_xac_thuc) {
            $subject = 'Đăng Ký Tại HAILAM cinemas';
            $content = 'Vui lòng không chia sẽ mã này với bất kỳ ai. Mã xác thực của bạn là: ' . $ma_xac_thuc;
            sendMail($email, $subject, $content);
            // Chuyển đến view xác thực
            require './views/auth/confirmSignUp.php';
        } else {
            $_SESSION['errors']['email'] = "Email đã tồn tại.";
            require './views/auth/signup.php';
        }
    }


    public function kiem_tra_ma_xac_thuc()
    {
        // Lấy mã xác thực từ form
        $code = isset($_POST['ma_xac_thuc']) ? $_POST['ma_xac_thuc'] : null;
        // var_dump($code);die;
        // Kiểm tra mã xác thực có khớp không
        if ($this->authModel->check_ma_xac_thuc($code)) {
            header('location: ' . BASE_URL . '?act=logIn');
            exit();
            // Bạn có thể chuyển hướng hoặc cập nhật trạng thái tài khoản tại đây
        } else {
            echo "Mã xác thực không đúng!";
        }
    }

    public function logIn()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // var_dump($_POST);die;

            $accs = $this->authModel->checkAcc($email, $password);
            // var_dump($accs);die;
            foreach ($accs as $key => $acc) {
                // var_dump($acc['name']);die;
                if ($email = $acc['email'] && $password = $acc['password']) {
                    $_SESSION['user'] = [
                        'id' => $acc['customer_id'],
                        'name' => $acc['name'],
                        'email' => $acc['email'],
                        'chuc_vu' => $acc['chuc_vu_id'],
                        'avata' => $acc['avata']
                    ];
                    if ($_SESSION['user']['chuc_vu'] == 1) {
                        header('Location: ' . BASE_URL_ADMIN . '?act=listMovies');
                        exit();
                    }else{
                        header('Location: ' . BASE_URL);
                        exit();
                    }
                } else {
                    echo "<script> alert('Unsuccessfull') </script>";
                }
            }
        }
        require './views/auth/login.php';
    }

    public function logout()
    {
        if (isset($_SESSION["user"])) {
            unset($SESSION["user"]);
            session_unset();
            session_destroy();
            header("location: " . BASE_URL);
        }
    }
}
