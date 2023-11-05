<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "sandali2001"; // Replace with your MySQL password
$dbname = "bus_database";

if (isset($_GET['id'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM buses WHERE bus_name = '$id'";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            echo "<h2>Bus Details</h2>";
            echo "Bus Name: " . $row["bus_name"] . "<br>";
            echo "Bus Number: " . $row["bus_number"] . "<br>";
            echo "Capacity: " . $row["capacity"] . "<br>";
            echo "Last Maintenance Date: " . $row["last_maintenance_date"] . "<br>";
            echo "Departure time: " . $row["departure_time"] . "</br>";
            echo "start from: " . $row["start_from"] . "</br>";
            echo "end at : " . $row["end_at"] . "</br>";
            echo "Bus Stops: " . $row["bus_stops"] . "</br>";
            
        } else {
            echo "No bus found with that name.";
        }
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Please select a bus.";
}
?>

<h2>Select a Bus</h2>

<form action="" method="get">
  <label for="bus_id">Choose a bus:</label>
  <select name="id" id="bus_id">
    <option value="Red Arrow">Red Arrow</option>
    <option value="Blue Lightning">Blue Lightning</option>
    <option value="Green Cruiser">Green Cruiser</option>
    <option value="Yellow Rider">Yellow Rider</option>
    <option value="Silver Express">Silver Express</option>
    <option value="Orange Voyager">Orange Voyager</option>
    <option value="Purple Traveler">Purple Traveler</option>
    <option value="Black Navigator">Black Navigator</option>
    <option value="White Wayfarer">White Wayfarer</option>
    <option value="Gold Adventurer">Gold Adventurer</option>
  </select>
  <br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
