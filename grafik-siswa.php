<?php
// Memulai sesi
session_start();

// Include file koneksi.php
include_once("koneksi.php");

if (!isset($_SESSION['username'])) {
    header("location: index.php"); // Redirect ke halaman login jika belum login
    exit;
}

// Query untuk mendapatkan jumlah siswa per jenis kelamin / Chart Jenis Kelamin
// Query to get gender distribution data
$genderQuery = "SELECT jenis_kelamin, COUNT(*) as count FROM siswa_daftar GROUP BY jenis_kelamin";
$genderResult = mysqli_query($koneksi, $genderQuery);

$genderLabels = [];
$genderData = [];

while ($row = mysqli_fetch_assoc($genderResult)) {
    $genderLabels[] = $row['jenis_kelamin'];
    $genderData[] = $row['count'];
}

// Query untuk menghitung jumlah siswa per ekskul / Chart Ekskul
$countQuery = "SELECT e.nama_ekskul, COUNT(sd.id_daftar) as jumlah_siswa
               FROM ekskul e
               LEFT JOIN siswa_daftar sd ON e.id_ekskul = sd.id_ekskul
               GROUP BY e.id_ekskul";

$countResult = mysqli_query($koneksi, $countQuery);

// Query untuk menampilkan data siswa dan ekskul
$query = "SELECT sd.nama_siswa, sd.kelas, sd.jenis_kelamin, sd.alasan, e.nama_ekskul
          FROM siswa_daftar sd
          INNER JOIN ekskul e ON e.id_ekskul = sd.id_ekskul";
$result = mysqli_query($koneksi, $query);

// Mengambil data jumlah siswa per ekskul
$ekskulLabels = [];
$ekskulData = [];

while ($row = mysqli_fetch_assoc($countResult)) {
    $ekskulLabels[] = $row['nama_ekskul'];
    $ekskulData[] = $row['jumlah_siswa'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Siswa</title>

    <!-- CDN -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body id="body-pd">
    <?php include('side-bar.php') ?>
    <div class="container mt-5 pt-5" style="width: 100%; height:300px">
        <canvas id="ekskulChart"></canvas>
    </div>
    <div class="container mt-5" style="width: 100%; height:300px">
        <canvas id="myChart"></canvas>
    </div>
    <div class="container mt-5" style="width: 100%; height:500px">
        <canvas id="pieChart"></canvas>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('ekskulChart').getContext('2d');

        var data = {
            labels: <?php echo json_encode($ekskulLabels); ?>,
            datasets: [{
                label: 'Jumlah Siswa per Ekskul',
                backgroundColor: ['blue', 'grey', 'orange', 'red'], // Warna background batang chart
                data: <?php echo json_encode($ekskulData); ?>,
            }]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
        };

        var ekskulChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('myChart').getContext('2d');

        var genderData = {
            labels: <?php echo json_encode($genderLabels); ?>,
            datasets: [{
                label: 'Gender Distribution',
                backgroundColor: ['blue', 'pink'], // Customize the colors as needed
                data: <?php echo json_encode($genderData); ?>,
            }]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
        };

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: genderData,
            options: options
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('pieChart').getContext('2d');

        var ekskulData = {
            labels: <?php echo json_encode($ekskulLabels); ?>,
            datasets: [{
                label: 'Gender Distribution',
                backgroundColor: ['blue', 'grey', 'orange', 'red'], // Customize the colors as needed
                data: <?php echo json_encode($ekskulData); ?>,
            }]
        };

        var options = {
            responsive: true,
            maintainAspectRatio: false,
        };

        var myChart = new Chart(ctx, {
            type: 'pie',
            data: ekskulData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Chart.js Pie Chart'
                    }
                }
            },
        });
    });
</script>

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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            ordering: false,

        });
    });
</script>


</html>