<?php
class modelMovies
{
    public $conn; // Khai báo phương thức 

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function insertMovies($name, $mota, $theLoai, $thoiLuong, $ngayPhatHanh, $trailer, $trangThai, $daoDien, $dienVien, $hinhAnh)
    {
        try {
            $sql = 'INSERT INTO movies (title, description, genre, duration, release_date, poster_url, trailer_url, status_id, director, cast) 
                    VALUES (:title, :description, :genre, :duration, :release_date, :poster_url, :trailer_url, :status_id, :director, :cast)';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':title' => $name,
                ':description' => $mota,
                ':genre' => $theLoai,
                ':duration' => $thoiLuong,
                ':release_date' => $ngayPhatHanh,
                ':poster_url' => $hinhAnh, // Sử dụng tên tham số chính xác
                ':trailer_url' => $trailer,
                ':status_id' => $trangThai,
                ':director' => $daoDien,
                ':cast' => $dienVien,
            ]);

            return $stmt->rowCount(); // Sử dụng rowCount để trả về số dòng bị ảnh hưởng
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    public function listMovies()
    {
        try {
            $sql = "SELECT movies.*, status_movies.status 
                        FROM movies
                        INNER JOIN status_movies ON movies.status_id = status_movies.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }


    public function detailMovies($id)
    {
        try {
            $sql = 'SELECT movies.*, genre.name 
                    FROM movies
                    INNER JOIN genre ON movies.genre = genre.genre_id
                    WHERE movies.movie_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id,
            ]);
            return $stmt->fetch();
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
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function editMovies($id, $title, $poster_url, $genre, $status_id, $description)
    {
        try {
            echo "Updating movie with ID: $id, Title: $title, Poster URL: $poster_url, Genre: $genre, Status ID: $status_id, Description: $description";
            if (empty($poster_url)) {
                $sql = 'UPDATE movies SET title = :title, genre = :genre, status_id = :status_id, description = :description WHERE movie_id = :movie_id';
                $params = [
                    ':movie_id' => $id,
                    ':title' => $title,
                    ':genre' => $genre,
                    ':status_id' => $status_id,
                    ':description' => $description,
                ];
            } else {
                $sql = 'UPDATE movies SET title = :title, poster_url = :poster_url, genre = :genre, status_id = :status_id, description = :description WHERE movie_id = :movie_id';
                $params = [
                    ':movie_id' => $id,
                    ':title' => $title,
                    ':poster_url' => $poster_url,
                    ':genre' => $genre,
                    ':status_id' => $status_id,
                    ':description' => $description,
                ];
            }
            // var_dump($sql, $params);die;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            flush();
            return false;
        }
    }

    public function updateMovieStatus()
    {
        $sql = "UPDATE movies
                SET status_id = 2
                WHERE (release_date < CURDATE()
                OR (release_date = CURDATE() ))
                AND status_id != 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return true;
    }

    public function editTrailer($id, $trailer_url)
    {
        try {
            $sql = 'UPDATE movies SET trailer_url = :trailer_url WHERE movie_id = :movie_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':movie_id' => $id,
                ':trailer_url' => $trailer_url
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return false;
        }
    }

    public function destroyMovies($id)
    {
        try {
            $sql = 'DELETE FROM  movies WHERE movie_id = :movie_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':movie_id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            return false;
        }
    }

    // lấy phim chiếu theo lịch
    public function listMoviesOfDay()
    {
        try {
            $date = date('y-m-d');
            $sql = "SELECT movies.*, status_movies.status 
                        FROM movies
                        INNER JOIN status_movies ON movies.status_id = status_movies.id
                        WHERE movies.release_date < '$date'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
