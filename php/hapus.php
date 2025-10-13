<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    $query = "DELETE FROM paket_tour WHERE id = $id";
    if (mysqli_query($conn, $query)) {
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

header('Location: dashboard.php');
exit;
?>