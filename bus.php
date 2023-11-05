<?php
include_once 'partials/header.php';
?>

<title>Bus</title>

<?php
include_once 'partials/navbar.php';
include_once 'conn.php';

?>

<body>
    <?php include_once 'partials/navbar.php'; ?>
    <div class="container mt-5">
        <?php
        include_once 'conn.php';
        // Check if the 'id' parameter is set in the URL
        if (isset($_GET['id'])) {
            $busId = $_GET['id'];
            // Retrieve the bus details from the 'buses' table based on the provided 'id'
            $query = "SELECT * FROM buses WHERE bus_no = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $busId);
            $stmt->execute();
            $bus = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($bus) {
                // Display the details of the specific bus
                echo '<h2>Bus Details</h2>';
                echo '<p><strong>Bus Number:</strong> ' . $bus['bus_no'] . '</p>';
                echo '<p><strong>Bus Name:</strong> ' . $bus['bus_name'] . '</p>';
                echo '<p><strong>Bus Driver:</strong> ' . $bus['bus_driver'] . '</p>';

                // load all the bus routes for this bus

                $query = "SELECT * FROM bus_route WHERE bus_no = :bus_id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':bus_id', $bus['bus_no']);

                $stmt->execute();

                $busRoutes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo '<h3>Bus Routes</h3>';
        ?>
                <table class="table">
                    <tr>
                        <th>Bus Station</th>
                        <th>Time</th>
                    </tr>
            <?php
                foreach ($busRoutes as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['bus_station'] . '</td>';
                    echo '<td>' . $row['time'] . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo '<p>No bus found with the provided ID.</p>';
            }
        } else {
            echo '<p>No bus ID provided.</p>';
        }
            ?>
    </div>
</body>