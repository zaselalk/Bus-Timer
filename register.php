<?php include_once 'partials/header.php'; ?>
<title>Time Table</title>
</head>
<body>
<?php include_once 'partials/navbar.php';?>
  <div class="container">
    <div class="sub-container">
      <h2>REGISTER</h2>
      <form action="register.php">
        <div class="name">
          <input type="text" name="fname" placeholder="First Name">
          <input type="text" name="lname" placeholder="Last Name">
        </div>
        <input type="text" name="email" placeholder="Email Address">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="cpassword" placeholder="Confirm Password">
        <input type="submit" name="submit" value="Register">
      </form>
      <p>Already have an account? <a href="login.html">Login</a></p>
    </div>
    <img src="./images/login,register/bus-track.jpg" alt="bus-track">
  </div>
  <script src="./scripts/nav-responsive.js"></script>
</body>

</html>