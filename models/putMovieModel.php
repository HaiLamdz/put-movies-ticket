<?php
class putMovieModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getMovie($cinema_id)
    {
        try {
            $sql = 'SELECT m.movie_id, m.title, GROUP_CONCAT(showtimes.show_time ORDER BY showtimes.show_time) AS showtimes
                    FROM showtimes
                    INNER JOIN movies AS m ON showtimes.movie_id = m.movie_id
                    WHERE showtimes.cinema_id = :cinema_id
                    GROUP BY m.movie_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':cinema_id' => $cinema_id,
            ]);
            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo "lỗi" . $th->getMessage();
        }
    }

    public function showtime( $cinema_id, $movie_id){
        try {
           $sql = 'SELECT showtime_id, show_time FROM showtimes WHERE movie_id = :movie_id AND cinema_id = :cinema_id AND status_id = 2';
           $stmt = $this->conn->prepare($sql);
           $stmt->execute([
               ':cinema_id' => $cinema_id,
                ':movie_id' => $movie_id,
           ]);
           return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo "lỗi: " . $th->getMessage();
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
}
