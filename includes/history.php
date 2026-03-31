<?php
include 'includes/database.php';

// Fetch all borrow records
$query = "SELECT borrows.borrow_id, books.title, users.name AS user_name, borrows.borrow_date, borrows.return_date, borrows.status
          FROM borrows
          JOIN books ON borrows.b_id = books.b_id
          JOIN users ON borrows.user_id = users.user_id
          ORDER BY borrows.borrow_date DESC";
$result = $conn->query($query);
?>

<div class="books-section">
    <h2>Borrow History</h2><hr>
    <table class="books-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Book</th>
                <th>User</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
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
                    <td><?php echo ucfirst($row['status']); ?></td>
                </tr>
            <?php endwhile; else: ?>
                <tr>
                    <td colspan="6">No borrow history found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>