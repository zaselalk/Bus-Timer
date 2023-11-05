<?php
include_once '../partials/header.php';
include_once '../conn.php';
include_once './admin_navbar.php';
 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $bus_no = $_POST['bus_no'];
    $bus_name = $_POST['bus_name'];
    $bus_driver = $_POST['bus_driver'];

    // $stmt = $conn->prepare("INSERT INTO buses (bus_no, bus_name, bus_driver) VALUES (?, ?, ?)");
    // $stmt->bind_param("sss", $bus_no, $bus_name, $bus_driver);

    // if ($stmt->execute()) {
    //     echo "Bus created successfully.";
    // } else {
    //     echo "Error creating bus: " . $stmt->error;
    // }

    $sql = "INSERT INTO buses (bus_no, bus_name, bus_driver) VALUES ('$bus_no', '$bus_name', '$bus_driver')";
    if ($conn->query($sql) === TRUE) {
        echo "Bus created successfully.";
    } else {
        echo "Error creating bus: " ;
    }
}

$busesList = [];
// $result = $conn->query("SELECT * FROM buses");
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $busesList[] = $row;
//     }
// } else {
//     echo "No buses found.";
// }

$sql = "SELECT * FROM buses";
$stmt = $conn->query($sql);

if($stmt->rowCount() > 0){
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $busesList[] = $row;
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $bus_id = $_POST['bus_id'];
    $bus_no = $_POST['bus_no'];
    $bus_name = $_POST['bus_name'];
    $bus_driver = $_POST['bus_driver'];

    // $stmt = $conn->prepare("UPDATE buses SET bus_no=?, bus_name=?, bus_driver=? WHERE id=?");
    // $stmt->bind_param("sssi", $bus_no, $bus_name, $bus_driver, $bus_id);

    // if ($stmt->execute()) {
    //     echo "Bus updated successfully.";
    // } else {
    //     echo "Error updating bus: " . $stmt->error;
    // }

    $update_sql = "UPDATE buses SET bus_no='$bus_no', bus_name='$bus_name', bus_driver='$bus_driver' WHERE id='$bus_id'";

    if ($conn->query($update_sql) === TRUE) {
        echo "Bus updated successfully.";
    } else {
        echo "Error updating bus: " ;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $bus_id = $_GET['delete'];
//     $stmt = $conn->prepare("DELETE FROM buses WHERE id=?");
//     $stmt->bind_param("i", $bus_id);

//     if ($stmt->execute()) {
//         echo "Bus deleted successfully.";
//     } else {
//         echo "Error deleting bus: " . $stmt->error;
//     }
//     $stmt->close();
// }

    $delete_sql = "DELETE FROM buses WHERE id='$bus_id'";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Bus deleted successfully.";
    } else {
        echo "Error deleting bus: " ;
    }
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

