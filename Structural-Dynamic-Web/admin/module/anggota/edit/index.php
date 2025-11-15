<div class="container-fluid">
    <div class="row">
        <?php
        require 'admin/template/menu.php';
        require 'fungsi/anti_injection.php';

        // Ambil ID
        if (!isset($_GET['id'])) {
            echo "<div class='alert alert-danger'>ID tidak ditemukan.</div>";
            exit;
        }

        $id = antiinjection($_GET['id']);

        // Koneksi
        $koneksi = new Koneksi();
        $db = $koneksi->getConnection();

        // Query ambil data anggota JOIN jabatan + users
        $sql = "
            SELECT 
                a.id AS anggota_id,
                a.nama,
                a.jabatan_id,
                a.jenis_kelamin,
                a.alamat,
                a.no_telp,
                u.id AS user_id,
                u.username
            FROM anggota a
            JOIN jabatan j ON a.jabatan_id = j.id
            JOIN users u ON a.user_id = u.id
            WHERE a.user_id = :id
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            echo "<div class='alert alert-danger'>Data anggota tidak ditemukan.</div>";
            exit;
        }

        // Query ambil semua jabatan
        $stmtJabatan = $db->query("SELECT * FROM jabatan ORDER BY jabatan ASC");
        $jabatanList = $stmtJabatan->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Anggota</h1>
            </div>

            <form action="fungsi/edit.php?anggota=edit" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Form Edit Anggota
                            </div>
                            <div class="card-body">
                                <input type="hidden" value="<?= $row['user_id']; ?>" name="id">

                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $row['nama']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Jabatan:</label>
                                    <select class="form-select" name="jabatan">
                                        <option disabled>Pilih Jabatan</option>
                                        <?php foreach ($jabatanList as $j) : ?>
                                            <option value="<?= $j['id']; ?>"
                                                <?= $row['jabatan_id'] == $j['id'] ? 'selected' : '' ?>>
                                                <?= $j['jabatan']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Jenis Kelamin:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="jenis_kelamin" value="L"
                                            <?= $row['jenis_kelamin'] === "L" ? 'checked' : '' ?>>
                                        <label class="form-check-label">Laki-Laki</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="jenis_kelamin" value="P"
                                            <?= $row['jenis_kelamin'] === "P" ? 'checked' : '' ?>>
                                        <label class="form-check-label">Perempuan</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat"><?= $row['alamat']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" name="no_telp"
                                        value="<?= $row['no_telp']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Form Edit Login Anggota
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        value="<?= $row['username']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    <div class="form-text">Kosongi jika tidak ingin mengganti password.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-floppy-o"></i> Ubah
                                </button>
                                <a href="index.php?page=anggota" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </main>
    </div>
</div>
