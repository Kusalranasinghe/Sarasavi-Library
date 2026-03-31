<?php
include 'includes/database.php';

// Check if user_id exists
if(!isset($_GET['user_id'])){
    header("Location: users.php");
    exit;
}

$user_id = intval($_GET['user_id']);
$result = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $user_id");
$user = mysqli_fetch_assoc($result);

if(!$user){
    echo "User not found!";
    exit;
}

// Prevent editing admins or super_admins by normal users
if($user['role'] != 'user'){
    echo "<script>alert('Admin and Super Admin cannot be edited!'); window.location='users.php';</script>";
    exit;
}

if(isset($_POST['update_user'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $nic = mysqli_real_escape_string($conn, $_POST['nic']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $update = "UPDATE users SET 
               name='$name', email='$email', phone='$phone', 
               nic='$nic', address='$address', updated_at=NOW() 
               WHERE user_id=$user_id";

    if(mysqli_query($conn, $update)){
        header("Location: users.php");
        exit;
    } else {
        $error = "Failed to update user: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit User - Sarasavi Library</title>
<link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="edit-container">
    <h2>Edit User</h2>
    <hr>
    <?php if(isset($error)) echo "<p class='error-msg'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="name" value="<?php echo $user['name']; ?>" placeholder="Name" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Email" required>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" placeholder="Phone">
        <input type="text" name="nic" value="<?php echo $user['nic']; ?>" placeholder="NIC">
        <input type="text" name="address" value="<?php echo $user['address']; ?>" placeholder="Address">
        <div class="form-buttons">
            <button type="submit" name="update_user">Update User</button>
            <a href="users.php" class="cancel-btn">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>