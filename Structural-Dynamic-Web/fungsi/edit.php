<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/koneksi.php';
require '../fungsi/pesan_kilat.php';
require '../fungsi/anti_injection.php';

// Koneksi database
$database = new Koneksi();
$db = $database->getConnection();

/* ============================================================
   1. EDIT JABATAN
============================================================ */
if (isset($_GET['jabatan'])) {

    $id         = antiinjection($_POST['id']);
    $jabatan    = antiinjection($_POST['jabatan']);
    $keterangan = antiinjection($_POST['keterangan']);

    try {
        $query = "UPDATE jabatan 
                  SET jabatan = :jabatan_val, 
                      keterangan = :keterangan_val 
                  WHERE id = :id_val";

        $stmt = $db->prepare($query);
        $stmt->execute([
            ':jabatan_val'     => $jabatan,
            ':keterangan_val'  => $keterangan,
            ':id_val'          => $id
        ]);

        pesan('success', "Jabatan telah diubah.");
    } 
    catch (PDOException $e) {
        pesan('danger', "Mengubah Jabatan gagal karena: " . $e->getMessage());
    }

    header("Location: ../index.php?page=jabatan");
    exit;
}


/* ============================================================
   2. EDIT ANGGOTA
============================================================ */
elseif (isset($_GET['anggota'])) {

    // Ambil data dari form
    $user_id       = antiinjection($_POST['id']);
    $nama          = antiinjection($_POST['nama']);
    $jabatan       = antiinjection($_POST['jabatan']);
    $jenis_kelamin = antiinjection($_POST['jenis_kelamin']);
    $alamat        = antiinjection($_POST['alamat']);
    $no_telp       = antiinjection($_POST['no_telp']);
    $username      = antiinjection($_POST['username']);
    $password      = $_POST['password']; // kosong boleh

    try {
        // Mulai transaksi
        $db->beginTransaction();

        /* -------------------------
           UPDATE TABEL ANGGOTA
        ---------------------------*/
        $sqlAnggota = "
            UPDATE anggota SET 
                nama = :nama,
                jenis_kelamin = :jk,
                alamat = :alamat,
                no_telp = :telp,
                jabatan_id = :jabatan
            WHERE user_id = :id
        ";

        $stmtAnggota = $db->prepare($sqlAnggota);
        $stmtAnggota->execute([
            ':nama'     => $nama,
            ':jk'       => $jenis_kelamin,
            ':alamat'   => $alamat,
            ':telp'     => $no_telp,
            ':jabatan'  => $jabatan,
            ':id'       => $user_id
        ]);

        /* -------------------------
           UPDATE TABEL USERS
        ---------------------------*/

        // Jika password diisi → update username + password.
        if (!empty($password)) {

            $salt = bin2hex(random_bytes(16));
            $combined_password = $salt . $password;
            $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

            $sqlUser = "
                UPDATE users 
                SET username = :username, 
                    password = :password, 
                    salt = :salt
                WHERE id = :id
            ";
            $stmtUser = $db->prepare($sqlUser);
            $stmtUser->execute([
                ':username' => $username,
                ':password' => $hashed_password,
                ':salt'     => $salt,
                ':id'       => $user_id
            ]);
        } 
        
        // Jika password kosong → update username saja
        else {
            $sqlUser = "
                UPDATE users 
                SET username = :username
                WHERE id = :id
            ";
            $stmtUser = $db->prepare($sqlUser);
            $stmtUser->execute([
                ':username' => $username,
                ':id'       => $user_id
            ]);
        }

        // Commit perubahan
        $db->commit();
        pesan('success', "Anggota telah diubah.");

    } 
    catch (PDOException $e) {

        // Rollback kalau ada error
        if ($db->inTransaction()) {
            $db->rollBack();
        }

        pesan('danger', "Mengubah anggota gagal karena: " . $e->getMessage());
    }

    header("Location: ../index.php?page=anggota");
    exit;
}
?>
