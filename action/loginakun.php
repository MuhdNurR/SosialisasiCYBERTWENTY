<?php
session_start(); // Memulai sesi

include '../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Ubah kueri SQL untuk mengambil id_ekskul selain dari username dan password
$sql = mysqli_query($koneksi, "SELECT * FROM siswa_daftar WHERE username='$username' AND password ='$password'");

$cek = mysqli_num_rows($sql);

if ($cek > 0) {
    // Jika login berhasil, ambil data pengguna dan simpan informasi dalam sesi
    $row = mysqli_fetch_assoc($sql);
    $_SESSION['username'] = $username;
    $_SESSION['id_ekskul'] = $row['id_ekskul']; // Simpan id_ekskul dalam sesi
    header("location: ../dashboard.php");
    exit;
} else {
    header("location: ../index.php?error=" . urlencode("Username atau password salah. Silakan coba lagi."));
}
