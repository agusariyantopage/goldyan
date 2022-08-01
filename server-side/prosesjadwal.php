<?php
include "../koneksi.php";
$idjadwal= $_POST['idjadwal'];
?>

<?php
// Get Harga Terupdate
$sql1="select * from harga order by id_harga desc";
$query1=mysqli_query($koneksi,$sql1);
$data1=mysqli_fetch_array($query1);

if($_SESSION['backend_user_akses']==1){ 
	$sql="select jadwal.*,client.latitude,client.longitude,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status='Pending' order by nama_client";
} else {
	$sql="select jadwal.*,client.latitude,client.longitude,client.id_regional,client.nama as nama_client,karyawan.nama as kolektor,regional.regional from jadwal,client,karyawan,regional where jadwal.id_client=client.id_client and jadwal.id_karyawan=karyawan.id_karyawan and client.id_regional=regional.id_regional and status='Pending' and jadwal.id_karyawan=$id_user order by nama_client";
}
$query=mysqli_query($koneksi,$sql);
$no=0;
while($kolom=mysqli_fetch_array($query)){

?>
<div class="col-sm-6 col-md-4">

	<div class="card">
		<div class="card-header bg-warning"><?= $kolom['nama_client']; ?></div>
		<div class="card-body">
			<form action="aksi/jadwal.php" method="POST">
			<input type="hidden" name="aksi" value="tambah-pembelian">
			<input type="hidden" name="id_jadwal" value="<?= $kolom['id_jadwal']; ?>">
			<label for="tanggal">Tanggal Terjadwal</label>
			<input type="date" class="form-control" value="<?= $kolom['tanggal']; ?>" readonly>
			<label for="jumlah">Jumlah (Jirigen)</label>
			<input type="number" step=".01" id="jumlah" name="jumlah" class="form-control" required>
			<label for="harga">Harga Per Jirigen</label>
			<input type="number" name="harga" id="harga" value="<?= $data1['harga']; ?>" class="form-control" required readonly>
			<label for="total">Total</label>
			<input type="number" name="total" id="total" value="0" class="form-control" required readonly>
			<label for="metode_bayar">Metode Pembayaran</label>
			<select name="metode_bayar" class="form-control" required> 
				<option value="KAS">KAS</option>
				<option value="OVO">OVO</option>
			</select>
			<label for="catatan">Catatan</label>
			<textarea name="catatan" class="form-control" rows="3"></textarea>
		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-info"><i class="fas fa-save"></i> Proses</button></form>
			
			<a href="aksi/jadwal.php?aksi=collecting-kosong&token=<?= md5($kolom['id_jadwal']); ?>" onclick="return confirm('Apakah Yakin Transaksi Ini Dikosongkan??')"><button type="button" class="btn btn-danger"><i class="fas fa-trash"></i> Kosong</button></a>
			<a target="blank" href="https://www.google.com/maps?q=<?= $kolom['latitude']; ?>,<?= $kolom['longitude']; ?>"><button type="button" class="btn btn-success"> <i class="fas fa-map"></i> Peta</button></a>
			
		</div>
	</div>

</div>  
<?php $no++;} ?>
