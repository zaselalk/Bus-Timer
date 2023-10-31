<?php include_once 'partials/header.php'; ?>
<title>Time Table</title>
</head>
<body>
<?php include_once 'partials/navbar.php';?>
  <div class="container">
    <div class="sub-container">
      <h2>LOGIN</h2>
      <form action="login.php">
        <input type="text" name="email" placeholder="Email Address">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Login">
      </form>
      <p>Don't have an account? <a href="register.html">Register</a></p>
    </div>
    <img src="./images/login,register/bus-track.jpg" alt="bus-track">
  </div>
  <script src="./scripts/nav-responsive.js"></script>
</body>

</html>