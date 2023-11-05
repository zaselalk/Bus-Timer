<?php
include_once '../partials/header.php';
include_once '../conn.php';
include_once './admin_navbar.php';
include_once './is_admin.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $bus_no = $_POST['bus_no'];
    $complain = $_POST['complain'];


    $sql = "INSERT INTO bus_complains (bus_no, complain) VALUES ('$bus_no', '$complain')";
    if ($conn->query($sql) === TRUE) {
        echo "Complaint created successfully.";
    } else {
        echo "Error creating complaint: ";
    }
}

$complaintList = [];


$get_complains = "SELECT * FROM bus_complains";
$stmt = $conn->query($get_complains);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $complaintList[] = $row;
    }
}

?>

<div class="container mt-4">
    <?php
    include_once './admin_navbar.php';
    ?>
    <h1>Manage Bus Complaints</h1>



    <h3>Complaints List</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Bus Number</th>
                <th>Complaint</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($complaintList as $complaint) {
                echo "<tr>";
                echo "<td>" . $complaint["id"] . "</td>";
                echo "<td>" . $complaint["bus_no"] . "</td>";
                echo "<td>" . $complaint["complain"] . "</td>";
                echo "<td>
                    <a href='bus_complains.php?edit=" . $complaint["id"] . "' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='bus_complains.php?delete=" . $complaint["id"] . "' class='btn btn-danger btn-sm'>Delete</a>
                </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>


</div>