<?php

include 'database.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <h2>Book Registration</h2>

        <label for="name">Book Title</label>
        <input type="text" id="name" name="name" placeholder="Enter Book Title : ">

        <label for="author">Author</label>
        <input type="text" id="author" name="author" placeholder="Enter Author Name :">

        <label for="category">Category</label>
        <select id="category" name="category">
            <option value="other">Other</option>
            <option value="computing">Computing</option>
            <option value="science">Scienece</option>
            <option value="mathematics">Mathematics</option>
            <option value="technology">Technology</option>
            <option value="novel">Novel</option>
            <option value="kids">Kids</option>

        </select>

        <label for="language">Language</label>
        <input type="text" id="language" name="language" placeholder="Enter Language :">

        <input type="submit" value="Register">
    </form>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $language = $_POST['language'];

    if (empty($name) || empty($author) || empty($category) || empty($language)) {
        echo "All fields are required.";
        exit;
    
    } else {
    
        $sql = "INSERT INTO books (name, author, category, language) VALUES ('$name', '$author', '$category', '$language')";

        mysqli_query($conn, $sql);
        header("Location: stockupdate.php");
    }

    mysqli_close($conn);

}
?>