<?php
session_start();

// Proses login jika form disubmit
if (isset($_POST['logout'])) {
    $username = $_POST['username'];
    // Cek validasi login (misalnya username yang valid)
    if ($username == "user") {
        $_SESSION['user'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Username tidak valid!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Logout</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="login-container">
        <h2>Logout</h2>
        <?php
        if (isset($error_message)) {
            echo "<p class='error'>$error_message</p>";
        }
        ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Masukkan Username" required>
            <button type="submit" name="logout" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
