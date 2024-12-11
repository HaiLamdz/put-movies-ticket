<?php
class modelScreen
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function listScreen()
    {
        try {
            $sql = 'SELECT screens.*, cinemas.name 
                        FROM screens
                        INNER JOIN cinemas ON screens.cinema_id = cinemas.cinema_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertScreen($cinema_id, $screen_name, $seat_capacity)
    {
        try {
            $sql = 'INSERT INTO screens(cinema_id, screen_name, seat_capacity) 
                        VALUE (:cinema_id, :screen_name, :seat_capacity)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cinema_id'  => $cinema_id,
                ':screen_name'  => $screen_name,
                ':seat_capacity'  => $seat_capacity,
            ]);
            return true;
        } catch (Exception $th) {
            echo "lỗi" . $th->getMessage();
            flush();
        }
    }

    public function detailScreen($screen_id)
    {
        try {
            $sql = 'SELECT * FROM screens WHERE screen_id = :screen_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':screen_id' => $screen_id,
            ]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function editScreen($screen_id, $screen_name, $seat_capacity, $cinema_id)
    {
        try {
            $sql = 'UPDATE screens SET screen_id = :screen_id, screen_name = :screen_name, seat_capacity = :seat_capacity, cinema_id = :cinema_id WHERE screen_id = :screen_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':screen_id' => $screen_id,
                ':screen_name' => $screen_name,
                ':seat_capacity' => $seat_capacity,
                ':cinema_id' => $cinema_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            flush();
        }
    }

    public function destroyScreen($screen_id)
    {
        try {
            $sql = 'DELETE FROM  screens WHERE screen_id = :screen_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':screen_id' => $screen_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getAllSeat($screen_id)
    {
        try {
            $sql = 'SELECT seats.*, seat_status.seat_status_name, seat_types.seat_type, seat_types.seat_price
                    FROM seats
                    INNER JOIN seat_status ON seats.seat_status_id = seat_status.seat_status_id
                    INNER JOIN seat_types ON seats.seat_type_id = seat_types.id
                    WHERE seats.screen_id = :screen_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([ ':screen_id' => $screen_id]);
            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo "lỗi: " . $th->getMessage();
        }
    }
}
