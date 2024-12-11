<?php 
    class  accModel{
        public $conn;

        public function __construct()
        {
            $this->conn = connectDB();
        }

        public function getAllUser($customer_id) {
            try {
                $sql = 'SELECT * FROM customers WHERE customer_id = :customer_id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([':customer_id' => $customer_id]);
                return $stmt->fetch();
            } catch (Exception $e) {
                echo "loi" . $e->getMessage();
            }
        }

        public function updateUser($customer_id, $name, $phone_number, $avata){
            try {
                $sql = 'UPDATE customers SET name = :name, phone_number = :phone_number, avata = :avata WHERE customer_id = :customer_id';
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ':customer_id' => $customer_id,
                    ':name' => $name,
                    ':phone_number' => $phone_number,
                    ':avata' => $avata
                ]);
                return $stmt;
            } catch (Exception $e) {
                echo "loi" . $e->getMessage();
            }
        }
    }

?>