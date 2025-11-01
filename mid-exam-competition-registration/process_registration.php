<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Ambil dan bersihkan (sanitize) data yang masuk
    $nama_lengkap = htmlspecialchars(trim($_POST['nama_lengkap'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $nama_tim = htmlspecialchars(trim($_POST['nama_tim'] ?? ''));
    $kategori = htmlspecialchars(trim($_POST['kategori'] ?? ''));
    $nomor_hp = htmlspecialchars(trim($_POST['nomor_hp'] ?? ''));
    $password_set = !empty($_POST['password']); 

    $is_valid = true;
    if (empty($nama_lengkap) || empty($email) || empty($nama_tim) || empty($kategori) || empty($nomor_hp) || strlen($_POST['password'] ?? '') < 6) {
        $is_valid = false;
    }

    if ($is_valid) {
        $status_title = "Pendaftaran Berhasil!";
        $status_message = "Selamat, {$nama_lengkap}! Tim/Individu '{$nama_tim}' telah terdaftar di kategori {$kategori}. Anda bisa login menggunakan email dan password yang telah dibuat.";
        $status_color_bg = "#10b981";
        $icon = "🎉";
        $success_flag = true;
    } else {
        $status_title = "Gagal Pendaftaran!";
        $status_message = "Ups, ada data penting yang kosong atau password kurang dari 6 karakter. Silakan kembali dan lengkapi formulir.";
        $status_color_bg = "#ef4444";
        $icon = "❌"; 
        $success_flag = false;
    }

} else {
    // Jika diakses langsung tanpa POST atau isi form
    $status_title = "Akses Ditolak";
    $status_message = "Halaman ini hanya bisa diakses melalui pengiriman formulir pendaftaran.";
    $status_color_bg = "#f59e0b";
    $icon = "⚠️";
    $success_flag = false;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <title>Konfirmasi Pendaftaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e54c8;
            --light-bg: #e2e8f0;
            --card-bg: #ffffff;
            --text-dark: #1f2937;
            --text-light: #6b7280;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card-container {
            background-color: var(--card-bg);
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            width: 100%;
            max-width: 576px;
            text-align: center;
        }

        /* STATUS HEADER */
        .status-header {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 24px;
            color: white;
            animation: fadeIn 0.5s ease-out;
        }

        .icon {
            font-size: 40px;
            display: block;
            margin-bottom: 8px;
        }

        .title {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .message {
            font-size: 1.125rem;
            color: var(--text-light);
            margin-bottom: 32px;
            line-height: 1.5;
        }

        /* DETAIL SECTION */
        .detail-section {
            text-align: left;
            border: 1px solid #e5e7eb;
            padding: 24px;
            border-radius: 8px;
            background-color: #f9fafb;
            margin-top: 16px;
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.05);
        }

        .detail-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-dark);
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #d1d5db;
            padding: 8px 0;
            font-size: 0.875rem;
        }
        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: var(--text-light);
        }

        .detail-value {
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .kategori-value {
            color: #059669;
            font-weight: 700;
        }

        /* ACTION BUTTON */
        .action-button {
            margin-top: 32px;
        }
        
        .btn-link {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }
        .btn-link:hover {
            background-color: rgb(25, 87, 223);
            transform: translateY(-1px);
            box-shadow: 0 6px 10px -1px rgba(59, 130, 246, 0.4);
        }

        /* Keyframes buat animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ANIMATION */
      .area {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: linear-gradient(135deg, #4e54c8, #8f94fb);
        overflow: hidden;
        z-index: -1;
      }

      .circles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
      }

      .circles li {
        position: absolute;
        display: block;
        list-style: none;
        width: 20px;
        height: 20px;
        background: rgba(255, 255, 255, 0.25);
        animation: animate 25s linear infinite;
        bottom: -150px;
        border-radius: 50%;
      }

      .circles li:nth-child(1) {
        left: 25%;
        width: 80px;
        height: 80px;
        animation-delay: 0s;
      }

      .circles li:nth-child(2) {
        left: 10%;
        width: 20px;
        height: 20px;
        animation-delay: 2s;
        animation-duration: 12s;
      }

      .circles li:nth-child(3) {
        left: 70%;
        width: 20px;
        height: 20px;
        animation-delay: 4s;
      }

      .circles li:nth-child(4) {
        left: 40%;
        width: 60px;
        height: 60px;
        animation-delay: 0s;
        animation-duration: 18s;
      }

      .circles li:nth-child(5) {
        left: 65%;
        width: 20px;
        height: 20px;
        animation-delay: 0s;
      }

      .circles li:nth-child(6) {
        left: 75%;
        width: 110px;
        height: 110px;
        animation-delay: 3s;
      }

      .circles li:nth-child(7) {
        left: 35%;
        width: 150px;
        height: 150px;
        animation-delay: 7s;
      }

      .circles li:nth-child(8) {
        left: 50%;
        width: 25px;
        height: 25px;
        animation-delay: 15s;
        animation-duration: 45s;
      }

      .circles li:nth-child(9) {
        left: 20%;
        width: 15px;
        height: 15px;
        animation-delay: 2s;
        animation-duration: 35s;
      }

      .circles li:nth-child(10) {
        left: 85%;
        width: 150px;
        height: 150px;
        animation-delay: 0s;
        animation-duration: 11s;
      }

      @keyframes animate {
        0% {
          transform: translateY(0) rotate(0deg);
          opacity: 1;
          border-radius: 0;
        }

        100% {
          transform: translateY(-1000px) rotate(720deg);
          opacity: 0;
          border-radius: 50%;
        }
      }
    </style>
</head>
<body>
    <div class="area">
      <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <div class="card-container">
        <!-- Status Header -->
        <div class="status-header" style="background-color: <?php echo $status_color_bg; ?>;">
            <span class="icon"><?php echo $icon; ?></span>
            <h1 class="title"><?php echo $status_title; ?></h1>
        </div>

        <p class="message"><?php echo $status_message; ?></p>
        
        <?php if ($success_flag): ?>
            <!-- Detail Pendaftaran -->
            <div class="detail-section">
                <h3>Rincian Data Pendaftaran</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Nama Lengkap:</span>
                    <span class="detail-value"><?php echo $nama_lengkap; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?php echo $email; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Tim/Individu:</span>
                    <span class="detail-value"><?php echo $nama_tim; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Kategori:</span>
                    <span class="kategori-value"><?php echo $kategori; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Nomor HP/WA:</span>
                    <span class="detail-value"><?php echo $nomor_hp; ?></span>
                </div>
            </div>

            <p class="mt-6 text-sm text-gray-500">Mohon periksa email Anda untuk detail dan tahapan kompetisi selanjutnya.</p>
        <?php endif; ?>

        <!-- Tombol Aksi -->
        <div class="action-button">
            <a href="index.html" class="btn-link">
                Kembali ke Form
            </a>
        </div>
    </div>

</body>
</html>
