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
    $complain = $_POST['complain'];

    $stmt = $conn->prepare("INSERT INTO bus_complains (bus_no, complain) VALUES (?, ?)");
    $stmt->bind_param("ss", $bus_no, $complain);

    if ($stmt->execute()) {
        echo "Complaint created successfully.";
    } else {
        echo "Error creating complaint: " . $stmt->error;
    }
}

$complaintList = [];
$result = $conn->query("SELECT * FROM bus_complains");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $complaintList[] = $row;
    }
} else {
    echo "No complaints found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $complaint_id = $_POST['complaint_id'];
    $bus_no = $_POST['bus_no'];
    $complain = $_POST['complain'];

    $stmt = $conn->prepare("UPDATE bus_complains SET bus_no=?, complain=? WHERE id=?");
    $stmt->bind_param("ssi", $bus_no, $complain, $complaint_id);

    if ($stmt->execute()) {
        echo "Complaint updated successfully.";
    } else {
        echo "Error updating complaint: " . $stmt->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $complaint_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM bus_complains WHERE id=?");
    $stmt->bind_param("i", $complaint_id);

    if ($stmt->execute()) {
        echo "Complaint deleted successfully.";
    } else {
        echo "Error deleting complaint: " . $stmt->error;
    }
    $stmt->close();
}
?>

<div class="container mt-4">
    <h1>Manage Bus Complaints</h1>

    <form method="POST">
        <h3>Create Complaint</h3>
        <div class="mb-3">
            <input type="text" name="bus_no" class="form-control" placeholder="Bus Number" required>
        </div>
        <div class="mb-3">
            <textarea name="complain" class="form-control" placeholder="Complaint" rows="4" required></textarea>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Create Complaint</button>
    </form>

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

    <?php
    if (isset($_GET['edit'])) {
        $complaint_id = $_GET['edit'];
        $editComplaint = $conn->query("SELECT * FROM bus_complains WHERE id = $complaint_id");
        if ($editComplaint->num_rows == 1) {
            $complaint = $editComplaint->fetch_assoc();
    ?>
            <h3>Edit Complaint</h3>
            <form method="POST">
                <input type="hidden" name="complaint_id" value="<?php echo $complaint['id']; ?>">
                <div class="mb-3">
                    <input type="text" name="bus_no" value="<?php echo $complaint['bus_no']; ?>" class="form-control" required>
                </div>
                <div class="mb-3">
                    <textarea name="complain" class="form-control" rows="4" required><?php echo $complaint['complain']; ?></textarea>
                </div>
                <button type="submit" name="update" class="btn btn-success">Update Complaint</button>
            </form>
    <?php } else {
            echo "Complaint not found.";
        }
    }
    ?>
</div>
<a class="btn btn-secondary mt-3" href="../admin.php">Back to Admin Page</a>

