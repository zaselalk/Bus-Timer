<!-- if login -->
<?php include_once 'partials/header.php'; ?>
<?php


if (isset($_SESSION['user'])) {
  //check is admin
  if ($_SESSION['user']['is_admin'] == 1) {
    header("Location: admin/index.php");
  } else {
    header("Location: index.php");
  }
  
}

?>



<title>Login Page</title>
</head>

<body>
  <?php include_once 'partials/navbar.php'; ?>

  <?php
  include_once 'partials/header.php';
  $title = "Login Page";
  include_once 'partials/navbar.php';
  include_once 'conn.php';

  // Check if the form has been submitted


  ?>
  <div class="container mt-5">
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $hashed_password = md5($password);


      // Use prepared statements to prevent SQL injection
      $sql = "SELECT * FROM users WHERE email = ? AND hash_password = ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$email, $hashed_password]);
      $user = $stmt->fetch();


      if ($user) {
        $_SESSION['user'] = $user;
        header("Location: admin/index.php");

        
      } else {
        echo "<p class='alert alert-danger'>Invalid email or password</p>";
      }
    }
    ?>


    <h1 class="text-primary">Login</h1>
    <form action='' method='POST'>
      <div class="row">
        <div class="col-md-6">
          <form>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label" >Email address</label>
              <input type="email" class="form-control" name='email' aria-describedby="emailHelp" required>
              
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" name='password' required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
          </form>
        </div>
        <div class="col-md-6"></div>
      </div>
      <div class="form-text">
        <p>
          Havent registerd yet? then <a href='register.php'>Register </a>
        </p>
      </div>
</body>

</html>