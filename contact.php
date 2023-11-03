<?php
$host = "localhost";
$username = "root";
$password = "1234";
$database = "bus_timer";

$bus_no = $complain = $message = "";
$bus_no_error = $complain_error = $message_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["complaint_form"])) {
       
        $bus_no = htmlspecialchars($_POST["bus_no"]);
        $complain = htmlspecialchars($_POST["complain"]);

       
        $mysqli = new mysqli($host, $username, $password, $database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "INSERT INTO bus_complains (bus_no, complain) VALUES (?, ?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $bus_no, $complain);

        if ($stmt->execute()) {
            $bus_no = $complain = "";
            echo "<h5 class='text-success'>Complaint submitted successfully</h5>";
        } else {
            echo "Error: " . $mysqli->error;
        }

        $stmt->close();
        $mysqli->close();
    }

    if (isset($_POST["suggestion_form"])) {
        $message = htmlspecialchars($_POST["message"]);

        $mysqli = new mysqli($host, $username, $password, $database);

        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "INSERT INTO suggestions (message) VALUES (?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $message);

        if ($stmt->execute()) {
            $message = ""; 
            echo "<h5 class='text-success'>Suggestion submitted successfully</h5>";
        } else {
            echo "Error: " . $mysqli->error;
        }

        $stmt->close();
        $mysqli->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-3 mb-3">Contact Us</h1>
        <div class="row">
            <div class="col-md-6">
                <h2 class="mb-3">Complaints</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="complaint_form" value="1">
                    <div class="form-group">
                        <label for="bus_no">Bus Number:</label>
                        <input type="text" class="form-control" name="bus_no" id="bus_no" value="<?php echo $bus_no; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="complain">Complain:</label>
                        <textarea class="form-control" name="complain" id="complain" rows="4" required><?php echo $complain; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Complaint</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2 class="mb-3">Suggestions</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="hidden" name="suggestion_form" value="1">
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" name="message" id="message" rows="4" required><?php echo $message; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Suggestion</button>
                </form>
            </div>
        </div>
    </div>

    <script src="scripts/bootstrap.min.js"></script>
</body>
</html>
