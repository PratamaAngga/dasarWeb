<?php 
function antiinjection($data)
    {
        // Pastikan input adalah string sebelum disanitasi
        if (!is_string($data)) {
            // Jika bukan string, kembalikan saja (atau sesuaikan dengan kebutuhan)
            return $data; 
        }

        // Hapus tag HTML dari string. Mencegah XSS.
        $filter_data = strip_tags($data); 
        
        // Konversi karakter khusus menjadi entitas HTML. Mencegah XSS.
        $filter_data = htmlspecialchars($filter_data, ENT_QUOTES, 'UTF-8'); 
        
        // Menghilangkan backslash
        $filter_data = stripslashes($filter_data);
        
        return $filter_data;
    }
?>