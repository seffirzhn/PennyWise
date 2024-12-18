<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Tambah Pengeluaran
if (isset($_POST['add_expense'])) {
    $description = $_POST['description'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $conn->query("INSERT INTO expenses (description, category, amount, date, user_id) 
                  VALUES ('$description', '$category', '$amount', '$date', '$user_id')");
    header("Location: list_expense.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pengeluaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
    <a href="index.php" class="nav-link"><img src="home.png" alt="Home"></a>
        <h2>Tambah Pengeluaran</h2>
        <a href="list_expense.php" class="nav-link"><img src="list_expense.png" alt="Lihat Daftar Pengeluaran"></a>
        <a href="logout.php" class="logout-btn"><img src="logout.png" alt="Logout"></a>
    </div>

    <form method="POST">
        <input type="text" name="description" placeholder="Deskripsi" required><br>
        <input type="text" name="category" placeholder="Kategori" required><br>
        <input type="number" step="0.01" name="amount" placeholder="Jumlah" required><br>
        <input type="date" name="date" required><br>
        <button type="submit" name="add_expense">Tambah</button>
    </form>
</body>
</html>
