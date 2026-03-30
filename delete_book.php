<?php
include 'includes/database.php';

if(isset($_GET['b_id'])){
    $b_id = intval($_GET['b_id']);

    // delete from books (stock will auto delete because of FK)
    $query = "DELETE FROM books WHERE b_id = $b_id";

    if(mysqli_query($conn, $query)){
        header("Location: books.php?msg=deleted");
    } else {
        echo "Error deleting book";
    }
}
?>