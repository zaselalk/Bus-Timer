<?php
include_once 'partials/header.php';
$title = "Time Table";
include_once 'partials/navbar.php';
?>

<div class="container">
    <div class="sub-container">
        <h2>REGISTER</h2>
        <form action="register.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth"><br><br>
            
            <label for="phone_number">Phone Number:</label>
            <input type="tel" name="phone_number"><br><br>
            
            <label for="user_profile_pic">Profile Picture:</label>
            <input type="file" name="user_profile_pic"><br><br>
            <input type="submit" value="Register">
            <input type="reset" value="Cancel">
        </form>
        <p>Already have an account? <a href="login.html">Login</a></p>
    </div>
    <img class='align-middle' src="./images/login,register/bus-track.jpg" alt="bus-track">
</div>
<script src="./scripts/nav-responsive.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data1 = $_POST['name'];
    $data2 = $_POST['email'];
    $data3 = $_POST['password'];
    $data4 = $_POST['date_of_birth'];
    $data5 = $_POST['phone_number'];
    $data6 = $_POST['user_profile_pic'];

    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $dbname = "bus_route";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_match = "INSERT INTO users (name, email, hash_password, date_of_birth, phone_number, user_profile_pic) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_match);
    mysqli_stmt_bind_param($stmt, "ssssss", $data1, $data2, $data3, $data4, $data5, $data6);

    if (mysqli_stmt_execute($stmt)) {
        echo 'Data inserted successfully</br>';
    } else {
        echo 'Data not inserted successfully';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

</body>
</html>
