<?php
include_once 'partials/header.php';
?>
<title>Contact Page - Suggestions</title>
</head>

<body>
    <?php include_once 'partials/navbar.php';
    include_once 'conn.php';

    $message = "";
    $message_error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["suggestion_form"])) {
            $message = htmlspecialchars($_POST["message"]);

            try {
                $stmt = $conn->prepare("INSERT INTO suggestions (message) VALUES (?)");
                $stmt->execute([$message]);

                $message = "";
                echo "<h5 class='text-success'>Suggestion submitted successfully</h5>";
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
        <title>Contact Us - Suggestions</title>
        <link rel="stylesheet" href="styles/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <h1 class="mt-3 mb-3">Suggestions</h1>
            <div class="col-md-6">
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

        <script src="scripts/bootstrap.min.js"></script>
    </body>

    </html>