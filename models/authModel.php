<?php
class authModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function dangky($name, $email, $password, $registered_date)
    {
        $chuc_vu_id = 2;
        $ma_xac_thuc = rand(10000,99999);
        try {
            $registered_date = date('y-m-d');
            $sql = 'INSERT INTO customers (name, email, password ,registered_date, ma_xac_thuc, chuc_vu_id)
                    VALUE (:name, :email, :password, :registered_date, :ma_xac_thuc, :chuc_vu_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $password,
                ':registered_date' => $registered_date,
                ':ma_xac_thuc' => $ma_xac_thuc,
                ':chuc_vu_id' => $chuc_vu_id,
            ]);
            return $ma_xac_thuc;
        } catch (Exception $th) {
            echo "Lỗi: " . $th->getMessage();
        }
    }

    public function check_ma_xac_thuc($code)
    {
        // Kiểm tra mã xác thực
        $sql = "SELECT * FROM customers WHERE ma_xac_thuc = :code";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':code' => $code]);
        $user = $stmt->fetch();

        if ($user) {
            // Cập nhật trạng thái người dùng đã xác thực
            $updateSql = "UPDATE customers SET trang_thai_xac_thuc = 1 WHERE ma_xac_thuc = :code";
            $updateStmt = $this->conn->prepare($updateSql);
            $updateStmt->execute([':code' => $code]);

            return true;
        }

        return false;
    }

    public function checkAcc($user, $password)
    {
        try {
            $sql = "SELECT * FROM customers WHERE email = :email AND password = :password";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':email' => $user,
                ':password' => $password
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            flush();
        }
    }
}
