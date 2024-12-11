<?php
class modelShowTime
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function listShowTime()
    {
        try {
            $sql = 'SELECT showtimes.*, movies.title, cinemas.name, screens.screen_name, status_showtimes.name_status_showtime
                            FROM showtimes
                            INNER JOIN status_showtimes ON showtimes.status_id = status_showtimes.status_id
                            INNER JOIN movies ON showtimes.movie_id = movies.movie_id
                            INNER JOIN cinemas ON showtimes.cinema_id = cinemas.cinema_id
                            INNER JOIN screens ON showtimes.screen_id = screens.screen_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function insertShowTime($movie_id, $cinema_id, $screen_id, $show_date, $show_time, $status_id)
    {
        try {
            $sql = 'INSERT INTO showtimes(movie_id, cinema_id, screen_id, show_date, show_time, status_id) 
                            VALUES (:movie_id, :cinema_id, :screen_id, :show_date, :show_time, :status_id)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':movie_id'  => $movie_id,
                ':cinema_id'  => $cinema_id,
                ':screen_id'  => $screen_id,
                ':show_date'  => $show_date,
                ':show_time' => $show_time,
                ':status_id' => $status_id
            ]);
            return true;
        } catch (Exception $e) {
            echo 'Lỗi' . $e->getMessage();
            flush();
        }
    }

    public function updateShowTime($showtime_id, $movie_id, $cinema_id, $screen_id, $show_date, $show_time, $status_id)
    {
        try {
            $sql = 'UPDATE showtimes SET movie_id = :movie_id, cinema_id = :cinema_id, screen_id = :screen_id, show_date = :show_date, show_time = :show_time, status_id = :status_id WHERE showtime_id = :showtime_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':showtime_id' => $showtime_id,
                ':movie_id' => $movie_id,
                ':cinema_id' => $cinema_id,
                ':screen_id' => $screen_id,
                ':show_date' => $show_date,
                ':show_time' => $show_time,
                ':status_id' => $status_id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            flush();
        }
    }

    public function detailShowTime($showtime_id)
    {
        try {
            $sql = 'SELECT * FROM showtimes WHERE showtime_id = :showtime_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':showtime_id' => $showtime_id,
            ]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroyShowTime($showtime_id)
    {
        try {
            $sql = 'DELETE FROM  showtimes WHERE showtime_id = :showtime_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':showtime_id' => $showtime_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function updateShowtimeStatus()
    {
        $sql = "UPDATE showtimes
                SET status_id = 5
                WHERE (show_date < CURDATE()
                OR (show_date = CURDATE() AND show_time < CURTIME()))
                AND status_id != 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return true;
    }

    // Thêm Lịch Chiếu Phim Tự Động

    public function insertShowTimeAuto()
    {
        $dateToday = date('Y-m-d');  // Lấy ngày hôm nay
        $showTimes = ['10:00:00', '14:00:00', '18:00:00', '22:00:00'];  // Các giờ chiếu

        // Lấy danh sách các phim từ bảng movies
        $sqlMovies = "SELECT movie_id FROM movies WHERE status_id = 2 AND release_date <= '$dateToday'";
        $stmtMovies = $this->conn->prepare($sqlMovies);
        $stmtMovies->execute();
        $movies = $stmtMovies->fetchAll();

        // lấy danh sách các rạp chiếu Phim
        $sqlCinemas = "SELECT cinema_id FROM cinemas";
        $stmtCinemas = $this->conn->prepare($sqlCinemas);
        $stmtCinemas->execute();
        $cinemas = $stmtCinemas->fetchAll();

        // lấy danh sách các màn hình chiếu phim
        $sqlScreens = "SELECT screen_id FROM screens";
        $stmtScreens = $this->conn->prepare($sqlScreens);
        $stmtScreens->execute();
        $screens = $stmtScreens->fetchAll();

        // Thêm lịch chiếu vào bảng showtimes
        foreach ($movies as $movie) {
            foreach ($cinemas as $cinema) {
                foreach ($screens as $screen) {
                    foreach ($showTimes as $time) {
                        $sqlInsert = "INSERT INTO showtimes (movie_id, cinema_id, screen_id, show_date, show_time, status_id)
                              VALUES (:movie_id, :cinema_id, :screen_id, :show_date, :show_time, :status_id)";
                        $stmtInsert = $this->conn->prepare($sqlInsert);  // Chuẩn bị câu lệnh SQL
                        $stmtInsert->execute([
                            ':movie_id' => $movie['movie_id'],  // ID phim
                            ':cinema_id' => $cinema['cinema_id'],  // ID phim
                            ':screen_id' => $screen['screen_id'],  // ID phim
                            ':show_date' => $dateToday,         // Ngày chiếu
                            ':show_time' => $time,               // Giờ chiếu
                            ':status_id' => 2,               // Giờ chiếu
                        ]);
                    }
                }
            }
        }
    }
}
