<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}

 ?>

<?php headerku(); ?>
<div class="konten">
	<div class="mainop">
		
	</div>
</div>
<?php footerku(); ?>
