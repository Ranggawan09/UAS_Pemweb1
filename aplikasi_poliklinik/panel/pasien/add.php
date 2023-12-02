<?php 
require_once '../../Control.php';


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
			header('Location:index.php');
		}
	}

}

 ?>
<?php require_once 'view/view.php'; headku(); ?>

<div class="bungkus">

	<?php sideku(); ?>

	<div class="main">
		<div class="isimain">
				
				<!-- <div class="datatampil"> -->
						<div class="back">
							<a href="index.php" class="tmbl biru">Kembali</a>
						</div>

					<div class="dokter">
						<div class="form-abu">
								<div class="head-form">
									<h2>Pendaftaran Pasien</h2>
								</div>
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
					
				<!-- </div> -->

		</div>
	</div>
<?php footerku(); ?>

</div>