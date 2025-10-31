<?php 

include_once 'config/class-master.php';
include_once 'config/class-selebriti.php';
$master = new MasterData();
$selebriti = new Selebriti();
// Mengambil daftar program studi, provinsi, dan status selebriti
$prodiList = $master->getProdi();
// Mengambil daftar provinsi
$provinsiList = $master->getProvinsi();
// Mengambil daftar status selebriti
$statusList = $master->getStatus();
// Mengambil data selebriti yang akan diedit berdasarkan id dari parameter GET
$dataselebriti = $selebriti->getUpdateSelebriti($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data selebriti. Silakan coba lagi.');</script>";
    }
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
								<h3 class="mb-0">Edit Selebriti</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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
										<h3 class="card-title">Formulir Selebriti</h3>
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
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataSelebriti['id']; ?>">
                                            <div class="mb-3">
                                                <label for="kode" class="form-label">Kode Seleb</label>
                                                <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Kode Seleb " value="<?php echo $dataSelebriti['kode']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Selebriti" value="<?php echo $dataSelebriti['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="profesi" class="form-label">Profesi</label>
                                                <select class="form-select" id="profesi" name="profesi" required>
                                                    <option value="" selected disabled>Pilih Pofesi</option>
                                                    <?php 
                                                    // Iterasi daftar profesi dan menandai yang sesuai dengan data selebriti yang dipilih
                                                    foreach ($profesiList as $profesi){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedProfesi = "";
                                                        // Mengecek apakah profesi saat ini sesuai dengan data selebriti
                                                        if($dataSelebriti['profesi'] == $profesi['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedProfesi = "selected";
                                                        }
                                                        // Menampilkan opsi profesi dengan penanda yang sesuai
                                                        echo '<option value="'.$profesi['id'].'" '.$selectedProfesi.'>'.$prodi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Sesuai KTP" required><?php echo $dataSelebriti['alamat']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-select" id="provinsi" name="provinsi" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data selebriti yang dipilih
                                                    foreach ($provinsiList as $provinsi){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedProvinsi = "";
                                                        // Mengecek apakah provinsi saat ini sesuai dengan data selebriti
                                                        if($dataSelebriti['provinsi'] == $provinsi['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedProvinsi = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$provinsi['id'].'" '.$selectedProvinsi.'>'.$provinsi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid dan Benar" value="<?php echo $dataSelebriti['email']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="medsos" class="form-label">Media Sosial</label>
                                                <input type="text" class="form-control" id="medsos" name="medsos" placeholder="Masukkan Media Sosial" value="<?php echo $dataSelebriti['medsos']; ?>"  required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status selebriti dan menandai yang sesuai dengan data selebriti yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data selebriti
                                                        if($dataSelebriti['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
                                        </div>
                                    </form>
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