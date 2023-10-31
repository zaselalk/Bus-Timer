<?php include_once 'partials/header.php'; ?>
<title>Login Page</title>
</head>
<body>
<?php include_once 'partials/navbar.php';?>
  <div class="container">

  <h1 class="text-primary">Login</h1>
   
  <div class="row">
    <div class="col-md-6"><form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
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


</body>

</html>