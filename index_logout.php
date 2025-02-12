<?php
session_start();
if (!isset($_SESSION['user'])) {
    // Jika user belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Proses logout jika tombol logout ditekan
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>Selamat datang, <?php echo $_SESSION['user']; ?>!</h1>
        <form method="POST">
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
