<?php
include 'includes/database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Sarasavi Library</title>
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
        <a href="#add_book">Add Books</a>
        <a href="#view_book">View Books</a>
        <div class="nav-buttons">
            <button class="btn-login" onclick="window.location.href='includes/logout.php'">Logout</button>
        </div>
    </nav>
</header>

<section id="view_book">
<div style="padding-top:20px;">
    <div class="books-section">
        <h2>Books List</h2><hr><br>
        <table class="books-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM books";
            $result = mysqli_query($conn, $query);
            while($book = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>{$book['b_id']}</td>";
                echo "<td>{$book['title']}</td>";
                echo "<td>
                        <form method='GET' action='books.php'>
                            <input type='hidden' name='b_id' value='{$book['b_id']}'>
                            <button type='submit'>View Info</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
<?php
if(isset($_GET['b_id'])){
    $b_id = intval($_GET['b_id']);
    $query = "SELECT books.*, bookstock.copies FROM books 
              LEFT JOIN bookstock ON books.b_id = bookstock.b_id 
              WHERE books.b_id = $b_id";
    $result = mysqli_query($conn, $query);

    if($book = mysqli_fetch_assoc($result)){
?>
    <div class="book-card-overlay">
        <div class="book-card">

            <a href="books.php" class="close-btn">&times;</a>

            <h2><?php echo $book['title']; ?></h2>

            <?php if(!empty($book['cover_image'])){ ?>
                <img src="<?php echo $book['cover_image']; ?>" alt="Cover">
            <?php } ?>

            <p><strong>ID:</strong> <?php echo $book['b_id']; ?></p>
            <p><strong>Author:</strong> <?php echo $book['author']; ?></p>
            <p><strong>Copies:</strong> <?php echo $book['copies']; ?></p>

            <div class="card-buttons">
                <a href="edit_book.php?b_id=<?php echo $book['b_id']; ?>" class="edit-btn">Edit</a>
                <a href="delete_book.php?b_id=<?php echo $book['b_id']; ?>" class="delete-btn"
                   onclick="return confirm('Delete this book?');">Delete</a>
            </div>

        </div>
    </div>
<?php
    }
}
?>
</div>
</section>

<section id="add_book">
    <div class="edit-container">
        <h2>Add New Book</h2>
        <hr>

        <form method="POST" action="includes/add_book.php">
            <input type="text" name="title" placeholder="Book Title" required>
            <input type="text" name="author" placeholder="Author Name" required>
            <input type="number" name="copies" placeholder="Number of Copies" min="1" required>
            <input type="url" name="cover_image" placeholder="Cover Image URL (https://example.com/book.jpg)">

            <div class="form-buttons">
                <button type="submit" name="add_book">Add Book</button>
                <a href="#view_book" class="cancel-btn">Cancel</a>
            </div>
        </form>
    </div>
</section>



    <?php include 'includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>