<?php
include_once 'partials/header.php';
$title = "Time Table";
include_once 'partials/navbar.php';
?>
<body>
<div class="container">
    <div class="sub-container">
        <h2>REGISTER</h2>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth">
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" name="phone_number">
            </div>
            <input type="submit" class="btn btn-primary" value="Register">
            <input type="reset" class="btn btn-secondary" value="Cancel">
        </form>
        <p>Already have an account? <a href="login.html">Login</a></p>
    </div>
    <img class="bus-track" src="./images/login,register/bus-track.jpg" alt="bus-track">
</div>
<script src="./scripts/nav-responsive.js"></script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data1 = $_POST['name'];
    $data2 = $_POST['email'];
    $data3 = $_POST['password'];
    $data4 = $_POST['date_of_birth'];
    $data5 = $_POST['phone_number'];

    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $dbname = "bus_route";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_match = "INSERT INTO users (name, email, hash_password, date_of_birth, phone_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_match);
    mysqli_stmt_bind_param($stmt, "sssss", $data1, $data2, $data3, $data4, $data5);

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
