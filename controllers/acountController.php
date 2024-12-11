<?php
class accountController
{
    public $accModel;

    public function __construct()
    {
        $this->accModel = new accModel();
    }
    public function myAccount()
    {
        $customer_id = $_SESSION['user']['id'];
        $Account = $this->accModel->getAllUser($customer_id);
        require_once "./views/profile/profile.php";
    }

    public function update_Account()
    {
        $customer_id = $_SESSION['user']['id'];
        $Account = $this->accModel->getAllUser($customer_id);
        $Old_file = $Account['avata'];
        // var_dump($Old_file);die;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            // var_dump('abc');die;
            $name = isset($_POST['name']) && $_POST['name'] !== '' ? $_POST['name'] : $Account['name'];
            $phone_number = isset($_POST['phone_number']) && $_POST['phone_number'] !== '' ? $_POST['phone_number'] : $Account['phone_number'];
            
            if (empty($_FILES['avata']['name'])) {
                $file_thumb = $Old_file;
            } else {
                $avata = $_FILES['avata'];
                //lưu hình ảnh vào 
                $file_thumb = uploadFile($avata, './uploads/');
                // nếu có ảnh mới thì xóa ảnh cũ
                if (!empty($Old_file)) {
                    deleteFile($Old_file);
                }
            }
            // var_dump($_POST);die;
            // Cập nhật thông tin người dùng trong database
            $result = $this->accModel->updateUser($customer_id, $name, $phone_number, $file_thumb);

            if ($result) {
                // Thành công, chuyển hướng về trang profile
                header("Location: " . BASE_URL . '?act=myAccount');
                exit();
            } else {
                // Thất bại, thông báo lỗi
                echo "Cập nhật thông tin thất bại. Vui lòng thử lại.";
            }
        } else {
            echo "Phương thức không hợp lệ.";
        }
        require_once "./views/profile/profile.php";

    }
}
