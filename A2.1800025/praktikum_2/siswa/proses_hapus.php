<?php
// panggil file database.php untuk koneksi ke database
require_once "config/database.php";
// jika tombol hapus di klik
if (isset($_GET['nis'])) {
	// ambil data get dari form 
	$nis = $_GET['nis'];
	// perintah query untuk menampilkan data foto siswa berdasakan nis
	$query  = mysqli_query($db, "SELECT foto FROM tabel_siswa WHERE nis='$nis'")
								or die('Ada kesalahan pada query tampil data foto :'.mysqli_error($db));
	$data   = mysqli_fetch_assoc($query);
	$foto  = $data['foto'];

	// hapus file foto dari folder foto
	 $hapus_file  = unlink("foto/$foto");
	// cek hapus file
	if ($hapus_file) {
	// jika file berhasil dihapus jalankan perintah query untuk menghapus data pada tabel siswa
		$delete  = mysqli_query($db, "DELETE FROM tabel_siswa WHERE nis='$nis'")
									or die ('Ada kelasahan pada query delete :'.mysqli_error($db));
	// cek hasil query
	if ($delete) {
		// jika berhasil tampilkan pesan berhasil delete data
	header("location: index.php?alert=3");
		}
	}
}
// tutup koneksi
mysqli_close($db);
?>