<?php include_once 'partials/header.php'; ?>
<title>Login Page</title>
</head>
<body>
<?php include_once 'partials/navbar.php';?>
  <div class="container">

  <h1 class="text-primary">Login</h1>
   <form action='' method='POST'>
  <div class="row">
    <div class="col-md-6"><form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" name='email' aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name='password'>
    <div id="pwdHelp" class="form-text">Your Password is protected with me</div>
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form></div>
    <div class="col-md-6"></div>
  </div>
  <div class="form-text">
  <p>
        If you are new,then <a href='register.php' target="_blank">sign_up </a> here
    </p>
</div>
</body>
<?php
include_once 'partials/header.php';
$title = "Login Page";
include_once 'partials/navbar.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // You should add your database connection logic here.
    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $database = "bus_route";

    // Create a connection to the database
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Perform proper password hashing for security
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        // User is authenticated, redirect to a welcome page or perform other actions.
        header("Location: welcome.php");
        exit();
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}


?>
</html>