<?php
require_once('../config/config.php');

class VehicleListings {
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USERNAME,
                DB_PASSWORD
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
