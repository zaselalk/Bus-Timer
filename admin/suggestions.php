<?php
include_once '../partials/header.php';
include_once '../conn.php';
include_once './admin_navbar.php';

try {


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
        $message = $_POST['message'];

        $stmt = $conn->prepare("INSERT INTO suggestions (message) VALUES (?)");
        $stmt->execute([$message]);

        echo "Suggestion added successfully.";
    }

    $stmt = $conn->query("SELECT * FROM suggestions");
    $suggestionsList = $stmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
        $suggestion_id = $_GET['delete'];
        $stmt = $conn->prepare("DELETE FROM suggestions WHERE id=?");
        $stmt->execute([$suggestion_id]);

        echo "Suggestion deleted successfully.";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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