<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}


$id = $_GET['id'];


$query = "SELECT * FROM poliklinik WHERE id_poli = $id ";
$getnama = mysqli_fetch_assoc(data($query));

$query = "SELECT * FROM pasien ORDER BY namapsn ASC ";
$dafpasien = data($query);

$query = "SELECT * FROM dokter WHERE id_poli = $id ";
$dafdokter = data($query);

$query = "SELECT * FROM dokter WHERE id_poli = $id ";
$tarif = data($query);

if(isset($_POST['tambah'])){
	$poli = $_POST['poli'];
	$pasien = $_POST['pasien'];
	$dokter = $_POST['dokter'];

	if( !empty($poli) && !empty($pasien) && !empty($dokter) ){
		$query = "INSERT INTO pendaftaran (dokter,pasien,poli)
					VALUES ('$dokter','$pasien','$poli') ";
		$daftar = data($query);
		if($daftar){
			header('Location: index.php');
		}else{
			echo "gagal";
		}
	}

}


 ?>

<?php headerku(); ?>
<div class="konten">
	<div class="mainop">
	
	<div class="k2 padding">
	<!-- <div class="pendaftaran"> -->
		<div class="form-abu border">
			<h2>Pendaftaran Poli <?= $getnama['poli'] ?></h2>
			<form action="" method="post">
				<label for="">Nama Pasien</label>
				<!-- id poli -->
				<input type="hidden" value="<?= $getnama['poli'] ?>" name="poli"> 
				<select name="pasien" class="full">
		<?php while($row = mysqli_fetch_assoc($dafpasien)){ ?>
					<option value="<?= $row['namapsn'] ?>"><?= $row['namapsn'] ?></option>
		<?php } ?>
				</select>
				<label for="">Pilih Dokter</label>
				<select name="dokter" class="full">
		<?php while($row = mysqli_fetch_assoc($dafdokter)){ ?>
					<option value="<?= $row['namadkt'] ?>"><?= $row['namadkt'] ?></option>
		<?php } ?>
				</select>
				<label for=""></label>
				<input type="submit" value="Daftarkan Pasien" class="biru" name="tambah">
			</form>
		</div>
	<!-- </div> -->
	</div>

	<div class="k2 padding">
		<table>
			<thead>
				<tr>
					<td>No</td>
					<td>Dokter</td>
					<td>Tarif</td>
				</tr>
			</thead>
			<tbody>
			<?php 
			$no = 0;
			while($row = mysqli_fetch_assoc($tarif)){ 
			$no++;
				?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $row['namadkt'] ?></td>
					<td>Rp <?= number_format($row['tarif']) ?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>

	</div>
</div>
<?php footerku(); ?>
