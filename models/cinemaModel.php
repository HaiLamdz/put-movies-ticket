<?php 
 class cinemaModel{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllCinema() {
        try {
            $sql = 'SELECT * FROM cinemas ';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo "Lỗi" . $th->getMessage();
        } 
    }
 }
?>