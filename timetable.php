<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bus Timetable</title>
  <?php include_once 'partials/header.php'; ?>
  <?php
   include_once 'conn.php';

  $query = "
    SELECT bus_station FROM bus_route 
    GROUP BY bus_station
    ORDER BY bus_station ASC
  ";

  $stmt = $conn->prepare($query);
  $stmt->execute();

  $result = $stmt->fetchAll();



  ?>
  <link href="styles/bootstrap.min.css" rel="stylesheet">
  <script src="scripts/bootstrap.bundle.min.js"></script>
  <script src="scripts/dselect.js"></script>
</head>
<body>
  <?php include_once 'partials/navbar.php'; ?>

  <section class="container mt-5 p-3 bg-light">
    <form action="" method="post" class="d-flex justify-content-center align-items-center">
      <div class="mb-3 me-3">
        <label for="select_box" class="form-label">Select Station</label>
        <select name="select_box" class="form-select" id="select_box">
          <option value="">Select Station</option>
          <?php
          foreach ($result as $row) {
            echo '<option value="' . $row["bus_station"] . '">' . $row["bus_station"] . '</option>';
          }
          ?>
        </select>
      </div>
      <button class="btn btn-primary mt-3">Find Buses</button>
    </form>
  </section>

  <div class="container mt-5 p-3 bg-light">
    <div class="row">
      <div class="col-md-6">
        <?php
        $query = "SELECT * FROM bus_route";
        $statement = $conn->prepare($query);
        $statement->execute();
        $timetable = $statement->fetchAll(PDO::FETCH_ASSOC);

        echo '<h5 class="text-primary">Timetable</h5>';
        echo '<ul>';
        foreach ($timetable as $row) {
          echo '<li>' . $row['bus_no'] . ' - ' . $row['bus_station'] . ' - ' . $row['time'] . '</li>';
        }
        echo '</ul>';
        ?>
      </div>
      <div class="col-md-6">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $selectedStation = $_POST['select_box'];

          if (!empty($selectedStation)) {
            date_default_timezone_set('Asia/Colombo');
            $currentTime = date('H:i:s');

            $query = "SELECT bus_no, time FROM bus_route WHERE bus_station = :station AND time > :current_time ORDER BY time ASC LIMIT 5";
            $statement = $conn->prepare($query);
            $statement->execute(array(':station' => $selectedStation, ':current_time' => $currentTime));
            $timetable = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (count($timetable) > 0) {
              echo '<h5 class="text-success">Upcoming Buses for ' . $selectedStation . '</h5>';
              echo '<ul>';
              foreach ($timetable as $row) {
                echo '<li>' . $row['bus_no'] . ' - ' . $row['time'] . '</li>';
              }
              echo '</ul>';
            } else {
              echo '<p class="text-muted">No upcoming buses found for ' . $selectedStation . '</p>';
            }
          } else {
            echo '<p class="text-danger">Please select a station.</p>';
          }
        }
        ?>
      </div>
    </div>
  </div>

  <script>
    var select_box_element = document.querySelector('#select_box');
    dselect(select_box_element, {
      search: true
    });
  </script>
</body>
</html>
