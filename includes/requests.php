<?php
include 'includes/database.php'; // Your DB connection

// Fetch pending borrow requests
$query = "SELECT borrows.borrow_id, books.title, users.name AS user_name, borrows.borrow_date, borrows.return_date
          FROM borrows
          JOIN books ON borrows.b_id = books.b_id
          JOIN users ON borrows.user_id = users.user_id
          WHERE borrows.status = 'pending'
          ORDER BY borrows.borrow_date ASC";
$result = $conn->query($query);
?>

<div class="books-section">
    <h2>Pending Borrow Requests</h2><hr>
    <table class="books-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Book</th>
                <th>User</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): 
                $count = 1;
                while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo $row['borrow_date']; ?></td>
                    <td><?php echo $row['return_date']; ?></td>
                    <td>
                        <a href="includes/update_request.php?id=<?php echo $row['borrow_id']; ?>&action=approve" class="edit-btn">Approve</a>
                        <a href="includes/update_request.php?id=<?php echo $row['borrow_id']; ?>&action=decline" class="delete-btn">Decline</a>
                    </td>
                </tr>
            <?php endwhile; else: ?>
                <tr>
                    <td colspan="6">No pending requests.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>