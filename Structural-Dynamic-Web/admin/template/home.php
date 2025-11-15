<div class="container-fluid">
<div class="row">
<?php
include "menu.php";
// Langkah 1: Inisialisasi Koneksi (Menggunakan class Koneksi kamu)
// ASUMSI: class Koneksi sudah tersedia (di-include) di file ini
$database = new Koneksi();
$db = $database->getConnection();

// Query Anggota
$query_anggota = "SELECT count(id) as jml FROM anggota";
// Ganti mysqli_query() -> PDO: $db->query()
$stmt_anggota = $db->query($query_anggota);
// Ganti mysqli_fetch_assoc() -> PDO: $stmt->fetch(PDO::FETCH_ASSOC)
$row_anggota = $stmt_anggota->fetch(PDO::FETCH_ASSOC);

// Query Jabatan
$query_jabatan = "SELECT count(id) as jml FROM jabatan";
// Ganti mysqli_query() -> PDO: $db->query()
$stmt_jabatan = $db->query($query_jabatan);
// Ganti mysqli_fetch_assoc() -> PDO: $stmt->fetch(PDO::FETCH_ASSOC)
$row_jabatan = $stmt_jabatan->fetch(PDO::FETCH_ASSOC);
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ANGGOTA</h5>
                    <p class="card-text">Total Anggota sejumlah <?= $row_anggota['jml'] ?> orang.</p>
                    <a href="index.php?page=anggota" class="btn btn-primary">
                        <i class="fa fa-users" aria-hidden="true"></i> Kelola
                    </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">JABATAN</h5>
                    <p class="card-text">Total Jabatan sejumlah <?= $row_jabatan['jml'] ?>.</p>
                    <a href="index.php?page=jabatan" class="btn btn-primary">
                        <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Kelola
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
</div>