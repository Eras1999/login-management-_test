<?php
include 'includes/db_connect.php';

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND token_expires > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    
    if($user && isset($_POST['reset'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, token_expires = NULL WHERE email = ?");
        $stmt->execute([$password, $user['email']]);
        $message = "Password reset successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <?php if(isset($message)) echo "<p>$message</p>"; ?>
        <?php if(isset($user) && $user): ?>
            <form method="POST">
                <div class="form-group">
                    <input type="password" name="password" placeholder="New Password" required>
                </div>
                <button type="submit" name="reset">Update Password</button>
            </form>
        <?php else: ?>
            <p>Invalid or expired token!</p>
        <?php endif; ?>
    </div>
</body>
</html>