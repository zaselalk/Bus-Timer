<?php
$servername = "localhost";  
$username = "root";  
$password = "root1234";  
$database = "bus_routes";  

 
$conn = new mysqli($servername, $username, $password, $database,3306);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        echo "User ID: " . $row["user_id"] . "<br>";
        echo "Name: " . $row["name"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Date of Birth: " . $row["date_of_birth"] . "<br>";
        echo "Phone Number: " . $row["phone_number"] . "<br>";
        echo "User Profile Pic: " . $row["user_profile_pic"] . "<br>";
        echo "Created At: " . $row["created_at"] . "<br>";
        echo "Is Admin: " . $row["is_admin"] . "<br>";
        echo "<br>";
        
    }
} else {
    echo "No users found in the database.";
}

// Close the database connection
$conn->close();
?>
