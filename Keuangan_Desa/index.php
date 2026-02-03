<?php
include 'cek_login.php';
$page = $_GET['page'] ?? 'dashboard';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aplikasi Akuntansi Keuangan Desa Selokarto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f6f9;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #198754;
            color: white;
            padding-top: 20px;
        }
        .sidebar h5 {
            font-weight: bold;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            font-size: 15px;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,0.2);
            border-left: 4px solid #fff;
        }
        .content {
            margin-left: 250px;
            min-height: 100vh;
        }
        .topbar {
            background: white;
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h5 class="text-center mb-4">BUMDesa Selokarto</h5>

    <a href="?page=dashboard" class="<?= $page=='dashboard'?'active':'' ?>">🏠 Dashboard</a>
    <a href="?page=coa" class="<?= $page=='coa'?'active':'' ?>">📘 Chart of Account</a>
    <a href="?page=jurnal" class="<?= $page=='jurnal'?'active':'' ?>">📝 Jurnal Umum</a>
    <a href="?page=buku_besar" class="<?= $page=='buku_besar'?'active':'' ?>">📂 Buku Besar</a>
    <a href="?page=laba_rugi" class="<?= $page=='laba_rugi'?'active':'' ?>">📊 Laba Rugi</a>
    <a href="?page=neraca" class="<?= $page=='neraca'?'active':'' ?>">📑 Neraca</a>
    <a href="?page=ganti_password">🔐 Ganti Password</a>
    <a href="auth/logout.php" class="text-warning">🚪 Logout</a>

</div>

<!-- KONTEN -->
<div class="content">

    <!-- TOPBAR -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div>
            <strong>Sistem Akuntansi Keuangan Desa Selokarto</strong>
        </div>
    </div>

    <!-- ISI HALAMAN -->
    <div class="main-content">
        <div class="card shadow-sm">
            <div class="card-body">
                <?php
                $file = "pages/$page.php";
                if (file_exists($file)) {
                    include $file;
                } else {
                    echo "<div class='alert alert-danger'>Halaman tidak ditemukan</div>";
                }
                ?>
            </div>
        </div>
    </div>

</div>

</body>
</html>
