<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']);
    $destinasi = mysqli_real_escape_string($conn, $_POST['destinasi']);
    $harga_normal = (int)$_POST['harga_normal'];
    $harga_promo = (int)$_POST['harga_promo'];

    $query = "INSERT INTO paket_tour (nama_paket, destinasi, harga_normal, harga_promo) VALUES ('$nama_paket', '$destinasi', '$harga_normal', '$harga_promo')";

    if (mysqli_query($conn, $query)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $message = '<p class="error-message">Gagal menambahkan data: ' . mysqli_error($conn) . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Tour - KroTravel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="tambah.php" method="POST">
            <h1>Tambah Paket Tour Baru</h1>
            <?php echo $message; ?>
            <div class="input-group">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" id="nama_paket" name="nama_paket" required>
            </div>
            <div class="input-group">
                <label for="destinasi">Destinasi</label>
                <input type="text" id="destinasi" name="destinasi" required>
            </div>
            <div class="input-group">
                <label for="harga_normal">Harga Normal (contoh: 21000000)</label>
                <input type="number" id="harga_normal" name="harga_normal" required>
            </div>
            <div class="input-group">
                <label for="harga_promo">Harga Promo (contoh: 18533000)</label>
                <input type="number" id="harga_promo" name="harga_promo" required>
            </div>
            <button type="submit" class="actionButton">Tambah Paket</button>
        </form>
        <a href="dashboard.php" class="back-link">Batal</a>
    </div>
</body>
</html>