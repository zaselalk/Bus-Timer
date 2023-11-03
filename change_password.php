<!DOCTYPE html>
<html>
<head>
    <title>Change Password and Insert Data</title>
</head>
<body>
    <!-- Change Password Form -->
    <h2>Change Password</h2>
    <form method="post">
        <input type="hidden" name="user_id" value="1"> <!-- Replace with the user's actual ID -->
        <input type="password" name="new_password" placeholder="New Password">
        <input type="submit" name="change_password" value="Change Password">
    </form>

    <!-- Insert Data Form -->
    <h2>Insert Data</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="date" name="date_of_birth" placeholder="Date of Birth">
        <input type="text" name="phone_number" placeholder="Phone Number">
        <input type="submit" name="insert_data" value="Insert Data">
    </form>
</body>
</html>


<?php
$servername = "localhost";  
$username = "root";  
$password = "root1234";  
$database = "bus_routes";  

 
$conn = new mysqli($servername, $username, $password, $database,3306);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Change Password
    if (isset($_POST["change_password"])) {
        $user_id = $_POST["user_id"];
        $newPassword = $_POST["new_password"];

        // Hash the new password before updating it
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password
        $updatePasswordSQL = "UPDATE users SET hash_password = '$hashedNewPassword' WHERE user_id = $user_id";

        if ($conn->query($updatePasswordSQL) === TRUE) {
            echo "Password changed successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
        }
    }

    // Insert Data
    if (isset($_POST["insert_data"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $date_of_birth = $_POST["date_of_birth"];
        $phone_number = $_POST["phone_number"];

        // Insert data into the 'users' table
        $insertDataSQL = "INSERT INTO users (name, email, hash_password, date_of_birth, phone_number) VALUES ('$name', '$email', '', '$date_of_birth', '$phone_number')";

        if ($conn->query($insertDataSQL) === TRUE) {
            echo "Data inserted successfully.";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

