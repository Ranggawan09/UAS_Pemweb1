<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}

$query = "SELECT * FROM pasien ";
$read = data($query);

if(isset($_POST['tambah'])){
	$kode 			= "PSN-".date('dis');
	$nama 			= $_POST['nama'];
	$gender 		= $_POST['gender'];
	$alamat 		= $_POST['alamat'];
	$telepon 		= $_POST['telepon'];
	$umur 			= $_POST['umur'];

	if( !empty($kode) && !empty($nama) && !empty($gender) && !empty($alamat) && !empty($telepon) && !empty($umur) ){
		$query = "INSERT INTO pasien (kodepsn,namapsn,alamatpsn,genderpsn,umurpsn,teleponpsn) VALUES 
							('$kode','$nama','$alamat','$gender','$umur','$telepon') ";
		$insert = data($query);
		if($insert){
			header('Location:pasien.php');
		}
	}

}

 ?>

<?php headerku(); ?>
<div class="konten">
	<div class="mainop">

	<div class="k2 padding">
		<div class="form-abu border">
<!-- 				<div class="head-form">
					<h2>Pendaftaran Pasien</h2>
				</div> -->
			<label for=""><h3>PENDAFTARAN PASIEN</h3></label>
			<hr>
			<form action="" method="post">
				<label for="">Nama Pasien</label>
				<input type="text" name="nama" class="full" placeholder="Nama Pasien">
				<label for="">Gender</label>
				<select name="gender" class="f50">
					<option value="L">Laki-laki</option>
					<option value="P">Perempuan</option>
				</select>
				<label for="">Alamat</label>
				<textarea name="alamat" class="full"></textarea>
				<label for="">Umur</label>
				<input type="text" class="f50" name="umur">
				<label for="">Telepon</label>
				<input type="number" class="f50" name="telepon">
				<label for=""></label>
				<input type="submit" value="Daftarkan Pasien" class="hijau" name="tambah">
			</form>
		</div>
	</div>
		
	<div class="k2 padding">
		<table>
			<thead>
				<tr>
					<td>No</td>
					<td>Nama Pasien</td>
					<td>Kode</td>
					<td>Gender</td>
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
					<td><?= $row['namapsn'] ?></td>
					<td><?= $row['kodepsn'] ?></td>
					<td><?= $row['genderpsn'] ?></td>
				</tr>
		<?php } ?>
			</tbody>
		</table>
	</div>

	</div>
</div>
<?php footerku(); ?>
