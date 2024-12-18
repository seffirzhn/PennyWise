<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Ambil Data Pengeluaran
$expenses = $conn->query("SELECT * FROM expenses WHERE user_id=$user_id");
$total = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE user_id=$user_id")->fetch_assoc()['total'];

// Hapus Pengeluaran
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM expenses WHERE id=$id AND user_id=$user_id");
    header("Location: list_expense.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengeluaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
    <a href="index.php" class="nav-link"><img src="home.png" alt="Home"></a>
        <h2>Daftar Pengeluaran</h2>
        <a href="add_expense.php" class="nav-link"><img src="add_expense.png" alt="Tambah Pengeluaran"></a>
        <a href="logout.php" class="logout-btn"><img src="logout.png" alt="Logout"></a>
    </div>

 
    <table border="1">
        <tr>
            <th>#</th>
            <th>Deskripsi</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php $no = 1; while ($row = $expenses->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['category'] ?></td>
            <td>Rp <?= number_format($row['amount'], 2) ?></td>
            <td><?= $row['date'] ?></td>
            <td><a href="list_expense.php?delete=<?= $row['id'] ?>">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h3>Total Pengeluaran: Rp <?= number_format($total, 2) ?></h3>
</body>
</html>
