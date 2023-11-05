<?php
include_once '../partials/header.php';

$servername = "localhost";
$username = "root";
$password = "root1234";
$dbname = "bus_timer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $bus_no = $_POST['bus_no'];
    $bus_station = $_POST['bus_station'];
    $time = $_POST['time'];

    $stmt = $conn->prepare("INSERT INTO bus_route (bus_no, bus_station, time) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $bus_no, $bus_station, $time);

    if ($stmt->execute()) {
        echo "Bus route created successfully.";
    } else {
        echo "Error creating bus route: " . $stmt->error;
    }
}

$routeList = [];
$result = $conn->query("SELECT * FROM bus_route");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $routeList[] = $row;
    }
} else {
    echo "No bus routes found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $route_id = $_POST['route_id'];
    $bus_no = $_POST['bus_no'];
    $bus_station = $_POST['bus_station'];
    $time = $_POST['time'];

    $stmt = $conn->prepare("UPDATE bus_route SET bus_no=?, bus_station=?, time=? WHERE id=?");
    $stmt->bind_param("sssi", $bus_no, $bus_station, $time, $route_id);

    if ($stmt->execute()) {
        echo "Bus route updated successfully.";
    } else {
        echo "Error updating bus route: " . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $route_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM bus_route WHERE id=?");
    $stmt->bind_param("i", $route_id);

    if ($stmt->execute()) {
        echo "Bus route deleted successfully.";
    } else {
        echo "Error deleting bus route: " . $stmt->error;
    }
    $stmt->close();
}
?>

<div class="container mt-4">
    <h1>Manage Bus Routes</h1>
    <?php
  include_once './admin_navbar.php';
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
        $editRoute = $conn->query("SELECT * FROM bus_route WHERE id = $route_id");
        if ($editRoute->num_rows == 1) {
            $route = $editRoute->fetch_assoc();
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
    <?php } else {
            echo "Bus route not found.";
        }
    }
    ?>
</div>
<a class="btn btn-secondary mt-3" href="../admin.php">Back to Admin Page</a>
