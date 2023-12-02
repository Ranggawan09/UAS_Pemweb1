<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "SELECT * FROM poliklinik,dokter WHERE poliklinik.id_poli,dokter.id_poli = $id ";
$read = data($query);


 ?>

<?php require_once 'view/view.php'; headku(); ?>
<div class="bungkus">

	<?php sideku(); ?>

	<div class="main">
		<div class="isimain">
				
				<div class="datatampil">
					<center style="padding: 10px;"><h2>DETAIL DOKTER POLI</h2></center>
					<div class="add">
						<a href="index.php" class="tmbl biru kiri">Kembali</a>
					</div>
					<label for="" class="clear"></label>
					<table class="full">
						<thead>
							<tr>
								<td>No</td>
								<td>Nama Dokter</td>
								<td>Spesialis Poli</td>
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
								<td><?= $row['namadkt'] ?></td>
								<td><?= $row['poli'] ?></td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>

		</div>
	</div>
<?php footerku(); ?>

</div>