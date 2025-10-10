<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = array();

    // Validasi Nama
    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }

    // Validasi Email
    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Validasi Password
    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }

    // Tampilkan hasil
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<span style='color: red;'>$error</span><br>";
        }
    } else {
        echo "Data berhasil dikirim:<br>";
        echo "Nama: $nama<br>";
        echo "Email: $email<br>";
        echo "Password: (disembunyikan demi keamanan)";
    }
}
?>
