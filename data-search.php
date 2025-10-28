<?php

include_once 'config/class-selebriti.php';
$Selebriti = new selebriti();
$kataKunci = '';
// Mengecek apakah parameter GET 'search' ada
if(isset($_GET['search'])){
	// Mengambil kata kunci pencarian dari parameter GET 'search'
	$kataKunci = $_GET['search'];
	// Memanggil method searchSelebriti untuk mencari data selebriti berdasarkan kata kunci dan menyimpan hasil dalam variabel $cariSelebriti
	$cariSelebriti = $selebriti->searchSelebriti($kataKunci);
} 
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
								<h3 class="mb-0">Cari Selebriti</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Cari Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card mb-3">
									<div class="card-header">
										<h3 class="card-title">Pencarian Selebriti</h3>
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
									<div class="card-body">
										<form action="data-search.php" method="GET">
											<div class="mb-3">
												<label for="search" class="form-label">Masukkan Nama atau Agama Selebriti</label>
												<input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan Nama atau Agama Selebriti" value="<?php echo $kataKunci; ?>" required>
											</div>
											<button type="submit" class="btn btn-primary"><i class="bi bi-search-heart-fill"></i> Cari</button>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Hasil Pencarian</h3>
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
									<div class="card-body">
										<?php
										// Mengecek apakah parameter GET 'search' ada
										if(isset($_GET['search'])){
											// Mengecek apakah ada data selebriti yang ditemukan
											if(count($cariSelebriti) > 0){
												// Menampilkan tabel hasil pencarian
												echo '<table class="table table-striped" role="table">
													<thead>
														<tr>
															<th>No</th>
															<th>Nama</th>
															<th>Agama</th>
															<th>Profesi</th>
															<th>Provinsi</th>
															<th>Alamat</th>
															<th>Medsos</th>
															<th>Email</th>
															<th class="text-center">Status</th>
															<th class="text-center">Aksi</th>
														</tr>
													</thead>
													<tbody>';
													// Iterasi data selebriti yang ditemukan dan menampilkannya dalam tabel
													foreach ($cariSelebriti as $index => $selebriti){
														// Mengubah status selebriti menjadi badge dengan warna yang sesuai
														if($selebriti['status'] == 1){
															$selebriti['status'] = '<span class="badge bg-success">Single</span>';
														} elseif($selebriti['status'] == 2){
															$mahasiswa['status'] = '<span class="badge bg-danger">Berpacaran</span>';
														} elseif($selebriti['status'] == 3){
															$selebriti['status'] = '<span class="badge bg-warning text-dark">Menikah</span>';
														} 
														// Menampilkan baris data selebriti dalam tabel
														echo '<tr class="align-middle">
															<td>'.($index + 1).'</td>
															<td>'.$selebriti['nama'].'</td>
															<td>'.$selebriti['agama'].'</td>
															<td>'.$selebriti['prodi'].'</td>
															<td>'.$selebriti['provinsi'].'</td>
															<td>'.$selebriti['alamat'].'</td>
															<td>'.$selebriti['medsos'].'</td>
															<td>'.$selebriti['email'].'</td>
															<td class="text-center">'.$selebriti['status'].'</td>
															<td class="text-center">
																<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$selebriti['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data mahasiswa ini?\')){window.location.href=\'proses/proses-delete.php?id='.$mahasiswa['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
															</td>
														</tr>';
													}
												echo '</tbody>
												</table>';
											} else {
												// Menampilkan pesan jika tidak ada data selebriti yang ditemukan
												echo '<div class="alert alert-warning" role="alert">
														Tidak ditemukan data selebriti yang sesuai dengan kata kunci "<strong>'.htmlspecialchars($_GET['search']).'</strong>".
													  </div>';
											}
										} else {
											// Menampilkan pesan jika form pencarian belum disubmit
											echo '<div class="alert alert-info" role="alert">
													Silakan masukkan kata kunci pencarian di atas untuk mencari data selebriti.
												  </div>';
										}
										?>
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