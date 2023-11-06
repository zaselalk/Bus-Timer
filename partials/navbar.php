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
          <a class="nav-link" href="./timetable.php">Time Table</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="./complaint.php">Complain</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./suggestion.php">Suggestions</a>
        </li>
      </ul>
      <form class="d-flex" role="search">

        <!-- check is login or not -->

        <?php

        if (isset($_SESSION['user'])) {


          echo '<a href="/bus-timer/logout.php" class="btn btn-outline-success" >Logout</a>';
          echo '<a href="/bus-timer/profile.php"><button type="button" class="btn btn-outline-danger">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"></path>
</svg>
          Profile
        </button></a>';


          if ($_SESSION['user']['is_admin'] == 'Y') {

            echo '<button class="btn btn-outline-success" type="submit"><a href="/bus-timer/admin/index.php">Dashboard</a></button>';
          }
        } else {


          echo '<a href="/bus-timer/login.php" class="btn btn-primary" >Login</a>';
        }
        ?>


        <!-- <button class="btn btn-outline-success" type="submit"><a href='/bus-timer/login.php'>Login </a></button> -->

      </form>
    </div>
  </div>
</nav>