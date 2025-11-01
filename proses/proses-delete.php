<?php

// Memasukkan file class-selebriti.php untuk mengakses class selebriti
include_once '../config/class-mahasiswa.php';
// Membuat objek dari class Selebriti
$Selebriti = new Selebriti();
// Mengambil id selebriti dari parameter GET
$id = $_GET['id'];
// Memanggil method deleteSelebriti untuk menghapus data mahasiswa berdasarkan id
$delete = $Selebriti->deleteSelebriti($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>