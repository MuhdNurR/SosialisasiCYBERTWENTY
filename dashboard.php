<?php
// Memulai sesi
session_start();

// Include file koneksi.php
include_once("koneksi.php");

// Memeriksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("location: index.php"); // Redirect ke halaman login jika belum login
    exit;
}

// Query untuk mendapatkan semua data siswa dan ekskul
$query = "SELECT sd.nama_siswa, sd.kelas, sd.jenis_kelamin, sd.alasan, e.nama_ekskul FROM siswa_daftar sd INNER JOIN ekskul e ON e.id_ekskul = sd.id_ekskul 
        ORDER BY sd.id_daftar";

$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--Data Tables CDN  -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Document</title>

</head>

<!DOCTYPE html>
<html>

<head>
    <title>Example</title>
</head>

<body id="body-pd">

    <?php
    include('side-bar.php');

    // Assuming 'id_ekskul' is the unique identifier in your database
    $loggedEskul = $_SESSION['id_ekskul'];

    ?>
    <!--Container Main start-->

    <div class="height-100">

        <h4 class="fw-bold" style="margin-top: 5rem !important;">Home</h4>

        <h4 class="fw-bold" style="margin-top: 1rem !important;">Pendaftaran Peserta Didik Baru</h4>


        <h5>Selamat datang, <strong><?php echo $_SESSION['username'];  ?></strong>! Jangan lewatkan kesempatan untuk
            mendaftar ekstrakulikuler kami. Klik "Daftar Sekarang" di bawah, isi formulir pendaftaran dengan informasi
            yang
            akurat. Terima kasih dan semoga berhasil!</h5>

        <?php
        // Disable button if id_ekskul is not set or is null for the logged-in user
        $buttonStyle = (isset($_SESSION['id_ekskul']) && $_SESSION['id_ekskul'] !== null) ? 'style="display: none;"' : '';

        ?>



        <!-- <button type="button" class="btn btn-primary" ?>>Daftar Sekarang</button> -->
        <a href="form1.php"><button type="button" class="btn btn-primary" <?php echo $buttonStyle; ?>>Daftar Sekarang</button></a>

        <h4 class="fw-bold" style="margin-top: 2rem !important;">Data Siswa Ekskul</h4>

        <table id="myTable" class="display" style="width: 100%; border-collapse: collapse; border: 2px solid #ddd;">
            <thead style="background-color: #f2f2f2;">
                <tr>
                    <th style="padding: 10px; border: 1px solid #ddd;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Nama Siswa</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Kelas</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Jenis Kelamin</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Pilihan Ekskul</th>
                    <th style="padding: 10px; border: 1px solid #ddd;">Alasan</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $startNo = 1; // Initialize the counter

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr style='background-color: #fff;'>";
                    echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $startNo++ . "</td>";
                    echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['nama_siswa'] . "</td>";
                    echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['kelas'] . "</td>";
                    echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['jenis_kelamin'] . "</td>";
                    echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['nama_ekskul'] . "</td>";
                    echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $row['alasan'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId),
                nav = document.getElementById(navId),
                bodypd = document.getElementById(bodyId),
                headerpd = document.getElementById(headerId)

            // Validate that all variables exist
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // show navbar
                    nav.classList.toggle('show')
                    // change icon
                    toggle.classList.toggle('bx-x')
                    // add padding to body
                    bodypd.classList.toggle('body-pd')
                    // add padding to header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
    });
</script>

<!-- JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- DATATABLES JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            ordering: false,

        });
    });
</script>

</html>