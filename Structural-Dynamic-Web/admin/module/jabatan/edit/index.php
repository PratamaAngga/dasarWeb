<div class="container-fluid">
    <div class="row">
        <?php
        require 'admin/template/menu.php';
        require_once 'config/koneksi.php';
        require_once 'fungsi/anti_injection.php';

        // Ambil ID dari URL
        $id = isset($_GET['id']) ? antiinjection($_GET['id']) : null;

        // Koneksi ke database
        $database = new Koneksi();
        $db = $database->getConnection();

        // Ambil data jabatan berdasarkan ID (pakai prepared statement)
        $query = "SELECT * FROM jabatan WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Jabatan</h1>
            </div>

            <div class="row">
                <div class="card col-md-6">
                    <div class="card-header">
                        Form Edit Jabatan
                    </div>
                    <div class="card-body">
                        <form action="fungsi/edit.php?jabatan=edit" method="POST">
                            <input type="hidden" value="<?php echo $row['id']; ?>" name="id">

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" value="<?= $row['jabatan']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control" name="keterangan"><?= $row['keterangan']; ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Ubah
                            </button>
                            <a href="index.php?page=jabatan" class="btn btn-secondary">
                                <i class="fa fa-times" aria-hidden="true"></i> Batal
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
