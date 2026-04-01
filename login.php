<?php
session_start();
include "includes/database.php";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Check if approved
        if ($user['status'] != 'approved') {
            echo "<script>alert('Account not approved yet');</script>";
        } 
        // Compare plain password (no hashing)
        else if ($password === $user['password']) {

            // Set sessions
            $_SESSION['user'] = $user; 
            // Redirect based on role 
            if ($user['role'] == 'super_admin') { 
                header("Location: super_admin_dashboard.php"); 
                exit(); 
                
            } 
            else if ($user['role'] == 'admin') { 
                header("Location: admin_dashboard.php"); 
                exit(); 
            } 
            else { 
                header("Location: user_dashboard.php"); 
                exit(); 
            } 
            } else { 
                echo "<script>alert('Wrong password');</script>"; 
            } 
        } else { 
            echo "<script>alert('User not found');</script>"; 
        } 
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - SarasaviLibrary</title>
    <link rel="stylesheet" href="css/auth.css">
</head>
<body>

<div class="auth-container">
    <h2>Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button name="login">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>
</html>