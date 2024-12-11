<?php
class movieModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    
    public function detailMovie($id)
    {
        try {
            $sql = 'SELECT movies.*, status_movies.status, genre.name
                            FROM movies
                            INNER JOIN status_movies ON movies.status_id = status_movies.id
                            INNER JOIN genre ON movies.genre = genre.genre_id
                            WHERE movies.movie_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function insertBinhLuan($movie_id, $customer_id, $rating, $comment)
    {
        // $review_date = date('y-m-d');
        try {
            $sql = 'INSERT INTO reviews (movie_id, customer_id, rating, comment)
                VALUES (:movie_id, :customer_id, :rating, :comment)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':movie_id' => $movie_id,
                ':customer_id' => $customer_id,
                ':rating' => $rating,
                ':comment' => $comment,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            flush();
        }
    }

    public function getAllBinhLuan($id)
    {
        try {
            $sql = 'SELECT reviews.*, customers.name, customers.avata
                        FROM reviews
                        INNER JOIN customers ON reviews.customer_id= customers.customer_id
                        INNER JOIN movies ON reviews.movie_id= movies.movie_id
                        WHERE reviews.movie_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    // public function movieOfGenre($genre_id)
    // {
    //     try {
    //         $sql = 'SELECT * FROM movies WHERE genre = :genre_id';
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute([
    //             ':genre_id' => $genre_id,
    //         ]);
    //         return $stmt->fetchALL();
    //     } catch (Exception $th) {
    //         throw $th;
    //     }
    // }

    public function movieOfGenre($genre_id)
    {
        try {
            $dateTime = date("Y-m-d");
            $sql = "SELECT movies.movie_id, movies.title, movies.director, movies.duration, movies.poster_url, movies.description,
                        GROUP_CONCAT(showtimes.show_time ORDER BY showtimes.show_time) AS show_time
                        FROM showtimes
                        INNER JOIN movies ON showtimes.movie_id = movies.movie_id 
                        WHERE showtimes.show_date = '$dateTime' AND genre = :genre_id AND showtimes.cinema_id = 1
                        GROUP BY movies.movie_id, movies.title, movies.director, movies.duration, movies.poster_url, movies.description ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':genre_id' => $genre_id
            ]);
            // echo $genre_id;
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function latestMovie() {
        try {
            $date = date('Y-m-d');
            $sql = "SELECT * FROM movies WHERE release_date < '$date' AND status_id  = 2 ORDER BY release_date DESC LIMIT 3 ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $th) {
            throw $th;
        }
    }
    

    
}
