<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KroTravel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .dashboard-content {
            text-align: center;
            padding: 40px;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .dashboard-content h1 {
            color: var(--primary-color);
        }
        .dashboard-content p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        .dashboard-content a {
            margin: 0 10px;
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
        }
        .dashboard-content a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="dashboard-content">
        <h1>Dashboard Admin</h1>
        <p>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <p>Halaman ini hanya dapat diakses oleh administrator.</p>
        <nav>
            <a href="index.php">Kembali ke Beranda</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>
</body>
</html>