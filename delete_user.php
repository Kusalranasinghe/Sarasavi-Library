<?php
include 'includes/database.php';

if(!isset($_GET['user_id'])){
    header("Location: users.php");
    exit;
}

$user_id = intval($_GET['user_id']);
$result = mysqli_query($conn, "SELECT role FROM users WHERE user_id=$user_id");
$user = mysqli_fetch_assoc($result);

// Check if user exists
if(!$user){
    header("Location: users.php");
    exit;
}

// Prevent deletion of admins/super admins
if($user['role'] != 'user'){
    echo "<script>alert('Cannot delete Admin or Super Admin!'); window.location='users.php';</script>";
    exit;
}

// Delete user
mysqli_query($conn, "DELETE FROM users WHERE user_id=$user_id");
header("Location: users.php");
exit;
?>