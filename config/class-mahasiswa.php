<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Selebriti extends Database {

    // Method untuk input data selebriti
    public function inputSelebriti($data){
        // Mengambil data dari parameter $data
        $kode     = $data['kode'];
        $nama     = $data['nama'];
        $profesi  = $data['profesi'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $medsos   = $data['medsos'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_selebriti (kode_slb, nama_slb, profesi_slb, alamat, provinsi, email, medsos, status_slb) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $kode, $nama, $profesi, $alamat, $provinsi, $email, $medsos, $status);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data selebriti
    public function getAllSelebriti(){
        // Menyiapkan query SQL untuk mengambil data selebriti beserta profesi dan provinsi
        $query = "SELECT id_slb, kode_slb, nama_slb, nama_profesi, nama_provinsi, alamat, email, medsos, status_slb 
                  FROM tb_selebriti
                  JOIN tb_profesi ON profesi_slb = kode_profesi
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data selebriti
        $selebriti = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $selebriti[] = [
                    'id' => $row['id_slb'],
                    'kode' => $row['kode_slb'],
                    'nama' => $row['nama_slb'],
                    'profesi' => $row['nama_profesi'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'medsos' => $row['medsos'],
                    'status' => $row['status_mhs']
                ];
            }
        }
        // Mengembalikan array data selebriti
        return $selebriti;
    }

    // Method untuk mengambil data selebriti berdasarkan ID
    public function getUpdateSelebriti($id){
        // Menyiapkan query SQL untuk mengambil data selebriti berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_selebriti WHERE id_slb = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data selebriti  
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_slb'],
                'kode' => $row['kode_slb'],
                'nama' => $row['nama_slb'],
                'profesi' => $row['profesi_slb'],
                'alamat' => $row['alamat'],
                'provinsi' => $row['provinsi'],
                'email' => $row['email'],
                'medsos' => $row['medsos'],
                'status' => $row['status_slb']
            ];
        }
        $stmt->close();
        // Mengembalikan data selebriti
        return $data;
    }

    // Method untuk mengedit data selebriti
    public function editSelebriti($data){
        // Mengambil data dari parameter $data
        $id       = $data['id'];
        $kode     = $data['kode'];
        $nama     = $data['nama'];
        $profesi  = $data['profesi'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $medsos   = $data['medsos'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_selebriti SET kode_slb = ?, nama_slb = ?, profesi_slb = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_slb = ? WHERE id_slb = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssssi", $kode, $nama, $profesi, $alamat, $provinsi, $email, $medsos, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data selebriti
    public function deleteSelebriti($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_selebriti WHERE id_slb = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data selebriti berdasarkan kata kunci
    public function searchSelebriti($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data selebriti menggunakan prepared statement
        $query = "SELECT id_slb, kode_slb, nama_slb, nama_profesi, nama_provinsi, alamat, email, medsos, status_slb 
                  FROM tb_selebriti
                  JOIN tb_profesi ON profesi_slb = kode_profesi
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE kode_slb LIKE ? OR nama_slb LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data selebriti
        $selebriti = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data selebriti dalam array
                $selebriti[] = [
                    'id' => $row['id_slb'],
                    'kode' => $row['kode_slb'],
                    'nama' => $row['nama_slb'],
                    'profesi' => $row['nama_profesi'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'medsos' => $row['medsos'],
                    'status' => $row['status_slb']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data selebriti yang ditemukan
        return $selebriti;
    }

}

?>