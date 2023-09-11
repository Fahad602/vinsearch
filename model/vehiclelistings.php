<?php

class VehicleListings {
    private $conn;
    private const DB_HOST = 'localhost'; 
    private const DB_USER = 'fahad';
    private const DB_PASS = 'SgYBUZ7Gqe2LQw'; // 
    private const DB_NAME = 'test';
    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME,
                self::DB_USER,
                self::DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function searchVin($vin) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM vehicle_listings WHERE vin = :vin");
            $stmt->bindParam(':vin', $vin, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            // Handle database query error
            die("Database query failed: " . $e->getMessage());
        }
    }
}

?>
