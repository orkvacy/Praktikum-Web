<?php
session_start();
include 'koneksi.php'; 


if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit;
}


$query = "SELECT * FROM paket_tour ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - KroTravel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Dashboard Admin</h1>
        <p>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        
        <div class="dashboard-actions">
            <a href="tambah.php" class="actionButton">Tambah Paket Tour Baru</a>
            <a href="logout.php" class="actionButton logout">Logout</a>
        </div>

        <h2>Manajemen Paket Tour</h2>
        <div class="tableWrapper">
            <table class="promoTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Paket</th>
                        <th>Destinasi</th>
                        <th>Harga Promo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_paket']); ?></td>
                            <td><?php echo htmlspecialchars($row['destinasi']); ?></td>
                            <td>Rp <?php echo number_format($row['harga_promo'], 0, ',', '.'); ?></td>
                            <td class="action-links">
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                <a href="hapus.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">Belum ada data paket tour.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="index.php" class="back-link">Kembali ke Beranda</a>
    </div>
</body>
</html>