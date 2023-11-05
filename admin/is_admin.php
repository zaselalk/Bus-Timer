<?php


if (!isset($_SESSION['user'])) {
    header("location: /bus-timer/index.php");
}



if ($_SESSION['user']['is_admin'] == 'N') {
    header("location: /bus-timer/index.php");
}
