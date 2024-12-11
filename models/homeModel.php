<?php
class homeModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function listMovies()
    {
        try {
            $sql = 'SELECT movies.*, status_movies.status 
                        FROM movies
                        INNER JOIN status_movies ON movies.status_id = status_movies.id
                        WHERE movies.status_id = 2';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function movieShowing()
    {
        try {
            $dateTime = date("y-m-d");
            $sql = "SELECT movies.movie_id, movies.title, movies.director, movies.duration, movies.poster_url, movies.description,
                        GROUP_CONCAT(showtimes.show_time ORDER BY showtimes.show_time) AS show_time
                        FROM showtimes
                        INNER JOIN movies ON showtimes.movie_id = movies.movie_id 
                        WHERE showtimes.show_date = '$dateTime' AND  showtimes.cinema_id = 1
                        GROUP BY movies.movie_id, movies.title, movies.director, movies.duration, movies.poster_url, movies.description";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function CommingSoon()
    {
        try {
            $sql = 'SELECT movies.*, status_movies.status 
                        FROM movies
                        INNER JOIN status_movies ON movies.status_id = status_movies.id
                        WHERE movies.status_id = 1';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
