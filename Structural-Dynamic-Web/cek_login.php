<?php
// Pastikan sesi sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ASUMSI: File-file ini berisi class Koneksi dan AntiInjection/pesan
require_once "config/koneksi.php"; 
require_once "fungsi/pesan_kilat.php"; 
require_once "fungsi/anti_injection.php";

// 1. Sanitasi Data Input
$username_input = antiinjection($_POST['username']);
$password_input = $username_input = antiinjection($_POST['password']); 

// 2. Inisialisasi Koneksi PDO
$database = new Koneksi();
$db = $database->getConnection(); 

// 3. Query Menggunakan Prepared Statement (AMANKAN DARI SQL INJECTION)
// Kita tetap mengambil salt, level, dan password yang sudah di-hash
$query = "SELECT username, level, salt, password as hashed_password FROM users WHERE username = :username";

// Siapkan (prepare) query
$stmt = $db->prepare($query);

// Bind (ikat) parameter. Gunakan data yang sudah di-sanitize ($username_input).
$stmt->bindParam(':username', $username_input);

// Jalankan (execute) query
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Penutupan koneksi (opsional di PDO, tapi baik untuk praktik)
$db = null; 

if ($row) { // Jika user ditemukan ($row tidak kosong)
    $salt = $row['salt'];
    $hashed_password = $row['hashed_password'];

    // Gabungkan salt dengan password yang diinput (harus sama dengan saat hashing)
    $combined_password = $salt . $password_input; // Gunakan $password_input yang sudah di-sanitize

    // Verifikasi Password
    if (password_verify($combined_password, $hashed_password)) {
        // Login Berhasil
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        header("Location: index.php");
        exit(); // Wajib ditambahkan setelah header redirect
    } else {
        // Password Salah
        pesan('danger', "Login gagal. Password Anda Salah.");
        header("Location: login.php");
        exit(); 
    }
} else {
    // Username tidak ditemukan
    pesan('warning', "Username tidak ditemukan.");
    header("Location: login.php");
    exit(); 
}
?>