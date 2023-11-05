<?php
include_once 'partials/header.php';
?>
<title>Contact Page - Complaints</title>
</head>

<body>
    <?php include_once 'partials/navbar.php';
    include_once 'conn.php';

    $bus_no = $complain = "";
    $bus_no_error = $complain_error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["complaint_form"])) {

            $bus_no = htmlspecialchars($_POST["bus_no"]);
            $complain = htmlspecialchars($_POST["complain"]);

            try {

                $stmt = $conn->prepare("INSERT INTO bus_complains (bus_no, complain) VALUES (?, ?)");
                $stmt->execute([$bus_no, $complain]);

                $bus_no = $complain = "";
                echo "<h5 class='text-success'>Complaint submitted successfully</h5>";
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact Us - Complaints</title>
        <link rel="stylesheet" href="styles/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-3 mb-3">Complaints</h1>
            <div class="col-md-6">
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
        </div>

        <script src="scripts/bootstrap.min.js"></script>
    </body>

    </html>