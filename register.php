<?php
include "includes/database.php";
session_start();

if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $nic = $_POST['nic'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // default status = pending
    $status = "pending";

    if ($role == "admin" && (!isset($_SESSION['role']) || $_SESSION['role'] != 'super_admin')) {
        $error = "Only Super Admin can request Admin account.";
    } else {

        $stmt = $conn->prepare("INSERT INTO users (name,email,password,phone,nic,address,role,status,created_at,updated_at) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->bind_param("ssssssss", $name, $email, $password, $phone, $nic, $address, $role, $status);

        if ($stmt->execute()) {

            if ($role == "admin") {
                $success = "Admin request sent to Super Admin.";
            } else {
                $success = "User registered! Wait for Admin approval.";
            }

        } else {
            $error = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - SarasaviLibrary</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>

<div class="auth-container">
    <h2>Register</h2>

    <?php
    if(isset($error)) echo "<p class='error-msg'>$error</p>";
    if(isset($success)) echo "<p class='success-msg'>$success</p>";
    ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="text" name="phone" placeholder="Phone">
        <input type="text" name="nic" placeholder="NIC">
        <textarea name="address" placeholder="Address"></textarea>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <div class="role-select">
            <label>Select Role</label>
            <div class="role-options">
                <input type="radio" name="role" id="user" value="user" required>
                <label for="user" class="role-card">👤 User</label>

                <input type="radio" name="role" id="admin" value="admin" required>
                <label for="admin" class="role-card">🛡 Admin</label>
            </div>
        </div>

        <button name="register">Register</button>
    </form>

    <p><a href="login.php">Login</a></p>
</div>

</body>
</html>