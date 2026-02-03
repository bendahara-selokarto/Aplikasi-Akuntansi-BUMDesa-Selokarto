<?php
require_once __DIR__ . '/../cek_login.php';
require_once __DIR__ . '/../koneksi.php';
$pesan = "";

/* SIMPAN JURNAL */
if (isset($_POST['simpan'])) {

    $tanggal = $_POST['tanggal'];
    $keterangan = $_POST['keterangan'];
    $akun = $_POST['akun'];
    $debit = $_POST['debit'];
    $kredit = $_POST['kredit'];

    $total_debit = array_sum($debit);
    $total_kredit = array_sum($kredit);

    if ($total_debit != $total_kredit) {
        $pesan = "❌ Total debit dan kredit harus sama";
    } else {

        mysqli_query($koneksi, "
            INSERT INTO jurnal (tanggal, keterangan)
            VALUES ('$tanggal', '$keterangan')
        ");

        $jurnal_id = mysqli_insert_id($koneksi);

        for ($i = 0; $i < count($akun); $i++) {
            if ($debit[$i] > 0 || $kredit[$i] > 0) {
                mysqli_query($koneksi, "
                    INSERT INTO jurnal_detail (jurnal_id, coa_id, debit, kredit)
                    VALUES ('$jurnal_id', '{$akun[$i]}', '{$debit[$i]}', '{$kredit[$i]}')
                ");
            }
        }

        $pesan = "✅ Jurnal berhasil disimpan";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jurnal - Desa Selokarto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            table-layout: fixed;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-success mb-4">
    <div class="container">
        <span class="navbar-brand">Input Jurnal – Desa Selokarto</span>
    </div>
</nav>

<div class="container">

<?php if ($pesan != "") { ?>
<div class="alert alert-info"><?= $pesan ?></div>
<?php } ?>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form method="post">

        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="col-md-9">
                <label class="form-label">Keterangan</label>
                <input type="text" name="keterangan" class="form-control" required>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead class="table-secondary">
                <tr>
                    <th style="width:50%">Akun</th>
                    <th style="width:25%" class="text-right">Debit</th>
                    <th style="width:25%" class="text-right">Kredit</th>
                </tr>
            </thead>
            <tbody>

            <?php for ($i=0; $i<2; $i++) { ?>
            <tr>
                <td>
                    <select name="akun[]" class="form-control">
                        <?php
                        $coa = mysqli_query($koneksi, "SELECT * FROM coa ORDER BY kode");
                        while ($c = mysqli_fetch_assoc($coa)) {
                            echo "<option value='{$c['id']}'>{$c['kode']} - {$c['nama']}</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="debit[]" class="form-control text-right" value="0">
                </td>
                <td>
                    <input type="number" name="kredit[]" class="form-control text-right" value="0">
                </td>
            </tr>
            <?php } ?>

            </tbody>
        </table>
        </div>

        <button class="btn btn-success" name="simpan">
            Simpan Jurnal
        </button>

        </form>

    </div>
</div>

</div>
</body>
</html>
