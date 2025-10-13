<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$message = '';
$paket = null;


if ($id > 0) {
    $query = "SELECT * FROM paket_tour WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $paket = mysqli_fetch_assoc($result);
    if (!$paket) {
        die("Data tidak ditemukan.");
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_post = (int)$_POST['id'];
    $nama_paket = mysqli_real_escape_string($conn, $_POST['nama_paket']);
    $destinasi = mysqli_real_escape_string($conn, $_POST['destinasi']);
    $harga_normal = (int)$_POST['harga_normal'];
    $harga_promo = (int)$_POST['harga_promo'];

    $query_update = "UPDATE paket_tour SET nama_paket='$nama_paket', destinasi='$destinasi', harga_normal='$harga_normal', harga_promo='$harga_promo' WHERE id=$id_post";

    if (mysqli_query($conn, $query_update)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $message = '<p class="error-message">Gagal mengupdate data: ' . mysqli_error($conn) . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Tour - KroTravel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" action="edit.php?id=<?php echo $id; ?>" method="POST">
            <h1>Edit Paket Tour</h1>
            <?php echo $message; ?>
            <input type="hidden" name="id" value="<?php echo $paket['id']; ?>">
            <div class="input-group">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" id="nama_paket" name="nama_paket" value="<?php echo htmlspecialchars($paket['nama_paket']); ?>" required>
            </div>
            <div class="input-group">
                <label for="destinasi">Destinasi</label>
                <input type="text" id="destinasi" name="destinasi" value="<?php echo htmlspecialchars($paket['destinasi']); ?>" required>
            </div>
            <div class="input-group">
                <label for="harga_normal">Harga Normal</label>
                <input type="number" id="harga_normal" name="harga_normal" value="<?php echo $paket['harga_normal']; ?>" required>
            </div>
            <div class="input-group">
                <label for="harga_promo">Harga Promo</label>
                <input type="number" id="harga_promo" name="harga_promo" value="<?php echo $paket['harga_promo']; ?>" required>
            </div>
            <button type="submit" class="actionButton">Update Paket</button>
        </form>
        <a href="dashboard.php" class="back-link">Batal</a>
    </div>
</body>
</html>