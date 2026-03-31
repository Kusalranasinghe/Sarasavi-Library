<?php
include 'includes/database.php';

if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    mysqli_query($conn, "UPDATE users SET status='approved' WHERE user_id=$id");
    header("Location: admin_dashboard.php#user_requests");
}

if(isset($_GET['reject'])){
    $id = $_GET['reject'];
    mysqli_query($conn, "UPDATE users SET status='rejected' WHERE user_id=$id");
    header("Location: ../admin_dashboard.php#user_requests");
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE status='pending' AND role='user'");
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