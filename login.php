<?php
session_start();
include 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            echo "<p style='color: red;'>Password yang Anda masukkan salah. Silakan coba lagi!";
        }
    } else {
        echo "<p style='color: red;'>User tidak ditemukan. Periksa kembali username Anda.";
    }
    
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo PennyWise">
        </div>
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p class='message'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required> <br>
            <input type="password" name="password" placeholder="Password" required> <br>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>
