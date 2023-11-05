<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Profile</title>
    <?php include_once 'partials/header.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php include_once 'partials/navbar.php'; ?>
    <div class="container">
        <h1 class="text-primary">User Profile</h1>
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
    include_once 'conn.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newName = $_POST['name'];
        $newEmail = $_POST['email'];
        $newDateOfBirth = $_POST['date_of_birth'];
        $newPhoneNumber = $_POST['phone_number'];

        if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
            $uploadDir = 'D:\xampp\htdocs\Bus-Timer\profile_picture';

            $filename = uniqid() . '_' . $_FILES["profile_picture"]["name"];
            $uploadPath = $uploadDir . '/' . $filename;

            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $uploadPath)) {
                echo '<div class="alert alert-success" role="alert">Profile picture uploaded successfully.';

                try {
                    $user_id = $_SESSION['user']['user_id'];
                    $sql = "UPDATE users SET name = ?, email = ?, date_of_birth = ?, phone_number = ?, user_profile_pic = ? WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$newName, $newEmail, $newDateOfBirth, $newPhoneNumber, $filename, $user_id]);
                } catch (PDOException $e) {
                    echo '<div class="alert alert-danger" role="alert">Error updating the profile.</div>';
                }
            } else {
                echo "Error uploading the profile picture.";
            }
        } else {
            echo "No file uploaded or an error occurred during the upload.";
        }
    }
    ?>
</body>

</html>