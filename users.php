<?php
session_start();
include 'includes/database.php';

// Only admin or super_admin can access
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'super_admin'])) {
    header("Location: login.php");
    exit;
}

$role = $_SESSION['role']; // safe to use now
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users - SarasaviLibrary</title>
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
        <a href="#view_users">View Users</a>
        <a href="#add_user">Add User</a>
        <div class="nav-buttons">
            <button class="btn-login" onclick="window.location.href='includes/logout.php'">Logout</button>
        </div>
    </nav>
</header>

<!-- View Users -->
<section id="view_users">
    <div class="books-section">
        <h2>Users List</h2>
        <hr>
        <table class="books-table">
            <thead>
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM users WHERE status='approved' AND role IN ('user','admin','super_admin')";
            $result = mysqli_query($conn, $query);

            while($user = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>{$user['user_id']}</td>";
                echo "<td>{$user['name']}</td>";
                echo "<td>{$user['role']}</td>";
                echo "<td>
                        <form method='GET' action='users.php'>
                            <input type='hidden' name='user_id' value='{$user['user_id']}'>
                            <button type='submit'>View Info</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<!-- View User Card -->
<?php
if(isset($_GET['user_id'])){
    $user_id = intval($_GET['user_id']);
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    if($user = mysqli_fetch_assoc($result)){
        $readonly = ($user['role'] != 'user'); // Admin / Super Admin are readonly
?>
<div class="book-card-overlay">
    <div class="book-card">
        <a href="users.php" class="close-btn">&times;</a>

        <h2><?php echo $user['name']; ?> (<?php echo $user['role']; ?>)</h2>

        <p><strong>Member ID:</strong> <?php echo $user['user_id']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
        <p><strong>NIC:</strong> <?php echo $user['nic']; ?></p>
        <p><strong>Address:</strong> <?php echo $user['address']; ?></p>
        <p><strong>Role:</strong> <?php echo $user['role']; ?></p>
        <p><strong>Created At:</strong> <?php echo $user['created_at']; ?></p>
        <p><strong>Updated At:</strong> <?php echo $user['updated_at']; ?></p>

        <?php if(!$readonly){ ?>
        <div class="card-buttons">
            <a href="edit_user.php?user_id=<?php echo $user['user_id']; ?>" class="edit-btn">Edit</a>
            <a href="delete_user.php?user_id=<?php echo $user['user_id']; ?>" class="delete-btn"
               onclick="return confirm('Delete this user?');">Delete</a>
        </div>
        <?php } else { ?>
        <p class="readonly-note">Admin and Super Admin info cannot be changed.</p>
        <?php } ?>
    </div>
</div>
<?php
    }
}
?>

<!-- Add User Section -->
<section id="add_user">
    <div class="edit-container">
        <h2>Add New User</h2>
        <hr>

        <?php
        if(isset($_POST['add_user'])){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $nic = mysqli_real_escape_string($conn, $_POST['nic']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $role_post = mysqli_real_escape_string($conn, $_POST['role']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            // Only super_admin can create admin or super_admin
            if(in_array($role_post, ['admin','super_admin']) && $_SESSION['role'] != 'super_admin'){
                echo "<p class='error-msg'>Only Super Admin can create Admin or Super Admin.</p>";
            } else {
                $insert = "INSERT INTO users (name,email,phone,nic,address,role,password,created_at,updated_at,status)
                           VALUES ('$name','$email','$phone','$nic','$address','$role_post','$password',NOW(),NOW(),'approved')";

                if(mysqli_query($conn, $insert)){
                    echo "<p class='success-msg'>User added successfully!</p>";
                } else {
                    echo "<p class='error-msg'>Failed to add user: " . mysqli_error($conn) . "</p>";
                }
            }
        }
        ?>

        <form method="POST" action="#add_user">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone">
            <input type="text" name="nic" placeholder="NIC">
            <input type="text" name="address" placeholder="Address">
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="user">User</option>
                <?php if($_SESSION['role'] == 'super_admin'){ ?>
                    <option value="admin">Admin</option>
                    <option value="super_admin">Super Admin</option>
                <?php } ?>
            </select>

            <div class="form-buttons">
                <button type="submit" name="add_user">Add User</button>
                <a href="#view_users" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
<script src="js/script.js"></script>
</body>
</html>