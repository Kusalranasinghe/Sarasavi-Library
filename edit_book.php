<?php
include 'includes/database.php';

if(isset($_GET['b_id'])){
    $b_id = intval($_GET['b_id']);

    $query = "SELECT books.*, bookstock.copies 
              FROM books 
              LEFT JOIN bookstock ON books.b_id = bookstock.b_id
              WHERE books.b_id = $b_id";

    $result = mysqli_query($conn, $query);
    $book = mysqli_fetch_assoc($result);
}

if(isset($_POST['update'])){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $copies = $_POST['copies'];
    $cover = $_POST['cover_image'];

    mysqli_query($conn, "UPDATE books 
                         SET title='$title', author='$author', cover_image='$cover' 
                         WHERE b_id=$b_id");

    mysqli_query($conn, "UPDATE bookstock 
                         SET copies='$copies' 
                         WHERE b_id=$b_id");

    header("Location: books.php?msg=updated");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="edit-container">
    <h2>Edit Book</h2><hr>

    <?php if(!empty($book['cover_image'])){ ?>
        <img id="preview" src="<?php echo $book['cover_image']; ?>">
    <?php } else { ?>
        <img id="preview" style="display:none;">
    <?php } ?>

    <form method="POST">
        <input type="text" name="title"
               value="<?php echo $book['title']; ?>"
               placeholder="Book Title" required>
        <input type="text" name="author"
               value="<?php echo $book['author']; ?>"
               placeholder="Author Name" required>
        <input type="number" name="copies"
               value="<?php echo $book['copies']; ?>"
               placeholder="Number of Copies" required>
        <input type="url" name="cover_image"
               value="<?php echo $book['cover_image']; ?>"
               placeholder="Enter image URL (https://example.com/book.jpg)">

        <div class="form-buttons">
            <button type="submit" name="update">Update Book</button>
            <a href="books.php" class="cancel-btn">Cancel</a>
        </div>
    </form>
</div>

<script>
document.querySelector('[name="cover_image"]').addEventListener('input', function() {
    const preview = document.getElementById('preview');
    preview.src = this.value;
    preview.style.display = this.value ? 'block' : 'none';
});
</script>

</body>
</html>
