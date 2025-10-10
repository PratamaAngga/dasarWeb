<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi (AJAX & Password)</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <h1>Form Input dengan Validasi (AJAX & Password)</h1>
    <form id="myForm" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span id="password-error" style="color: red;"></span><br>

        <input type="submit" value="Submit">
    </form>

    <div id="hasil" style="margin-top: 15px; font-weight: bold;"></div>

    <script>
        $(document).ready(function() {
            $("#myForm").submit(function(event) {
                event.preventDefault(); // Cegah reload halaman

                var nama = $("#nama").val();
                var email = $("#email").val();
                var password = $("#password").val();
                var valid = true;

                // Reset error message
                $("#nama-error, #email-error, #password-error").text("");

                // Validasi Nama
                if (nama === "") {
                    $("#nama-error").text("Nama harus diisi.");
                    valid = false;
                }

                // Validasi Email
                if (email === "") {
                    $("#email-error").text("Email harus diisi.");
                    valid = false;
                }

                // Validasi Password
                if (password === "") {
                    $("#password-error").text("Password harus diisi.");
                    valid = false;
                } else if (password.length < 8) {
                    $("#password-error").text("Password minimal 8 karakter.");
                    valid = false;
                }

                if (!valid) return;

                // Kirim data ke server
                $.ajax({
                    url: "proses_validasi.php",
                    type: "POST",
                    data: { nama: nama, email: email, password: password },
                    success: function(response) {
                        $("#hasil").html(response);
                    },
                    error: function() {
                        $("#hasil").html("Terjadi kesalahan saat mengirim data.");
                    }
                });
            });
        });
    </script>
</body>
</html>
