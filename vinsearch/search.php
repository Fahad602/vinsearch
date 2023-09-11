<!DOCTYPE html>
<html>
<head>
    <title>VIN Search</title>
</head>
<body>
    <h1>VIN Search</h1>
    <form action="search.php" method="POST">
        <label for="vin">VIN:</label>
        <input type="text" id="vin" name="vin" required>
        <input type="submit" value="Search">
    </form>
    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        require_once('../model/vehiclelistings.php');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vin = $_POST['vin'];

            // Validate the VIN (you can add more validation)
            if (preg_match('/^[A-HJ-NPR-Z0-9]{17}$/', $vin)) {
                $db = new VehicleListings();
                $result = $db->searchVin($vin);

                if ($result) {
                    // Display vehicle information
                    echo "<h2>Vehicle Information</h2>";
                    echo "VIN: " . $result['vin'] . "<br>";
                    echo "Year: " . $result['year'] . "<br>";
                    echo "Make: " . $result['make'] . "<br>";
                    echo "Model: " . $result['model'] . "<br>";
                    // Add more fields as needed
                } else {
                    echo "No results found for VIN: " . $vin;
                }
            } else {
                echo "Invalid VIN format. Please enter a valid VIN.";
            }
        }
    ?>
</body>
</html>