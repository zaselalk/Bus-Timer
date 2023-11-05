<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bus Timer</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/bus-timer/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/bus-timer/timetable.php">Time Table</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/bus-timer/contact.php">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex" role="search">

        <!-- check is login or not -->

        <?php

        if (isset($_SESSION['user'])) {


          echo '<a href="/bus-timer/logout.php">Logout</a>';
          echo '<button class="btn btn-outline-success" type="submit"><a href="/bus-timer/admin/index.php">Dashboard</a></button>';
        } else {


          echo '<a href="/bus-timer/login.php" class="btn btn-primary" >Login</a>';
        }
        ?>


        <!-- <button class="btn btn-outline-success" type="submit"><a href='/bus-timer/login.php'>Login </a></button> -->

      </form>
    </div>
  </div>
</nav>