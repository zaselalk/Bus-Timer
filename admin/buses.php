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
    $bus_name = $_POST['bus_name'];
    $bus_driver = $_POST['bus_driver'];

    $stmt = $conn->prepare("INSERT INTO buses (bus_no, bus_name, bus_driver) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $bus_no, $bus_name, $bus_driver);

    if ($stmt->execute()) {
        echo "Bus created successfully.";
    } else {
        echo "Error creating bus: " . $stmt->error;
    }
}

$busesList = [];
$result = $conn->query("SELECT * FROM buses");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $busesList[] = $row;
    }
} else {
    echo "No buses found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $bus_id = $_POST['bus_id'];
    $bus_no = $_POST['bus_no'];
    $bus_name = $_POST['bus_name'];
    $bus_driver = $_POST['bus_driver'];

    $stmt = $conn->prepare("UPDATE buses SET bus_no=?, bus_name=?, bus_driver=? WHERE id=?");
    $stmt->bind_param("sssi", $bus_no, $bus_name, $bus_driver, $bus_id);

    if ($stmt->execute()) {
        echo "Bus updated successfully.";
    } else {
        echo "Error updating bus: " . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $bus_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM buses WHERE id=?");
    $stmt->bind_param("i", $bus_id);

    if ($stmt->execute()) {
        echo "Bus deleted successfully.";
    } else {
        echo "Error deleting bus: " . $stmt->error;
    }
    $stmt->close();
}
?>

<div class="container mt-4">
    <h1>Manage Buses</h1>

    <form method="POST">
        <h3>Create Bus</h3>
            <input type="text" name="bus_no" class="form-control" placeholder="Bus Number" required>
            <input type="text" name="bus_name" class="form-control" placeholder="Bus Name" required>
            <input type="text" name="bus_driver" class="form-control" placeholder="Bus Driver" required>
        <button type="submit" name="create" class="btn btn-primary">Create Bus</button>
    </form>

    <h3>Buses List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Bus ID</th>
                <th>Bus Number</th>
                <th>Bus Name</th>
                <th>Bus Driver</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($busesList as $bus) {
                echo '<tr>
                    <td>' . $bus["id"] . '</td>
                    <td>' . $bus["bus_no"] . '</td>
                    <td>' . $bus["bus_name"] . '</td>
                    <td>' . $bus["bus_driver"] . '</td>
                    <td>
                        <a href="buses.php?edit=' . $bus["id"] . '" class="btn btn-info btn-sm">Edit</a>
                        <a href="buses.php?delete=' . $bus["id"] . '" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<a class="btn btn-secondary mt-3" href="../admin.php">Back to Admin Page</a>