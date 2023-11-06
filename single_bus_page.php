<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "root1234";
$dbname = "bus_route";

if (isset($_GET['id'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL to create table
    $sql_create_table = "CREATE TABLE IF NOT EXISTS buses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        bus_name VARCHAR(255),
        bus_no VARCHAR(255),
        capacity INT,
        last_maintenance_date DATE,
        start_from VARCHAR(255),
        end_at VARCHAR(255),
        bus_stops VARCHAR(255),
        departure_time TIME
    )";

    if ($conn->query($sql_create_table) === TRUE) {
        echo "Table buses created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    // SQL to insert data
    $sql_insert_data = "INSERT INTO buses (bus_name, bus_no, capacity, last_maintenance_date, start_from, end_at, bus_stops, departure_time) VALUES
        ('City Express', 'AB1234', 50, '2023-10-15', 'Jaffna', 'Colombo', 'Kandy, Gampaha, BAtticaloa', '08:00:00'),
        ('Metro Cruiser', 'BX2343', 45, '2023-09-21', 'Polonnaruwa', 'Kandy', 'Kurunegala, Kegalle, Anuradhapura', '09:30:00'),
        ('Sunset Shuttle', 'LM3432', 60, '2023-08-18', 'Kurunegala', 'Colombo', 'Gampaha, Migamuwa', '11:45:00'),
        ('Green Transit', 'LC4523', 55, '2023-07-25', 'Batticaloa', 'Matara', 'Katharagama, Colombo', '10:00:00'),
        ('Skyliner Coach', 'LK4532', 40, '2023-06-30', 'Colombo', 'Kandy', 'Mirigama, Kegalle, Gampaha', '07:15:00')";

    if ($conn->query($sql_insert_data) === TRUE) {
        echo "New records created successfully";
    } else {
        echo "Error: " . $sql_insert_data . "<br>" . $conn->error;
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
            echo "Bus Number: " . $row["bus_no"] . "<br>";
            echo "Capacity: " . $row["capacity"] . "<br>";
            echo "Last Maintenance Date: " . $row["last_maintenance_date"] . "<br>";
            echo "Departure time: " . $row["departure_time"] . "</br>";
            echo "Start From: " . $row["start_from"] . "</br>";
            echo "End At: " . $row["end_at"] . "</br>";
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
    <option value="City Express">City Express</option>
    <option value="Metro Cruiser">Metro Cruiser</option>
    <option value="Sunset Shuttle">Sunset Shuttle</option>
    <option value="Green Transit">Green Transit</option>
    <option value="Skyliner Coach">Skyliner Coach</option>
  </select>
  <br><br>
  <input type="submit" value="Find Bus">
</form>

</body>
</html>
