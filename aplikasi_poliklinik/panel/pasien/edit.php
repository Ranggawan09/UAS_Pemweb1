<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "SELECT * FROM pasien WHERE id_pasien=$id ";
$getdata = mysqli_fetch_assoc(data($query));


if(isset($_POST['edit'])){
	$id 				= $_POST['id'];
	$nama 			= $_POST['nama'];
	$alamat 		= $_POST['alamat'];
	$umur 			= $_POST['umur'];
	$telepon 		= $_POST['telepon'];

	if( !empty($nama) && !empty($alamat) && !empty($telepon) && !empty($umur) ){
		$query = "UPDATE pasien SET namapsn='$nama' ,alamatpsn='$alamat',umurpsn='$umur',teleponpsn='$telepon' WHERE id_pasien=$id ";
		$update = data($query);
		if($update){
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
						<div class="form">
								<div class="head-form">
									<h2>Edit Data Pasien</h2>
								</div>
							<form action="" method="post">
								<label for="">Nama Pasien</label>
								<input type="hidden" name="id" value="<?= $getdata['id_pasien']; ?>">
								<input type="text" name="nama" class="full" placeholder="Nama Pasien"  value="<?= $getdata['namapsn']; ?>">
								<label for="">Alamat</label>
								<textarea name="alamat" class="full"> <?= $getdata['alamatpsn']; ?></textarea>
								<label for="">Umur</label>
								<input type="text" class="f50" name="umur" value="<?= $getdata['umurpsn']; ?>">
								<label for="">Telepon</label>
								<input type="number" class="f50" name="telepon" value="<?= $getdata['teleponpsn']; ?>">
								<label for=""></label>
								<input type="submit" value="Edit Data" class="hijau" name="edit">
							</form>
						</div>
					</div>
					
				<!-- </div> -->

		</div>
	</div>
<?php footerku(); ?>

</div>