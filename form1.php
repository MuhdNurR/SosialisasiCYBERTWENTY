<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
}

// Rest of your form1.php code goes here
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Pengisian Formulir</title>
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
    <!-- Cek apakah sudah login -->

    <h1 align="center" class="fw-bold mt-5">FORMULIR PENDAFTARAN EKSKUL</h1>

    <div class="container border border-3 mb-5 border-dark" style="background-color:white; border-radius:25px;">
        <form class="need-validation" action="action/proses.php" method="post">

            <div class="row mb-3 mt-3">
                <div class="col-md-4 align-self-center">
                    Nama Siswa
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    Jenis Kelamin
                </div>
                <div class="col-md-8">
                    <div class="form-check form-check-inline ">
                        <input type="radio" class="form-check-input" id="jenis_kelamin" name="jenis_kelamin"
                            value="Laki-laki" required>
                        <label class="form-check-label radio-inline" for="jenis_kelamin">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline radio-inline">
                        <input type="radio" class="form-check-input" id="jenis_kelamin" name="jenis_kelamin"
                            value="Perempuan" required>
                        <label class="form-check-label " for="jenis_kelamin">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 align-self-center">
                    Kelas
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control mt-3" id="kelas" placeholder="Masukkan kelas" name="kelas"
                        required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 align-self-center">
                    Pilihan Ekskul
                </div>
                <div class="col-md-8">
                    <select class="form-select" id="ekskul" onchange="changeValue(this.value)" name="ekskul" required>
                        <option disabled="" selected="">Pilih</option>
                        <?php
                        include 'koneksi.php';
                        $sql = mysqli_query($koneksi, "SELECT * FROM ekskul");
                        $jsArray = "var prdName = new Array();\n";
                        while ($data = mysqli_fetch_array($sql)) {
                            echo '<option value="' . $data['id_ekskul'] . '">' . $data['nama_ekskul'] . '</option> ';
                            $jsArray .= "prdName['" . $data['id_ekskul'] . "'] = {jam_mulai:'" . addslashes($data['jam_mulai']) . "', jam_selesai:'" . addslashes($data['jam_selesai']) . "'};\n";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 align-self-center">
                    Jam Mulai
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control mt-3" id="jam_mulai" value="" placeholder="" name="jam_mulai"
                        disabled="true">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 align-self-center">
                    Jam Selesai
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control mt-3" id="jam_selesai" value="" placeholder=""
                        name="jam_selesai" disabled="true">
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-md-4 align-self-center">
                    Alasan Bergabung
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control mt-3" id="alasan" placeholder="Masukkan alasan" name="alasan"
                        required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
            </div>

            <div class="text-end pb-4">
                <a href="dashboard.php"><button class="btn btn-warning mt-2 mb-2" type="" value=""
                        onclick="window.history.back();">Kembali</button></a>
                <button class="btn btn-primary  mt-2 mb-2" type="submit" value="next" name="submit">Simpan &
                    Lanjut</button>
            </div>
        </form>
    </div>
    <script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(x) {
        document.getElementById('jam_mulai').value = prdName[x].jam_mulai;
        document.getElementById('jam_selesai').value = prdName[x].jam_selesai;
    };
    </script>

</body>

</html>