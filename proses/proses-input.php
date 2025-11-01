<?php

// Memasukkan file class-selebriti.php untuk mengakses class Selebriti
include '../config/class-mahasiswa.php';
// Membuat objek dari class Selebriti
$Selebriti = new Selebriti();
// Mengambil data selebriti dari form input menggunakan metode POST dan menyimpannya dalam array
$dataSelebriti = [
    'kode' => $_POST['kode'],
    'nama' => $_POST['nama'],
    'profesi' => $_POST['profesi'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email' => $_POST['email'],
    'medsos' => $_POST['medsos'],
    'status' => $_POST['status']
];
// Memanggil method inputSelebriti untuk memasukkan data selebriti dengan parameter array $dataSelebriti
$input = $Selebriti->inputSelebriti($dataSelebriti);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>