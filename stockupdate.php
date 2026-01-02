<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Stock</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <h2>Book Stock</h2>

        <label for="bid">Book ID</label>
        <input type="text" id="bid" name="bid" placeholder="Enter Book ID : ">

        <label for="copies">Copies</label>
        <input type="text" id="copies" name="copies" placeholder="How Many Copies :">

        <input type="submit" value="Register">
    </form>
</body>
</html>

