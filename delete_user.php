<?php
session_start();
include 'includes/database.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

if(!isset($_GET['user_id'])){
    header("Location: users.php");
    exit;
}

$current_role = $_SESSION['user']['role'];
$user_id = intval($_GET['user_id']);

// Get target user
$result = mysqli_query($conn, "SELECT role FROM users WHERE user_id=$user_id");
$user = mysqli_fetch_assoc($result);

if(!$user){
    header("Location: users.php");
    exit;
}

$target_role = $user['role'];

/*
RULES:
Admin:
  - can delete ONLY users

Super Admin:
  - can delete users & admins
  - CANNOT delete super_admin
*/

// Admin restriction
if($current_role == 'admin' && $target_role != 'user'){
    echo "<script>alert('Admin can only delete Users!'); window.location='users.php';</script>";
    exit;
}

// Super Admin restriction
if($current_role == 'super_admin' && $target_role == 'super_admin'){
    echo "<script>alert('Cannot delete another Super Admin!'); window.location='users.php';</script>";
    exit;
}

// Delete allowed
mysqli_query($conn, "DELETE FROM users WHERE user_id=$user_id");

header("Location: users.php");
exit;
?>