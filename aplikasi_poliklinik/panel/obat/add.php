<?php 
require_once '../../Control.php';


if(isset($_POST['tambah'])){
	$kode 			= "OBT-00".date('is');
	$nama 			= $_POST['nama'];
	$jenis 			= $_POST['jenis'];
	$stok 			= $_POST['stok'];


	if( !empty($nama) ){
		$query = "INSERT INTO obat (kodeobat,namaobat,jenisobat,stok) VALUES ('$kode','$nama','$jenis','$stok') ";
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
									<h2>Tambah Obat</h2>
								</div>
							<form action="" method="post">
								<label for="">Nama Obat</label>
								<input type="text" name="nama" class="full" placeholder="Nama Obat">
								<label for="">Jenis Obat</label>
								<select name="jenis" id="">
									<option value="generik">Generik</option>
									<option value="non-generik">Non Generik</option>
								</select>
								<label for="">Stok</label>
								<input type="number" name="stok">
								<label for=""></label>
								<input type="submit" value="Tambah Data" class="hijau" name="tambah">
							</form>
						</div>
					</div>
					
				<!-- </div> -->

		</div>
	</div>
<?php footerku(); ?>

</div>