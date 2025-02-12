<?php

// $conn = mysqli_connect("localhost", "root", "", "todolist");
// if (!$conn) {
//     die("Koneksi gagal: ". mysqli_connect_error());
// }
include 'database.php';

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = mysqli_real_escape_string($conn, $data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password"]);

    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

    if( mysqli_fetch_assoc ($result) ) {
        echo "<script>
        alert('username yang anda pilih sudah digunakan!');
        </script>";

        return false;
    }

if( $password !== $password2 ) {
    echo "<script>
    alert('Konfirmasi password salah')
    </script>";

    return false;
}

$password = password_hash($password, PASSWORD_DEFAULT);

mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$email', '$password')");
return mysqli_affected_rows($conn);
}
?>