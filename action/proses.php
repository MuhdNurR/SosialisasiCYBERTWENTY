<?php
include '../koneksi.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $pilihan = $_POST['ekskul'];
    $alasan = $_POST['alasan'];
    $username_login = $_SESSION['username'];  // Mengambil username dari session

    // Periksa apakah data pengguna sudah ada dalam tabel siswa_daftar
    $check_user_query = "SELECT * FROM siswa_daftar WHERE username = ?";
    $stmt_check_user = mysqli_prepare($koneksi, $check_user_query);
    mysqli_stmt_bind_param($stmt_check_user, "s", $username_login);
    mysqli_stmt_execute($stmt_check_user);
    $check_user_result = mysqli_stmt_get_result($stmt_check_user);

    if (mysqli_num_rows($check_user_result) > 0) {
        // Data pengguna sudah ada, lakukan UPDATE
        $update_query = "UPDATE siswa_daftar SET nama_siswa=?, kelas=?, jenis_kelamin=?, alasan=?, id_ekskul=? WHERE username=?";
        $stmt_update = mysqli_prepare($koneksi, $update_query);

        if ($stmt_update) {
            // Binding parameter ke prepared statement
            mysqli_stmt_bind_param($stmt_update, "ssssis", $nama, $kelas, $jenis_kelamin, $alasan, $pilihan, $username_login);

            // Eksekusi prepared statement
            mysqli_stmt_execute($stmt_update);

            // Tutup prepared statement
            mysqli_stmt_close($stmt_update);

            header("location: ../dashboard.php");
            exit;
        } else {
            echo "Gagal membuat prepared statement.";
        }
    } else {
        // Data pengguna belum ada, lakukan INSERT
        $insert_query = "INSERT INTO siswa_daftar(nama_siswa, kelas, jenis_kelamin, alasan, id_ekskul, username) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt_insert = mysqli_prepare($koneksi, $insert_query);

        if ($stmt_insert) {
            // Binding parameter ke prepared statement
            mysqli_stmt_bind_param($stmt_insert, "ssssi", $nama, $kelas, $jenis_kelamin, $alasan, $pilihan, $username_login);

            // Eksekusi prepared statement
            mysqli_stmt_execute($stmt_insert);

            // Tutup prepared statement
            mysqli_stmt_close($stmt_insert);

            header("location: ../dashboard.php");
            exit;
        } else {
            echo "Gagal membuat prepared statement.";
        }
    }
}

mysqli_close($koneksi);
?>