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
        <?php
        include_once 'conn.php';

        $user_id = $_SESSION['user']['user_id'];
        $sql = "SELECT user_profile_pic FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $userProfilePic = $stmt->fetchColumn();
        if (is_null($userProfilePic)) {
            $userProfilePic = 'profile_picture\default.png';
        }else{
            $userProfilePic = 'profile_picture\\'. $userProfilePic;
        }
        // echo $userProfilePic;
        $sql = "SELECT name, email, date_of_birth, phone_number FROM users WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result[0]['name']
        ?>
        <img src="<?php echo $userProfilePic; ?>" alt="Profile Picture" class="img-fluid" width="200px" style="border-radius: 45%;">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" value=<?php echo $result[0]['name']; ?>>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" value=<?php echo $result[0]['email']; ?>>
            </div>

            <div class "form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth" value=<?php echo $result[0]['date_of_birth']; ?>>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="tel" class="form-control" name="phone_number" value=<?php echo $result[0]['phone_number']; ?>>
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
        $newName = $_POST['name'];
        $newEmail = $_POST['email'];
        $newDateOfBirth = $_POST['date_of_birth'];
        $newPhoneNumber = $_POST['phone_number'];

        if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
            $uploadDir = 'C:\wamp64\www\Bus-Timer\profile_picture';

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