<?php
class modelGenre
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
    public function addGenre($name, $mota){
        try {
            $sql = 'INSERT INTO genre (name, mota)
                       VALUES (:name, :mota) ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':mota' => $mota
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function detailGenre($genre_id)
    {
        try {
            $sql = 'SELECT * FROM genre WHERE genre_id = :genre_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':genre_id' => $genre_id,
            ]);
            return $stmt->fetch();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function editGenre($genre_id, $name, $mota){
        try {
            $sql = 'UPDATE genre SET genre_id = :genre_id, name = :name, mota = :mota WHERE genre_id = :genre_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':genre_id' => $genre_id,
                ':name' => $name,
                ':mota' => $mota,
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
            flush();

        }
    }

    public function destroyGenres($genre_id){
        try {
            $sql = 'DELETE FROM  genre WHERE genre_id = :genre_id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':genre_id' => $genre_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
