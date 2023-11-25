<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $baseUsername = $_POST['username'];
    $password = $_POST['password'];

    // Check if the base username is already in use
    $check_base_username_query = "SELECT * FROM siswa_daftar WHERE username LIKE ?";
    $stmt_check_base_username = mysqli_prepare($koneksi, $check_base_username_query);
    mysqli_stmt_bind_param($stmt_check_base_username, "s", $baseUsername);
    mysqli_stmt_execute($stmt_check_base_username);
    $check_base_username_result = mysqli_stmt_get_result($stmt_check_base_username);

    if (mysqli_num_rows($check_base_username_result) > 0) {
        // Base username sudah digunakan
        header("location:../daftar.php?error=" . urlencode("Base username sudah digunakan. Silakan pilih base username lain."));
        exit;
    }

    // Insert data into the database
    $query = "INSERT INTO siswa_daftar (username, password) VALUES (?, ?)";
    $stmt_insert_data = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt_insert_data, "ss", $baseUsername, md5($password));
    mysqli_stmt_execute($stmt_insert_data);

    header("location:../index.php");
    exit;
}
