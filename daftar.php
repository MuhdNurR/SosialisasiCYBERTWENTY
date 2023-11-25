<!DOCTYPE html>
<html>

<head>
    <title>Form Input</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
#border {
    box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
}

body {
    background-image: url(img/bg.jpg);
    background-size: cover;
}
</style>

<body>
    <div class="row justify-content-center mt ml-5 mr-5">
        <div class="container" style="margin-top: 10rem; margin-left: 25rem;margin-right:25rem">
            <div id="border" class="row bg-white" style="border-radius: 15px;padding: 0.5rem 0.75rem;">
                <div class="container mr-3 ml-3 mt-4 mb-3">
                    <h2 class="text-center">Form Pendaftaran Akun</h2>
                    <!-- Tampilkan pesan error jika ada -->
                    <?php
                    if (isset($_GET['error'])) {
                        $error_message = urldecode($_GET['error']);
                        echo '<div id="error-alert" class="alert alert-danger alert-dismissible fade show" role="alert">' . $error_message . '
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    ?>
                    <form method="post" action="action/daftarakun.php" class="needs-validation" novalidate>
                        <div class="form-group">
                            <div class="row">
                                <div class="col"><label for="username">Username</label></div>
                                <div class="col text-right"><span>Sudah Punya Akun ? <a href="index.php"> Log
                                            In</a></span></div>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Masukkan Username"
                                name="username" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Masukkan password"
                                name="password" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="form-group">
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password2" placeholder="Konfirmasi password"
                                name="password2" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>

                        <div class="mb-3">

                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember" required> Saya
                                Menyetujui Seluruh Persyaratan.
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Check this checkbox to continue.</div>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Get the forms we want to add validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>

<script>
$(document).ready(function() {
    // Auto-hide the alert after 5 seconds
    setTimeout(function() {
        $("#error-alert").alert('close');
    }, 2000);
});
</script>

</html>