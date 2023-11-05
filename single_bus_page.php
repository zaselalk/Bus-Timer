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
$sql_create_table = "CREATE TABLE buses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  bus_name VARCHAR(255),
  bus_number VARCHAR(255),
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
$sql_insert_data = "INSERT INTO buses (bus_name, bus_number, capacity, last_maintenance_date, start_from, end_at, bus_stops, departure_time) VALUES
('Red Arrow', 'Bus-1001', 50, '2023-10-15', 'New York', 'Boston', 'Albany, Hartford, Worcester', '08:00:00'),
('Blue Lightning', 'Bus-1002', 45, '2023-09-21', 'Chicago', 'Miami', 'Indianapolis, Nashville, Atlanta', '09:30:00'),
('Green Cruiser', 'Bus-1003', 60, '2023-08-18', 'San Francisco', 'Seattle', 'Sacramento, Portland', '11:45:00'),
('Yellow Rider', 'Bus-1004', 55, '2023-07-25', 'Houston', 'Dallas', 'Austin, Waco', '10:00:00'),
('Silver Express', 'Bus-1005', 40, '2023-06-30', 'Atlanta', 'Washington', 'Charlotte, Richmond, Baltimore', '07:15:00'),
('Orange Voyager', 'Bus-1006', 65, '2023-05-12', 'Denver', 'Phoenix', 'Colorado Springs, Albuquerque', '12:00:00'),
('Purple Traveler', 'Bus-1007', 50, '2023-04-02', 'Orlando', 'Tampa', 'Lakeland', '11:30:00'),
('Black Navigator', 'Bus-1008', 55, '2023-03-14', 'Las Vegas', 'San Diego', 'Los Angeles, Palm Springs', '09:15:00'),
('White Wayfarer', 'Bus-1009', 60, '2023-02-07', 'Portland', 'Vancouver', 'Seattle', '10:45:00'),
('Gold Adventurer', 'Bus-1010', 45, '2023-01-19', 'Boston', 'New York', 'Worcester, Hartford, Albany', '08:45:00')";

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
