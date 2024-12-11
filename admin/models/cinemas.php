<?php
class modelCinema
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function listCinema()
    {
        try {
            $sql = 'SELECT * FROM cinemas';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertCinema($name,$image_cinema, $address, $city, $phone_number)
    {
        try {
            $sql = 'INSERT INTO cinemas(name, image_cinema,  address, city, phone_number) 
                        VALUE (:name, :image_cinema, :address, :city, :phone_number)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name'  => $name,
                ':image_cinema' => $image_cinema,
                ':address'  => $address,
                ':city'  => $city,
                ':phone_number'  => $phone_number,
            ]);
            return true;
        } catch (Exception $th) {
            echo "lỗi" . $th->getMessage();
            flush();
        }
    }

    public function detailCinema($cinema_id)
    {
        try {
            $sql = 'SELECT * FROM cinemas WHERE cinema_id = :cinema_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cinema_id' => $cinema_id,
            ]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function editCinema($cinema_id, $name, $image_cinema,  $address, $city, $phone_number){
        try {
            if(empty($image_cinema)){
                $sql = 'UPDATE cinemas SET cinema_id = :cinema_id, name = :name, address = :address, city = :city, phone_number = :phone_number WHERE cinema_id = :cinema_id';
                $params = [
                    ':cinema_id' => $cinema_id,
                    ':name' => $name,
                    ':address' => $address,
                    ':city' => $city,
                    ':phone_number' => $phone_number
                ];
            }else{
                $sql = 'UPDATE cinemas SET cinema_id = :cinema_id, name = :name, image_cinema = :image_cinema, address = :address, city = :city, phone_number = :phone_number WHERE cinema_id = :cinema_id';
                $params = [
                    ':cinema_id' => $cinema_id,
                    ':name' => $name,
                    ':image_cinema' => $image_cinema,
                    ':address' => $address,
                    ':city' => $city,
                    ':phone_number' => $phone_number
                ];
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            flush();

        }
    }

    public function destroyCinemas($cinema_id){
        try {
            $sql = 'DELETE FROM  cinemas WHERE cinema_id = :cinema_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cinema_id' => $cinema_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getAllGenre()
    {
        try {
            $sql = 'SELECT * FROM genre';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
