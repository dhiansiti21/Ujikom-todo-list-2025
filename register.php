<?php
session_start();
require 'functions.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>alert('User baru berhasil ditambahkan');</script>";

        $_SESSION["login"] = true;
        $_SESSION["username"] = $_POST["username"];

        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Registrasi gagal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fa fa-lock"></i>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class="fa fa-envelope"></i>
            </div>
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit" name="register" class="btn">Register</button>
        </form>
        <div class="register-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
