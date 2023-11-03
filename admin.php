<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Timetable</title>
    <?php include_once 'partials/header.php'; ?>
    <?php
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPass = 'root1234';

    $connect = new PDO("mysql:host=localhost;dbname=bus_timer", $dbUser, $dbPass);

    ?>
    <link href="styles/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include_once 'partials/navbar.php'; ?>

    <div class="container mt-4">
    <h1>Admin Panel</h1>

    <ul class="list-group mt-3">
        <li class="list-group-item"><a href="admin/users.php">Manage Users</a></li>
        <li class="list-group-item"><a href="admin/buses.php">Manage Buses</a></li>
        <li class="list-group-item"><a href="admin/bus_route.php">Manage Bus Routes</a></li>
        <li class="list-group-item"><a href="admin/suggestions.php">Manage suggestions</a></li>
        <li class="list-group-item"><a href="admin/bus_complains.php">Manage Bus Complaints</a></li>
    </ul>
</div>

</body>

</html>