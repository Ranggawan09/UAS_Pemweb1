<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}

$query = "SELECT * FROM poliklinik";
$dafpoli = data($query);

 ?>

<?php headerku(); ?>
<div class="konten">
	<div class="mainop">

		<div class="pilih">
			<h1>Pilih Poli</h1>
		</div>
		<div class="k2 padding">
		<?php while($row = mysqli_fetch_assoc($dafpoli)){ ?>
			<a href="daftar.php?id=<?= $row['id_poli'] ?>">
				<div class="dafpoli border">
					Poli <?= $row['poli'] ?>
				</div>
			</a>
		<?php } ?>
		</div>
	
		<div class="k2 padding">
			<div class="pilimg">
				<img src="../asset/dokter.png" alt="">
			</div>
		</div>


	</div>
</div>
<?php footerku(); ?>
