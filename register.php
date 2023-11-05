<?php
include_once 'partials/header.php';
$title = "Time Table";
include_once 'partials/navbar.php';
include_once 'conn.php';
?>

<body>
    <div class="container">
        <div class="sub-container">
            <h1 class="text-primary">Register</h1>
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
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>

    </div>


    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $dob = $_POST['date_of_birth'];
        $phone_number = $_POST['phone_number'];
        $hashed_password = md5($password);
        $is_admin = 'N';

        $sql = "INSERT INTO users (name, email, hash_password, date_of_birth, phone_number,is_admin) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);

        $stmt->execute([$name, $email, $hashed_password, $dob, $phone_number, $is_admin]);

        // find the user that was just created

        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        $_SESSION['user'] = $user;

        header("Location: admin/buses.php");
    }
    ?>

</body>

</html>