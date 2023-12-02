<?php 
require_once '../../Control.php';


if(isset($_POST['tambah'])){
	$nama 			= $_POST['nama'];
	$kode 			= "PLK-00".date('is');

	if( !empty($nama) ){
		$query = "INSERT INTO poliklinik (poli,kodeplk) VALUES ('$nama','$kode') ";
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
									<h2>Tambah Poliklinik</h2>
								</div>
							<form action="" method="post">
								<label for="">Nama Poliklinik</label>
								<input type="text" name="nama" class="full" placeholder="Nama Poli">
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