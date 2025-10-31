<?php

// Memasukkan file class-selebriti.php untuk mengakses class Selebriti
include_once '../config/class-selebriti.php';
// Membuat objek dari class Selebriti
$selebriti = new Selebriti();
// Mengambil data selebriti dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataSelebriti = [
    'id' => $_POST['id'],
    'kode' => $_POST['kode'],
    'nama' => $_POST['nama'],
    'profesi' => $_POST['profesi'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi'],
    'email' => $_POST['email'],
    'medsos' => $_POST['medsos'],
    'status' => $_POST['status']
];
// Memanggil method editSelebriti untuk mengupdate data selebriti dengan parameter array $dataSelebriti
$edit = $selebriti->editSelebriti($dataSelebriti);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id selebriti
    header("Location: ../data-edit.php?id=".$dataSelebriti['id']."&status=failed");
}

?>