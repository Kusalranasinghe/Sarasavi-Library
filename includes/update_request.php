<?php
include '../includes/database.php';

if(isset($_GET['id'], $_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if($action === 'approve') {
        $status = 'approved';
    } elseif($action === 'decline') {
        $status = 'declined';
    } else {
        die("Invalid action.");
    }

    $stmt = $conn->prepare("UPDATE borrows SET status = ? WHERE borrow_id = ?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: ../admin_dashboard.php#requests");
exit;
?>