<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';

$pesan = "";

/* ======================
   HAPUS AKUN
====================== */
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);

    // cek apakah akun sudah dipakai di jurnal
    $cek = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM jurnal_detail WHERE coa_id = $id");
    $c = mysqli_fetch_assoc($cek);

    if ($c['total'] > 0) {
        $pesan = "❌ Akun tidak bisa dihapus karena sudah digunakan di jurnal";
    } else {
        mysqli_query($koneksi, "DELETE FROM coa WHERE id = $id");
        $pesan = "✅ Akun berhasil dihapus";
    }
}

/* ======================
   SIMPAN / UPDATE
====================== */
if (isset($_POST['simpan'])) {
    $kode  = $_POST['kode'];
    $nama  = $_POST['nama'];
    $jenis = $_POST['jenis'];

    if (!empty($_POST['id'])) {
        // UPDATE
        $id = $_POST['id'];
        $sql = "UPDATE coa SET kode='$kode', nama='$nama', jenis='$jenis' WHERE id='$id'";
        mysqli_query($koneksi, $sql);
        $pesan = "✅ Akun berhasil diperbarui";
    } else {
        // INSERT
        $sql = "INSERT INTO coa (kode, nama, jenis)
                VALUES ('$kode','$nama','$jenis')";
        mysqli_query($koneksi, $sql);
        $pesan = "✅ Akun berhasil disimpan";
    }
}

/* ======================
   DATA EDIT
====================== */
$edit = null;
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $q = mysqli_query($koneksi, "SELECT * FROM coa WHERE id = $id");
    $edit = mysqli_fetch_assoc($q);
}

/* FILTER */
$filter = "";
if (!empty($_GET['filter_jenis'])) {
    $jenis_filter = mysqli_real_escape_string($koneksi, $_GET['filter_jenis']);
    $filter = "WHERE jenis = '$jenis_filter'";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>COA - Desa Selokarto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-success mb-4">
    <div class="container">
        <span class="navbar-brand">Chart of Account (COA) – Desa Selokarto</span>
    </div>
</nav>

<div class="container">

<?php if ($pesan) { ?>
<div class="alert alert-info"><?= $pesan ?></div>
<?php } ?>

<!-- FORM -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h6><?= $edit ? 'Edit Akun' : 'Tambah Akun' ?></h6>
        <form method="post">
            <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">

            <div class="row">
                <div class="col-md-3">
                    <label>Kode</label>
                    <input type="text" name="kode" class="form-control"
                           value="<?= $edit['kode'] ?? '' ?>" required>
                </div>
                <div class="col-md-5">
                    <label>Nama Akun</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= $edit['nama'] ?? '' ?>" required>
                </div>
                <div class="col-md-4">
                    <label>Jenis</label>
                    <select name="jenis" class="form-control">
                        <?php
                        $jenis_list = ['aset','kewajiban','modal','pendapatan','beban'];
                        foreach ($jenis_list as $j) {
                            $sel = ($edit && $edit['jenis'] == $j) ? 'selected' : '';
                            echo "<option value='$j' $sel>" . ucfirst($j) . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <button class="btn btn-success mt-3" name="simpan">
                <?= $edit ? 'Update Akun' : 'Simpan Akun' ?>
            </button>

            <?php if ($edit) { ?>
                <a href="?page=coa" class="btn btn-secondary mt-3">Batal</a>
            <?php } ?>
        </form>
    </div>
</div>

<!-- TABEL -->
<div class="card shadow-sm">
<div class="card-body">

<form method="get" class="mb-3 col-md-4">
    <input type="hidden" name="page" value="coa">
    <select name="filter_jenis" class="form-control" onchange="this.form.submit()">
        <option value="">-- Semua Jenis --</option>
        <?php
        foreach (['aset','kewajiban','modal','pendapatan','beban'] as $j) {
            $sel = ($_GET['filter_jenis'] ?? '') == $j ? 'selected' : '';
            echo "<option value='$j' $sel>" . ucfirst($j) . "</option>";
        }
        ?>
    </select>
</form>

<table class="table table-bordered table-sm">
<thead class="table-secondary">
<tr>
    <th>Kode</th>
    <th>Nama Akun</th>
    <th>Jenis</th>
    <th width="15%">Aksi</th>
</tr>
</thead>
<tbody>

<?php
$data = mysqli_query($koneksi, "
    SELECT * FROM coa
    $filter
    ORDER BY kode
");
while ($r = mysqli_fetch_assoc($data)) {
?>
<tr>
    <td><?= $r['kode'] ?></td>
    <td><?= $r['nama'] ?></td>
    <td><?= ucfirst($r['jenis']) ?></td>
    <td>
        <a href="?page=coa&edit=<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="?page=coa&hapus=<?= $r['id'] ?>"
           onclick="return confirm('Hapus akun ini?')"
           class="btn btn-danger btn-sm">Hapus</a>
    </td>
</tr>
<?php } ?>

</tbody>
</table>
</div>
</div>

</div>
</body>
</html>
