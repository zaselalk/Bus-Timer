<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-primary">User Profile</h1>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newName = $_POST['name'];
            $newEmail = $_POST['email'];
            $newDateOfBirth = $_POST['date_of_birth'];
            $newPhoneNumber = $_POST['phone_number'];

            $servername = "localhost";
            $username = "root";
            $password = "root1234";
            $database = "bus_timer";

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $user_id = 8; // Replace with the actual user ID
            $sql = "UPDATE users SET name=?, email=?, date_of_birth=?, phone_number=? WHERE user_id=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssi", $newName, $newEmail, $newDateOfBirth, $newPhoneNumber, $user_id);

            if (mysqli_stmt_execute($stmt)) {
                echo '<p class="alert alert-success">Profile updated successfully!</p>';
            } else {
                echo '<p class="alert alert-danger">Profile update failed.</p>';
            }

            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value="John Doe">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value="john.doe@example.com">
            </div>

            <div class "form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth" value="1990-01-01">
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" class="form-control" name="phone_number" value="(123) 456-7890">
            </div>

            <div class="form-group">
                <label for="user_profile_pic">Profile Picture:</label>
                <input type="file" name="profile_picture" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
            $uploadDir = 'D:\xampp\htdocs\Bus-Timer\profile_picture';

            $filename = uniqid() . '_' . $_FILES["profile_picture"]["name"];
            $uploadPath = $uploadDir . '/' . $filename;

            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadPath)) {
                echo "Profile picture uploaded successfully. The file is stored as: $uploadPath";

                $servername = "localhost";
                $username = "root";
                $password = "root1234";
                $database = "bus_timer";

                $conn = mysqli_connect($servername, $username, $password, $database);

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $user_id = 8;

                $sql = "UPDATE users SET user_profile_pic = ? WHERE user_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "si", $uploadPath, $user_id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "Profile picture location stored in the database.";
                } else {
                    echo "Error updating the profile picture location in the database: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
                mysqli_close($conn);
            } else {
                echo "Error uploading the profile picture.";
            }
        } else {
            echo "No file uploaded or an error occurred during the upload.";
        }
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
