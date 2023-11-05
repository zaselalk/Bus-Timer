<?php
include_once '../partials/header.php';
include_once './admin_navbar.php';
include_once './is_admin.php';
?>

<! <body>
  <?php

  ?>

  <div class="container mt-5">

    <div class="row g-2 ">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Buses</h5>
            <p>Create, Update and Delete Busses</p>
            <a href="./buses.php" class="btn btn-primary">Manage</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Users</h5>
            <p>Create, Update and Delete Users</p>
            <a href="./users.php" class="btn btn-primary">Manage</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Sugessions</h5>
            <p>Create, Update and Delete Suggestions</p>
            <a href="./suggestions.php" class="btn btn-primary">Manage</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Manage Complains</h5>
            <p>Create, Update and Delete Complains</p>
            <a href="./users.php" class="btn btn-primary">Manage</a>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- Include Bootstrap JS and Popper.js (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>