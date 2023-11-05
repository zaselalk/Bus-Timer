<?php
include_once '../partials/header.php';
include_once '../conn.php';
include_once './admin_navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $bus_no = $_POST['bus_no'];
    $bus_station = $_POST['bus_station'];
    $time = $_POST['time'];

    $insert_bus = "INSERT INTO bus_route (bus_no, bus_station, time) VALUES ('$bus_no', '$bus_station', '$time')";

    if($conn->query($insert_bus) === TRUE) {
        echo "Bus route created successfully.";
    } else {
        echo "Error creating bus route: ";
    }
}

$routeList = [];
$all_routes = "SELECT * FROM bus_route";
$routes_result = $conn->query($all_routes);

$routeList = [];

if ($routes_result->rowCount() > 0) {
    while ($row = $routes_result->fetch(PDO::FETCH_ASSOC)) {
        $routeList[] = $row;
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $route_id = $_POST['route_id'];
    $bus_no = $_POST['bus_no'];
    $bus_station = $_POST['bus_station'];
    $time = $_POST['time'];

    $stmt = $conn->prepare("UPDATE bus_route SET bus_no=:bus_no, bus_station=:bus_station, time=:time WHERE id=:route_id");
    $stmt->bindParam(':bus_no', $bus_no);
    $stmt->bindParam(':bus_station', $bus_station);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':route_id', $route_id);
    
    if ($stmt->execute()) {
        echo "Bus route updated successfully.";
    } else {
        echo "Error updating bus route: " . $stmt->errorInfo();
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $route_id = $_GET['delete'];
$stmt = $conn->prepare("DELETE FROM bus_route WHERE id=:route_id");
$stmt->bindParam(':route_id', $route_id);

if ($stmt->execute()) {
    echo "Bus route deleted successfully.";
} else {
    echo "Error deleting bus route: " . $stmt->errorInfo();
}
$stmt->closeCursor(); // Explicitly close the cursor to enable the next statement to be executed

}
?>

<div class="container mt-4">
    <h1>Manage Bus Routes</h1>
    <?php
 
 ?>

    <form method="POST">
        <h3>Create Bus Route</h3>
            <input type="text" name="bus_no" class="form-control" placeholder="Bus Number" required>
            <input type="text" name="bus_station" class="form-control" placeholder="Bus Station" required>
            <input type="time" name="time" class="form-control" required>
        <button type="submit" name="create" class="btn btn-primary">Create Bus Route</button>
    </form>

    <h3>Bus Routes List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bus Number</th>
                <th>Bus Station</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($routeList as $route) {
                echo "<tr>";
                echo "<td>" . $route["id"] . "</td>";
                echo "<td>" . $route["bus_no"] . "</td>";
                echo "<td>" . $route["bus_station"] . "</td>";
                echo "<td>" . $route["time"] . "</td>";
                echo "<td>
                    <a href='bus_route.php?edit=" . $route["id"] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='bus_route.php?delete=" . $route["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
if (isset($_GET['edit'])) {
    $route_id = $_GET['edit'];
    $stmt = $conn->prepare("SELECT * FROM bus_route WHERE id = :route_id");
    $stmt->bindParam(':route_id', $route_id);
    $stmt->execute();
    $route = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($route) {
        ?>
        <h3>Edit Bus Route</h3>
        <form method="POST">
            <input type="hidden" name="route_id" value="<?php echo $route['id']; ?>">
            <div class="mb-3">
                <input type="text" name="bus_no" value="<?php echo $route['bus_no']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="text" name="bus_station" value="<?php echo $route['bus_station']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="time" name="time" value="<?php echo $route['time']; ?>" class="form-control" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update Bus Route</button>
        </form>
        <?php
    } else {
        echo "Bus route not found.";
    }
}
?>

</div>
<a class="btn btn-secondary mt-3" href="../admin.php">Back to Admin Page</a>
