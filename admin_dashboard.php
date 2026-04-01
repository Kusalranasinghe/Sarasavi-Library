<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$role = $_SESSION['user']['role'];

// Only admin & super admin allowed
if($role != 'admin' && $role != 'super_admin'){
    header("Location: user_dashboard.php");
    exit();
}

$admin_name = $_SESSION['user']['name'];
include 'includes/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SarasaviLibrary</title>
    <link rel="stylesheet" href="css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- Navbar -->
<header class="header">
    <a href="admin_dashboard.php" class="logo">Sarasavi Library</a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
        <a href="#user_requests">User Requests</a>
        <a href="#requests">Borrow Requests</a>
        <a href="#user_history">User History</a>
        <a href="#history">History</a>
        <a href="books.php">Books</a>
        <a href="users.php">Users</a>  
        <a href="#footer">Contact Us</a>
        <div class="nav-buttons">
            <button class="btn-login" onclick="window.location.href='includes/logout.php'">Logout</button>
        </div>
    </nav>
</header>

<!-- Home Section -->
<section id="home">
    <div class="home-container">
        <h1 class="home-title">Welcome, <?php echo htmlspecialchars($admin_name); ?>!</h1>                        
        <p class="home-text">Manage books, track borrow requests, and oversee library users.</p>
        <a href="books.php#view_book" class="btn">View Books</a>
        <a href="#requests" class="btn">Borrow Requests</a>
        <a href="#user_requests" class="btn">User Requests</a>
    </div>
</section>

<!-- User Requests Section -->
<section id="user_requests">
    <?php include 'includes/user_requests.php'; ?>
</section>

<!-- Requests Section -->
<section id="requests">
    <?php include 'includes/requests.php'; ?>
</section>

<!-- User Requests History Section -->
<section id="user_history">
    <?php include 'includes/user_history.php'; ?>
</section>

<!-- History Section -->
<section id="history">
    <?php include 'includes/history.php'; ?>
</section>




    <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>