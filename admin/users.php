<?php
include_once '../partials/header.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_timer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $date_of_birth = $_POST['date_of_birth'];
    $phone_number = $_POST['phone_number'];
    $is_admin = $_POST['is_admin'];


    $stmt = $conn->prepare("INSERT INTO users (name, email, hash_password, date_of_birth, phone_number, is_admin) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $password, $date_of_birth, $phone_number, $is_admin);
    if ($stmt->execute()) {
        echo "User created successfully.";
    } else {
        echo "Error creating user: " . $stmt->error;
    }
}


$userList = [];
$result = $conn->query("SELECT * FROM users");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userList[] = $row;
    }
} else {
    echo "No users found.";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone_number = $_POST['phone_number'];
    $is_admin = $_POST['is_admin'];


    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, date_of_birth=?, phone_number=?, is_admin=? WHERE user_id=?");
    $stmt->bind_param("sssssi", $name, $email, $date_of_birth, $phone_number, $is_admin, $user_id);
    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user: " . $stmt->error;
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }
    $stmt->close();
}

?>

<div class="container mt-4">
    <h1>Manage Users</h1>


    <form method="POST">
        <h3>Create User</h3>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="date" name="date_of_birth" required>
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        <select name="is_admin" required>
            <option value="1">Admin</option>
            <option value="0">User</option>
        </select>
        <button type="submit" name="create">Create User</button>
    </form>


    <h3>Users List</h3>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Phone Number</th>
            <th>Is Admin</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach ($userList as $user) {
            echo "<tr>";
            echo "<td>" . $user["user_id"] . "</td>";
            echo "<td>" . $user["name"] . "</td>";
            echo "<td>" . $user["email"] . "</td>";
            echo "<td>" . $user["date_of_birth"] . "</td>";
            echo "<td>" . $user["phone_number"] . "</td>";
            echo "<td>" . ($user["is_admin"] ? "Admin" : "User") . "</td>";
            echo "<td>
                <a href='users.php?edit=" . $user["user_id"] . "'>Edit</a>
                <a href='users.php?delete=" . $user["user_id"] . "'>Delete</a>
            </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <?php
    if (isset($_GET['edit'])) {
        $user_id = $_GET['edit'];
        $editUser = $conn->query("SELECT * FROM users WHERE user_id = $user_id");
        if ($editUser->num_rows == 1) {
            $user = $editUser->fetch_assoc();
    ?>
            <h3>Edit User</h3>
            <form method="POST">
                <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                <input type="date" name="date_of_birth" value="<?php echo $user['date_of_birth']; ?>" required>
                <input type="text" name="phone_number" value="<?php echo $user['phone_number']; ?>" required>
                <select name="is_admin" required>
                    <option value="1" <?php echo $user['is_admin'] == 1 ? 'selected' : ''; ?>>Admin</option>
                    <option value="0" <?php echo $user['is_admin'] == 0 ? 'selected' : ''; ?>>User</option>
                </select>
                <button type="submit" name="update">Update User</button>
            </form>
    <?php } else {
            echo "User not found.";
        }
    }
    ?>
</div>
<a class="btn btn-secondary mt-3" href="../admin.php">Back to Admin Page</a>