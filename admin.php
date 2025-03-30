<?php
session_start();
include 'includes/db_connect.php';

// Add admin authentication logic here

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Admin Panel - User Management</h2>
        <table border="1" style="width:100%; margin-top:20px;">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Created At</th>
            </tr>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['created_at']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <p style="margin-top:20px;"><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>