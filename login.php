<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

require 'function.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    echo "Username: $username<br>";
    echo "Password MD5: $password<br>";

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");

    if (!$result) {
        echo "Error: " . mysqli_error($koneksi);
    }

    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $_SESSION['login'] = true;
        header('location:index.php');
        exit;
    }
    $error = true;  
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css"> <!-- CSS Terpisah -->
    <title>Login | Admin Panel</title>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <img src="img/bg/logo.png" alt="logo-pdam" class="login-icon"> <!-- Ganti dengan path icon yang sesuai -->
            <h2>ADMIN PANEL</h2>
            <?php if (isset($error)) : ?>
                <div class="error-message">Username atau Password Salah!</div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login">LOGIN</button>
            </form>
        </div>
    </div>
</body>

</html>
