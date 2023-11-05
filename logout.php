<?php
session_start(); // Start the session


    unset($_SESSION['user']); // Unset the specific session variable
    session_destroy(); // Destroy the session

    print_r($_SESSION['user']);

    header("location: index.php");

 
?>
