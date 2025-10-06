<?php
session_start();
header('Content-Type: application/json'); 

$valid_username = 'admin';
$valid_password = 'pass1';

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($username === $valid_username && $password === $valid_password) {
    $_SESSION['username'] = $username;
    $isAdmin = ($username === 'admin');
    
    echo json_encode(['success' => true, 'isAdmin' => $isAdmin]);
} else {
    echo json_encode(['success' => false, 'message' => 'Username atau password salah!']);
}
?>