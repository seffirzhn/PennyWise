<?php
session_start();
session_destroy();

echo "<p style='color: green; text-align: center;'>Anda telah berhasil logout. Sampai jumpa lagi!</p>";
header("refresh:2;url=login.php"); // Redirect setelah 2 detik
exit;

?>
