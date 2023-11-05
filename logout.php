<?php
session_start();
if (isset($_GET['logout'])) {
    unset($_SESSION['user']); // Unset the specific session variable
    session_destroy(); // Destroy the session
    header("location: index.php");
} else {
    header("location: login.php");
}
?>
