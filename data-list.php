<?php

include_once 'config/class-selebriti.php';
$selebriti = new selebriti();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data selebriti berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data selebriti berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data selebriti berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data selebriti. Silakan coba lagi.');</script>";
	}
}
$dataSelebriti = $selebriti->getAllSelebriti();

?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Daftar Selebriti</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Tabel Selebriti</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>Kode</th>
													<th>Nama</th>
													<th>Profesi</th>
													<th>Provinsi</th>
													<th>Alamat</th>
													<th>medsos</th>
													<th>Email</th>
													<th class="text-center">Status</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($dataSelebriti) == 0){
													    echo '<tr class="align-middle">
															<td colspan="10" class="text-center">Tidak ada data mahasiswa.</td>
														</tr>';
													} else {
														foreach ($dataSelebriti as $index => $selebriti){
															if($selebriti['status'] == 1){
															    $selebriti['status'] = '<span class="badge bg-success">Single</span>';
															} elseif($selebriti['status'] == 2){
															    $selebriti['status'] = '<span class="badge bg-danger">Berpacaran</span>';
															} elseif($selebriti['status'] == 3){
															    $selebriti['status'] = '<span class="badge bg-warning text-dark">Menikah</span>';
															} 
															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$selebriti['kode'].'</td>
																<td>'.$selebriti['nama'].'</td>
																<td>'.$selebriti['profesi'].'</td>
																<td>'.$selebriti['provinsi'].'</td>
																<td>'.$selebriti['alamat'].'</td>
																<td>'.$selebriti['medsos'].'</td>
																<td>'.$selebriti['email'].'</td>
																<td class="text-center">'.$selebriti['status'].'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$selebriti['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data mahasiswa ini?\')){window.location.href=\'proses/proses-delete.php?id='.$selebriti['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Selebriti</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>