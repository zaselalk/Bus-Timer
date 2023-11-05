<?php
include_once '../partials/header.php';
include_once '../conn.php';
include_once './admin_navbar.php';
include_once './is_admin.php';

try {



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