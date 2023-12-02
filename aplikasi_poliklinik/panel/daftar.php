<?php 
require_once 'view/view.php'; 
require_once '../Control.php';
headku(); 

$query = "SELECT * FROM pendaftaran ORDER BY tanggal_daftar ASC ";
$read = data($query);

if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	$query = "SELECT * FROM pendaftaran WHERE pasien LIKE '%$cari%' ";
	$read = data($query);
}


 ?>

<div class="bungkus">

	<?php sideku(); ?>

	<div class="main">
		<div class="isimain">
				
					<center style="padding: 10px;"><h2>PASIEN TERDAFTAR POLI</h2></center>
				<div class="datatampil">
					<div class="add">
						<a href="cetak.php" class="tmbl lime kiri">Print Data</a>
						<form action="daftar.php" method="get" class="kanan">
							<input type="text" name="cari" placeholder="Cari data...">
							<button class="biru">Go</button>
						</form>
					</div>
					<label for="" class="clear"></label>
					<table class="full">
						<thead>
							<tr>
								<td>No</td>
								<td>Nama Pasien</td>
								<td>Poli</td>
								<td>Ditangani Oleh</td>
								<td>Terdaftar Pada</td>
							</tr>
						</thead>
						<tbody>
<?php 
$no = 0;
while($row = mysqli_fetch_assoc($read) ){ 
$no++;
?>
							<tr>
								<td><?= $no ?></td>
								<td><?= $row['pasien']; ?></td>
								<td><?= $row['poli']; ?></td>
								<td>dr. <?= $row['dokter']; ?></td>
								<td><?= $row['tanggal_daftar']; ?></td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>

		</div>
	</div>
<?php footerku(); ?>

</div>
