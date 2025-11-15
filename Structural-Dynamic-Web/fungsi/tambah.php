<?php
session_start();

// Cek login
if (!empty($_SESSION['username'])) {

    require_once '../config/koneksi.php';
    require_once '../fungsi/pesan_kilat.php';
    require_once '../fungsi/anti_injection.php';

    // Inisialisasi koneksi
    $database = new Koneksi();
    $db = $database->getConnection();


    /* =====================================================
       =============== 1. TAMBAH JABATAN ====================
       =====================================================*/
    if (isset($_POST['form_type']) && $_POST['form_type'] === 'jabatan') {

        $jabatan = antiinjection($_POST['jabatan']);
        $keterangan = antiinjection($_POST['keterangan']);

        try {
            $query = "INSERT INTO jabatan (jabatan, keterangan) 
                      VALUES (:jab, :ket)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':jab', $jabatan);
            $stmt->bindParam(':ket', $keterangan);

            if ($stmt->execute()) {
                pesan('success', "Jabatan Baru Ditambahkan.");
            } else {
                $error = $stmt->errorInfo();
                pesan('danger', "Gagal Menambah Jabatan Karena: " . $error[2]);
            }
        } catch (PDOException $e) {
            pesan('danger', "Error DB: " . $e->getMessage());
        }

        header("Location: ../index.php?page=jabatan");
        exit();
    }



    /* =====================================================
       ================ 2. TAMBAH ANGGOTA ===================
       =====================================================*/
    if (isset($_GET['anggota']) && $_GET['anggota'] === 'tambah') {

        // Ambil & sanitasi data
        $username       = antiinjection($_POST['username']);
        $password       = antiinjection($_POST['password']);
        $level          = antiinjection($_POST['level']);
        $jabatan        = antiinjection($_POST['jabatan']);
        $nama           = antiinjection($_POST['nama']);
        $jenis_kelamin  = antiinjection($_POST['jenis_kelamin']);
        $alamat         = antiinjection($_POST['alamat']);
        $no_telp        = antiinjection($_POST['no_telp']);

        // Generate salt & hash
        $salt = bin2hex(random_bytes(16));
        $combined = $salt . $password;
        $hashed_password = password_hash($combined, PASSWORD_BCRYPT);

        /* -----------------------------------------------------
           Step 1: Insert ke tabel user
        -----------------------------------------------------*/
        try {
            $query_user = "
                INSERT INTO users (username, password, salt, level)
                VALUES (:u, :p, :s, :l)
                RETURNING id
            ";

            $stmt_user = $db->prepare($query_user);
            $stmt_user->bindParam(':u', $username);
            $stmt_user->bindParam(':p', $hashed_password);
            $stmt_user->bindParam(':s', $salt);
            $stmt_user->bindParam(':l', $level);

            if ($stmt_user->execute()) {

                // Ambil user_id hasil RETURNING id
                $user_id = $stmt_user->fetch(PDO::FETCH_ASSOC)['id'];

                /* -----------------------------------------------------
                   Step 2: Insert ke tabel anggota
                -----------------------------------------------------*/
                $query_anggota = "
                    INSERT INTO anggota 
                    (nama, jenis_kelamin, alamat, no_telp, user_id, jabatan_id)
                    VALUES (:n, :jk, :al, :nt, :uid, :jid)
                ";

                $stmt_anggota = $db->prepare($query_anggota);

                $stmt_anggota->bindParam(':n', $nama);
                $stmt_anggota->bindParam(':jk', $jenis_kelamin);
                $stmt_anggota->bindParam(':al', $alamat);
                $stmt_anggota->bindParam(':nt', $no_telp);
                $stmt_anggota->bindParam(':uid', $user_id);
                $stmt_anggota->bindParam(':jid', $jabatan);

                if ($stmt_anggota->execute()) {
                    pesan('success', "Anggota Baru Ditambahkan.");
                } else {
                    $error = $stmt_anggota->errorInfo();
                    pesan('warning', "User tersimpan tapi gagal tambah anggota: " . $error[2]);
                }

            } else {
                $error = $stmt_user->errorInfo();
                pesan('danger', "Gagal Menambah User Karena: " . $error[2]);
            }

        } catch (PDOException $e) {
            pesan('danger', "Error DB: " . $e->getMessage());
        }

        header("Location: ../index.php?page=anggota");
        exit();
    }


} else {
    header("Location: ../login.php");
    exit();
}
?>
