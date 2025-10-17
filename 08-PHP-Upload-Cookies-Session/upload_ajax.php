<?php
if (isset($_FILES['files'])) {
    $errors = array();
    $targetDirectory = "uploads/";

    $totalFiles = count($_FILES['files']['name']);
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['files']['name'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        if ($file_size > 2097152) {
            $errors[] = 'Ukuran file tidak boleh lebih dari 2 MB';
        }
        $targetFile = $targetDirectory . $fileName;

        // Pindahkan file yang diunggah ke direktori penyimpanan
        if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
            echo "File $fileName berhasil diunggah.<br>";
        } else {
            $errors[] = "Gagal mengunggah file $fileName.<br>";
        }
    }
    if (!empty($errors)) {
        echo "<br><strong>Kesalahan:</strong><br>" . implode("<br>", $errors);
    }
}

?>