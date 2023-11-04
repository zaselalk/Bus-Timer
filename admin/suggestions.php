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
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO suggestions (message) VALUES (?)");
    $stmt->bind_param("s", $message);

    if ($stmt->execute()) {
        echo "Suggestion added successfully.";
    } else {
        echo "Error adding suggestion: " . $stmt->error;
    }
}

$suggestionsList = [];
$result = $conn->query("SELECT * FROM suggestions");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suggestionsList[] = $row;
    }
} else {
    echo "No suggestions found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $suggestion_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM suggestions WHERE id=?");
    $stmt->bind_param("i", $suggestion_id);

    if ($stmt->execute()) {
        echo "Suggestion deleted successfully.";
    } else {
        echo "Error deleting suggestion: " . $stmt->error;
    }
    $stmt->close();
}
?>

<div class="container mt-4">
    <h1>Manage Bus Suggestions</h1>

    <form method="POST">
        <h3>Add Suggestion</h3>
        <div class="mb-3">
            <textarea name="message" class="form-control" rows="3" placeholder="Suggestion" required></textarea>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Add Suggestion</button>
    </form>

    <h3>Suggestions List</h3>
    <ul class="list-group">
        <?php
        foreach ($suggestionsList as $suggestion) {
            echo '<li class="list-group-item">' . $suggestion["message"] . '
                <a href="bus_suggestions.php?delete=' . $suggestion["id"] . '" class="btn btn-danger btn-sm float-end">Delete</a>
            </li>';
        }
        ?>
    </ul>
</div>

<a class="btn btn-secondary mt-3" href="../admin.php">Back to Admin Page</a>