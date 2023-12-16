<?php 
require_once '../../Control.php';

$query = "SELECT * FROM obat";
$read = data($query);

if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	$query = "SELECT * FROM obat WHERE namaobat LIKE '%$cari%' ";
	$read = data($query);
}


 ?>

<?php require_once 'view/view.php'; headku(); ?>
<div class="bungkus">

	<?php sideku(); ?>

	<div class="main">
		<div class="isimain">
				
					<center style="padding: 10px;"><h2>DAFTAR OBAT</h2></center>
				<div class="datatampil">
					<div class="add">
						<a href="add.php" class="tmbl biru kiri">+ Tambah Obat</a>
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
								<td>Nama Obat</td>
								<td>Kode Obat</td>
								<td>Jenis Obat</td>
								<td>Stok</td>
								<td>Harga Obat</td>
								<td>Hapus</td>
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
								<td><?= $row['nama_obat'] ?></td>
								<td><?= $row['kode_obat'] ?></td>
								<td><?= $row['jenis_obat'] ?></td>
								<td><?= $row['stok'] ?></td>
								<td>Rp. <?= $row['harga_obat'] ?></td>
								<td>
									<a href="edit.php?id=<?= $row['id_obat'] ?>" class="tmbl biru">&#9998;</a>
									<a href="delete.php?id=<?= $row['id_obat'] ?>" class="tmbl merah">&#10005;</a>
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