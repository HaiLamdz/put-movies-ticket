<?php
class genreModel
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
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
    
    public function getGenreOfId($genre_id)
    {
        try {
            $sql = 'SELECT * FROM genre WHERE genre_id = :genre_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':genre_id' => $genre_id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

}
?>