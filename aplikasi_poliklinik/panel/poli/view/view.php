<?php function headku(){ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Panel</title>
	<link rel="stylesheet" href="../../style.css">
	<script>
		function buka(){
			var menu = document.getElementById('myside');
			menu.classList.toggle('menu-open');
		}
	</script>
</head>
<body>
	<div class="head">
		<h2 class="kiri">&#9630; Sistem Informasi Poliklinik</h2>
		<a href="../logout.php" class="kanan"><span>Logout</span></a>
	</div>
<?php } ?>



<?php function sideku(){ ?>
	<div class="side">
		<span style="background: #01121C; border:none; color: #fff;">Navigasi Menu</span>
		<a href="../index.php"><span>Home</span></a>
		<span onclick="buka();">Data Master<b class="kanan">&#10095;</b> </span>
			<div id="myside">
				<a href="../dokter/"><span>&#9921; Data Dokter</span></a>
				<a href="../pasien/"><span>&#9921; Data Pasien</span></a>
				<a href="index.php"><span>&#9921; Data Poli</span></a>
				<a href="../obat/"><span>&#9921; Data Obat</span></a>
			</div>
		<a href="../daftar.php"><span>Pasien Terdaftar</span></a>
		
	</div>
<?php } ?>

<?php function footerku(){ ?>
<footer>
	<p>&copy; Rangga, Luluk, Arif | Sistem Informasi</p>
	<p>Unipdu 2023</p>
</footer>
</body>
</html>
<?php } ?>