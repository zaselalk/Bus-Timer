<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- Include Bootstrap CSS (replace with local Bootstrap if needed) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <style>
    /* Add your custom styles for the dashboard here */
    .container {
      padding: 50px;
    }

    .card {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <?php
  include_once './admin_navbar.php';
  ?>

  <div class="container">
    <div class="col-md-8">
      <div class="row g-2 ">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage Categories</h5>
              <a href="/jobs/admin/categories" class="btn btn-primary">Manage</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage Sources</h5>
              <a href="/jobs/admin/sources" class="btn btn-primary">Manage</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage FAQ</h5>
              <a href="/jobs/admin/faq" class="btn btn-primary">Manage</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage Company</h5>
              <a href="#" class="btn btn-primary">Manage</a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Manage Jobs</h5>
              <a href="#" class="btn btn-primary">Manage</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>




  <!-- Include Bootstrap JS and Popper.js (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>