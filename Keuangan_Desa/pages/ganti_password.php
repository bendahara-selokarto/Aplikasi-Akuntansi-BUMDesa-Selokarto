<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';
$pesan = "";

if (isset($_POST['simpan'])) {

    $username_lama = $_POST['username_lama'];
    $password_lama = $_POST['password_lama'];
    $username_baru = $_POST['username_baru'];
    $password_baru = $_POST['password_baru'];

    // Ambil data admin
    $q = mysqli_query($koneksi, "
        SELECT * FROM admin WHERE username='$username_lama'
    ");
    $admin = mysqli_fetch_assoc($q);

    if (!$admin || !password_verify($password_lama, $admin['password'])) {
        $pesan = "❌ Username atau password lama salah";
    } else {
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);  

        mysqli_query($koneksi, "
            UPDATE admin 
            SET username='$username_baru',
                password='$password_hash'
            WHERE id='{$admin['id']}'
        ");

        $pesan = "✅ Username & password berhasil diubah";
    }
}
?>

<h4>Ganti Username & Password</h4>
<hr>

<?php if ($pesan != "") { ?>
<div class="alert alert-info"><?= $pesan ?></div>
<?php } ?>

<form method="post">
    <div class="mb-3">
        <label>Username Lama</label>
        <input type="text" name="username_lama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password Lama</label>
        <input type="password" name="password_lama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Username Baru</label>
        <input type="text" name="username_baru" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password Baru</label>
        <input type="password" name="password_baru" class="form-control" required>
    </div>

    <button name="simpan" class="btn btn-success">
        Simpan Perubahan
    </button>
</form>
