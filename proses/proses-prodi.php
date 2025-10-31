<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputprofesi'){
    // Mengambil data profesi dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataProfesi = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputProfesi untuk memasukkan data profesi dengan parameter array $dataProfesi
    $input = $master->inputProfesi($dataProfesi);
    if($input){
        // Jika berhasil, redirect ke halaman master-profesi-list.php dengan status inputsuccess
        header("Location: ../master-profesi-list.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-profesi-input.php dengan status failed
        header("Location: ../master-profesi-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updateprofesi'){
    // Mengambil data profesi dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataProfesi = [
        'id' => $_POST['id'],
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateProfesi untuk mengupdate data profesi dengan parameter array $dataProfesi
    $update = $master->updateProfesi($dataProfesi);
    if($update){
        // Jika berhasil, redirect ke halaman master-profesi-list.php dengan status editsuccess
        header("Location: ../master-profesi-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-profesi-edit.php dengan status failed dan membawa id profesi
        header("Location: ../master-profesi-edit.php?id=".$dataProfesi['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deleteprofesi'){
    // Mengambil id profesi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProfesi untuk menghapus data profesi berdasarkan id
    $delete = $master->deleteProfesi($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-profesi-list.php dengan status deletesuccess
        header("Location: ../master-profesi-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-profesi-list.php dengan status deletefailed
        header("Location: ../master-profesi-list.php?status=deletefailed");
    }
}

?>