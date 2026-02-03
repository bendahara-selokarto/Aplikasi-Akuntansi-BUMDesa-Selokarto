<?php
$koneksi = mysqli_connect("localhost", "root", "", "keuangan_desa");

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
