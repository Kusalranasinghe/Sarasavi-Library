<?php
include 'includes/database.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

$current_role = $_SESSION['user']['role'];

// Only admin & super_admin
if (!in_array($current_role, ['admin', 'super_admin'])) {
    header("Location: ../user_dashboard.php");
    exit();
}

// ======================
// ✅ APPROVE
// ======================
if(isset($_GET['approve'])){
    $id = intval($_GET['approve']);

    // Get target role
    $res = mysqli_query($conn, "SELECT role FROM users WHERE user_id=$id");
    $target = mysqli_fetch_assoc($res);

    if($target){
        // Admin can approve ONLY users
        if($current_role == 'admin' && $target['role'] != 'user'){
            echo "<script>alert('Admin can only approve Users!'); window.location='admin_dashboard.php#user_requests';</script>";
            exit;
        }

        // Super Admin cannot approve another super_admin
        if($current_role == 'super_admin' && $target['role'] == 'super_admin'){
            echo "<script>alert('Cannot approve another Super Admin!'); window.location='super_admin_dashboard.php#user_requests';</script>";
            exit;
        }

        mysqli_query($conn, "UPDATE users SET status='approved' WHERE user_id=$id");
    }

    header("Location: ".$_SERVER['PHP_SELF']."#user_requests");
    exit();
}

// ======================
// ❌ REJECT
// ======================
if(isset($_GET['reject'])){
    $id = intval($_GET['reject']);

    $res = mysqli_query($conn, "SELECT role FROM users WHERE user_id=$id");
    $target = mysqli_fetch_assoc($res);

    if($target){
        if($current_role == 'admin' && $target['role'] != 'user'){
            echo "<script>alert('Admin can only reject Users!'); window.location='admin_dashboard.php#user_requests';</script>";
            exit;
        }

        if($current_role == 'super_admin' && $target['role'] == 'super_admin'){
            echo "<script>alert('Cannot reject another Super Admin!'); window.location='super_admin_dashboard.php#user_requests';</script>";
            exit;
        }

        mysqli_query($conn, "UPDATE users SET status='rejected' WHERE user_id=$id");
    }

    header("Location: ".$_SERVER['PHP_SELF']."#user_requests");
    exit();
}

// ======================
// 📊 FETCH DATA
// ======================
if($current_role == 'super_admin'){
    // Super Admin → users + admins
    $result = mysqli_query($conn,
        "SELECT * FROM users 
         WHERE status='pending' 
         AND role IN ('user','admin')"
    );
} else {
    // Admin → only users
    $result = mysqli_query($conn,
        "SELECT * FROM users 
         WHERE status='pending' 
         AND role='user'"
    );
}
?>

<div class="books-section">
    <h2>User Registration Requests</h2>
    <hr>

    <table class="books-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>NIC</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['nic']; ?></td>
                <td>
                    <a href="?approve=<?php echo $row['user_id']; ?>" class="edit-btn">Approve</a>
                    <a href="?reject=<?php echo $row['user_id']; ?>" class="delete-btn">Reject</a>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>