<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "SELECT * FROM dokter WHERE id_dokter=$id ";
$getdata = mysqli_fetch_assoc(data($query));


if(isset($_POST['edit'])){
	$id 			= $_POST['id'];
	$nama 			= $_POST['nama'];
	$jk 			= $_POST['jk'];
	$alamat 		= $_POST['alamat'];
	$telepon 		= $_POST['telepon'];
	$jmpraktek 		= $_POST['jmpraktek'];
	$tarif 			= $_POST['tarif'];

	if( !empty($nama) && !empty($jk) && !empty($alamat) && !empty($telepon) && !empty($jmpraktek) && !empty($tarif) ){
		$query = "UPDATE dokter SET namadkt='$nama',jk='$jk',alamat='$alamat',telepon='$telepon',jmpraktek='$jmpraktek',tarif='$tarif' WHERE id_dokter=$id ";
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
						<div class="form-abu">
								<div class="head-form">
									<h2>Edit Data Dokter</h2>
								</div>
							<form action="" method="post">
								<label for="">Nama Dokter</label>
								<input type="hidden" name="id" value="<?= $getdata['id_dokter']; ?>">
								<input type="text" name="nama" class="full" placeholder="Nama Dokter" value="<?= $getdata['namadkt']; ?>">
								<label for="">Jenis Kelamin</label>
								<input type="text" class="f50" name="jk" value="<?= $jk; ?>">
								<label for="">Alamat</label>
								<textarea name="alamat" class="full"><?= $getdata['alamat']; ?></textarea>
								<label for="">Telepon</label>
								<input type="number" class="f50" name="telepon" value="<?= $getdata['telepon']; ?>">
								<label for="">Waktu Praktek</label>
								<input type="text" class="f50" name="jmpraktek" value="<?= $jmpraktek; ?>">
								<label for="">Tarif</label>
								<input type="number" class="f50" name="tarif"  value="<?= $getdata['tarif']; ?>">
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