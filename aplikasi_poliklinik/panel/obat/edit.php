<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "SELECT * FROM obat WHERE id_obat=$id ";
$getdata = mysqli_fetch_assoc(data($query));


if(isset($_POST['edit'])){
	$id 			= $_POST['id'];
	$nama 			= $_POST['nama_obat'];
	$kode 			= $_POST['kode_obat'];
	$jenis 		= $_POST['jenis_obat'];
	$stok 			= $_POST['stok'];
	$harga 		= $_POST['harga_obat'];

	if( !empty($nama) && !empty($kode) && !empty($jenis) && !empty($stok) && !empty($harga) ){
		$query = "UPDATE obat SET nama_obat='$nama' ,kode_obat='$kode' ,jenis_obat='$jenis' ,stok='$stok' ,harga_obat='$harga' WHERE id_obat=$id ";
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
								<label for="">Nama Obat</label>
								<input type="hidden" name="id" value="<?= $getdata['id_obat']; ?>">
								<input type="text" name="nama_obat" class="full" placeholder="Nama Obat"  value="<?= $getdata['nama_obat']; ?>">
								<label for="">Kode Obat</label>
								<textarea name="kode_obat" class="full"> <?= $getdata['kode_obat']; ?></textarea>
								<label for="">Jenis Obat</label>
								<input type="text" class="f50" name="jenis_obat" value="<?= $getdata['jenis_obat']; ?>">
								<label for="">Stok</label>
								<input type="number" class="f50" name="stok" value="<?= $getdata['stok']; ?>">
								<label for="">Harga Obat</label>
								<input type="number" class="f50" name="harga_obat" value="<?= $getdata['harga_obat']; ?>">
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