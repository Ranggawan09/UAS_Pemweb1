<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}

$poli = $_GET['poli'];

$query = "SELECT * FROM pendaftaran WHERE poli = '$poli' ";
$read = data($query);
 ?>

<?php headerku(); ?>
<div class="konten">
	<!-- <div class="konten"> -->

		<div class="mainop">
			<a href="dafpasien.php" class="tmbl biru">Kembali</a>
			<h2>PASIEN POLI DOKTER</h2>
			
			<table>
				<thead>
					<tr>
						<td>No</td>
						<td>Nama Pasien</td>
						<td>Nama Dokter</td>
						<td>Spesialis</td>
						<td>Waktu</td>
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
						<td><?= $row['pasien'] ?></td>
						<td><?= $row['dokter'] ?></td>
						<td><?= $row['poli'] ?></td>
						<td><?= $row['tanggal_daftar'] ?></td>
					</tr>
			<?php } ?>
				</tbody>
			</table>

		</div>

	<!-- </div> -->
</div>
<?php footerku(); ?>
