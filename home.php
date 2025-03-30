<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="username">
        Welcome, <?php echo $_SESSION['username']; ?> | <a href="logout.php">Logout</a>
    </div>
    <div class="container">
        <h2>Home Page</h2>
        <p>This is your home page content.</p>
    </div>
</body>
</html>