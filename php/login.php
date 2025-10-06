<?php
session_start();

// Jika user sudah login
if (isset($_SESSION['username'])) {
    // Jika dia admin, arahkan ke dashboard. Jika bukan, arahkan ke index.
    if ($_SESSION['username'] === 'admin') {
        header('Location: dashboard.php');
    } else {
        header('Location: index.php');
    }
    exit;
}

$error = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $valid_username = 'admin';
    $valid_password = 'pass1';

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        
        if ($username === 'admin') {
            header('Location: dashboard.php');
        } else {
            // Untuk user lain di masa depan
            header('Location: index.php');
        }
        exit;
    } else {
        $error = 'Username atau Password salah!';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KroTravel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="login.php" method="POST">
            <h1>Login KroTravel</h1>
            <p>Silakan masuk untuk melanjutkan</p>
            
            <?php if ($error): ?>
                <p class="error-message"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if (isset($_GET['status']) && $_GET['status'] === 'logout_success'): ?>
                <p class="success-message">Anda berhasil logout.</p>
            <?php endif; ?>

            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="actionButton">Login</button>
        </form>
        
        <a href="index.php" class="back-link">Kembali ke Beranda</a>
    </div>
</body>
</html>