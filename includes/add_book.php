<?php
include '../includes/database.php';

if(isset($_POST['add_book'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);
    $copies = intval($_POST['copies']);
    $cover = mysqli_real_escape_string($conn, $_POST['cover_image']);

    // Insert into books table
    $insertBook = "INSERT INTO books (title, author, cover_image) VALUES ('$title', '$author', '$cover')";
    if(mysqli_query($conn, $insertBook)){
        $b_id = mysqli_insert_id($conn); // Get the last inserted book ID

        // Insert into bookstock table
        $insertStock = "INSERT INTO bookstock (b_id, copies) VALUES ($b_id, $copies)";
        mysqli_query($conn, $insertStock);

        header("Location: ../books.php?msg=added");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>