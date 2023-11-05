<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'partials/header.php'; ?>
  <title>Home Page</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <?php include_once 'partials/navbar.php'; ?>
  <div class="container">
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center ">
      <div class="col-md-7 p-lg-5 mx-auto my-5">
        <h1 class="display-4 font-weight-normal">Bus Timer</h1>
        <p class="lead font-weight-normal">Find out when your bus will arrive</p>
        <a class="btn btn-primary" href="./timetable.php">Find Bus</a>
      </div>
      <div class="product-device box-shadow d-none d-md-block"></div>
      <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
  </div>
</body>

</html>