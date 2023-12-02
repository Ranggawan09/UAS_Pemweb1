<?php 
require_once '../../Control.php';

$query = "SELECT * FROM pasien";
$read = data($query);

if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	$query = "SELECT * FROM pasien WHERE namapsn LIKE '%$cari%' ";
	$read = data($query);
}


 ?>

<?php require_once 'view/view.php'; headku(); ?>
<div class="bungkus">

	<?php sideku(); ?>

	<div class="main">
		<div class="isimain">
				
					<center style="padding: 10px;"><h2>DAFTAR PASIEN</h2></center>
				<div class="datatampil">
					<div class="add">
						<a href="add.php" class="tmbl biru kiri">+ Tambah Data</a>
						<a href="cetak.php" class="tmbl lime kiri">Print Data</a>
						<form action="index.php" method="get" class="kanan">
							<input type="text" name="cari" placeholder="Cari data...">
							<button class="biru">Go</button>
						</form>
					</div>
					<label for="" class="clear"></label>
					<table class="full">
						<thead>
							<tr>
								<td>No</td>
								<td>Nama</td>
								<td>Kode</td>
								<td>Gender</td>
								<td>Umur</td>
								<td>Telepon</td>
								<td>Opsi</td>
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
								<td><?= $row['namapsn']; ?></td>
								<td><?= $row['kodepsn']; ?></td>
								<td><?= $row['genderpsn']; ?></td>
								<td><?= $row['umurpsn']; ?></td>
								<td><?= $row['teleponpsn']; ?></td>
								<td>
									<a href="edit.php?id=<?= $row['id_pasien'] ?>" class="tmbl biru">&#9998;</a>
									<a href="delete.php?id=<?= $row['id_pasien'] ?>" class="tmbl merah">&#10005;</a>
								</td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>

		</div>
	</div>
<?php footerku(); ?>

</div>