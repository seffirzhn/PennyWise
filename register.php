<?php
session_start();
include 'db.php';

// Proses registrasi
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Cek apakah username sudah digunakan
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($check->num_rows > 0) {
        $error = "Username sudah digunakan! Silakan coba username lain.";
    } else {
        // Tambahkan pengguna ke database
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        // Redirect ke halaman login
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css"> <!-- Panggil file CSS -->
    
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo Pengeluaran">
        </div>
        <h2>Registrasi</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
