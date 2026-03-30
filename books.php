<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - SarasaviLibrary</title>
    <link rel="stylesheet" href="css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<!-- Navbar -->
<header class="header">
    <a href="admin_dashboard.php" class="logo">Sarasavi Library</a>
    <i class='bx bx-menu' id="menu-icon"></i>
    <nav class="navbar">
        <a href="admin_dashboard.php">Back to Dashboard</a>  
        <a href="#footer">Contact Us</a>
        <div class="nav-buttons">
            <button class="btn-login" onclick="window.location.href='includes/logout.php'">Logout</button>
        </div>
    </nav>
</header>






    <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>