<?php
session_start();
include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query($koneksi, "
    SELECT * FROM admin WHERE username='$username'
");

$admin = mysqli_fetch_assoc($query);

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['admin'] = $admin['username'];
    header("Location: ../index.php");
} else {
    header("Location: login.php?error=1");
}
