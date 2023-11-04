<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=bus_timer", $dbUser, $dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; // You can replace this with any action you want upon successful connection
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
