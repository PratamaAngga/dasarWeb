<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

require '../config/koneksi.php';
require '../fungsi/pesan_kilat.php';
require '../fungsi/anti_injection.php';

try {
    $koneksi = new Koneksi();
    $db = $koneksi->getConnection();

    /* -------------------------
       HAPUS JABATAN
    -------------------------- */
    if (isset($_GET['jabatan']) && isset($_GET['id'])) {

        $id = antiinjection($_GET['id']);

        $stmt = $db->prepare("DELETE FROM jabatan WHERE id = :id");
        $stmt->execute([':id' => $id]);

        pesan('success', "Jabatan Telah Terhapus.");
        header("Location: ../index.php?page=jabatan");
        exit;
    }

    /* -------------------------
       HAPUS ANGGOTA + USERS
    -------------------------- */
    if (isset($_GET['anggota']) && isset($_GET['id'])) {

        $id = antiinjection($_GET['id']);

        $db->beginTransaction();

        // Hapus anggota dulu (karena FK)
        $stmtAng = $db->prepare("DELETE FROM anggota WHERE user_id = :id");
        $stmtAng->execute([':id' => $id]);

        // Hapus user
        $stmtUser = $db->prepare("DELETE FROM users WHERE id = :id");
        $stmtUser->execute([':id' => $id]);

        $db->commit();

        pesan('success', "Anggota Telah Terhapus.");
        header("Location: ../index.php?page=anggota");
        exit;
    }

} catch (PDOException $e) {
    pesan('danger', "Error DB: " . $e->getMessage());
    header("Location: ../index.php?page=error");
    exit;
}
