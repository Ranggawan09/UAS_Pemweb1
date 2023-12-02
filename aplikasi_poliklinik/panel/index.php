<?php 
require_once 'view/view.php'; 
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}

headku(); 
?>

<div class="bungkus">

	<?php sideku(); ?>
	<div class="main">
		<div class="isimain">		
	
		<div class="selamat">
			<img src="../asset/dokter.png" alt="">
			<p><h1>SELAMAT DATANG</h1></p>
			<h2>&#9630; Sistem Informasi Poliklinik | Home</h2>
		</div>


		</div>
	</div>
	<?php footerku(); ?>

</div>