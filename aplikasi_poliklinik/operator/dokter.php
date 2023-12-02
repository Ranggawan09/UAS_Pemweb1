<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}


$query = "SELECT * FROM dokter,poliklinik WHERE dokter.id_poli = poliklinik.id_poli ";
$read = data($query);

 ?>

<?php headerku(); ?>
<div class="konten">
	<!-- <div class="konten"> -->

		<div class="mainop">

			<h2>DAFTAR DOKTER</h2>
			
			<table>
				<thead>
					<tr>
						<td>No</td>
						<td>Nama Dokter</td>
						<td>Kode Dokter</td>
						<td>Spesialis</td>
						<td>Tarif</td>
						<td>Telepon</td>
					</tr>
				</thead>
				<tbody>
			<?php
			$no = 0;
			 while($row = mysqli_fetch_assoc($read)){ 
			 $no++;
			 	?>
					<tr>
						<td><?= $no ?></td>
						<td><?= $row['namadkt'] ?></td>
						<td><?= $row['kodedkt'] ?></td>
						<td><?= $row['poli'] ?></td>
						<td>Rp <?= number_format($row['tarif']) ?></td>
						<td><?= $row['telepon'] ?></td>
					</tr>
			<?php } ?>
				</tbody>
			</table>

		</div>

	<!-- </div> -->
</div>
<?php footerku(); ?>
