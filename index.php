<?php
session_start(); // Mulai session di awal file

include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil Data Pengeluaran
$expenses = $conn->query("SELECT * FROM expenses WHERE user_id=$user_id");
$total = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE user_id=$user_id")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pengeluaran Pribadi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="sidebar">
        <a href="index.php" class="nav-link"><img src="home.png" alt="Home"></a>
        <a href="add_expense.php" class="nav-link"><img src="add_expense.png" alt="Tambah Pengeluaran"></a>
        <a href="list_expense.php" class="nav-link"><img src="list_expense.png" alt="Lihat Daftar Pengeluaran"></a>
        <a href="logout.php" class="logout-btn"><img src="logout.png" alt="Logout"></a>

    <div class="content">
        <div class="welcome">
            <h1>Halo, <?= $_SESSION['username'] ?></h1>
        </div>

        <h3>Total Pengeluaran : Rp <?= number_format($total, 2) ?></h3>
    </div>
</body>
</html>
