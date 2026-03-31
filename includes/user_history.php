<?php
include 'includes/database.php';

// Fetch approved + rejected users
$result = mysqli_query($conn, "SELECT * FROM users WHERE status != 'pending' ORDER BY updated_at DESC");
?>

<div class="books-section">
    <h2>User Requests History</h2>
    <hr>

    <table class="books-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>NIC</th>
                <th>Role</th>
                <th>Status</th>
                <th>Updated</th>
            </tr>
        </thead>
        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['nic']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td>
                    <?php
                        if($row['status'] == 'approved'){
                            echo "<span style='color:green; font-weight:bold;'>Approved</span>";
                        } else {
                            echo "<span style='color:red; font-weight:bold;'>Rejected</span>";
                        }
                    ?>
                </td>
                <td><?php echo $row['updated_at']; ?></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>