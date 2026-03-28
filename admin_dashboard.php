<?php
session_start();
include 'includes/database.php';

/*if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}*/

$totalCopiesQuery = $conn->query("SELECT SUM(copies) AS total FROM bookstock");
$totalCopies = $totalCopiesQuery->fetch_assoc()['total'] ?? 0;

$totalTitlesQuery = $conn->query("SELECT COUNT(*) AS total FROM books");
$totalTitles = $totalTitlesQuery->fetch_assoc()['total'] ?? 0;

$totalUsersQuery = $conn->query("SELECT COUNT(*) AS total FROM users");
$totalUsers = $totalUsersQuery->fetch_assoc()['total'] ?? 0;

$months = ['Jan','Feb','Mar','Apr','May','Jun'];
$borrowData = [];
foreach($months as $i => $month){
    $monthNum = $i + 1;
    $row = $conn->query("SELECT COUNT(*) AS total FROM borrows WHERE MONTH(borrow_date) = $monthNum")->fetch_assoc();
    $borrowData[] = $row['total'] ?? 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Sarasavi Library</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="sidebar">
    <h3>📚 Sarasavi Admin</h3>
    <a href="#" class="active"><i class="fas fa-home"></i> Dashboard</a>
    <a href="bookregistration.php"><i class="fas fa-book-medical"></i> Book Registration</a>
    <a href="manage_books.php"><i class="fas fa-book"></i> Manage Books</a>
    <a href="manage_users.php"><i class="fas fa-users"></i> Users</a>
    <a href="manage_borrows.php"><i class="fas fa-chart-line"></i> Borrow Records</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main">

    <div class="topbar">
        <h4>Dashboard</h4>
        <div class="profile">
            <span>Welcome, Admin 👋</span>
            <img src="https://i.pravatar.cc/150?img=5" alt="Profile">
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-gradient1 text-white text-center">
                <h6>Total Copies</h6>
                <h2><?= $totalCopies ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-gradient2 text-white text-center">
                <h6>Total Titles</h6>
                <h2><?= $totalTitles ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-gradient3 text-white text-center">
                <h6>Total Users</h6>
                <h2><?= $totalUsers ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-gradient4 text-white text-center">
                <h6>Quick Actions</h6>
                <a href="bookregistration.php" class="btn btn-custom mt-2"><i class="fas fa-plus"></i> Add Book</a>
            </div>
        </div>
    </div>

</div>

<footer>
    © 2026 Sarasavi Library | Designed by SarasaviDevops 🚀
</footer>

<script src="script.js"></script>
</body>
</html>