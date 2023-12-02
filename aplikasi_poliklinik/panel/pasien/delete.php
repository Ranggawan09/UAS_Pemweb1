<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "DELETE FROM pasien WHERE id_pasien=$id ";
$delete = data($query);
	if($delete){
		header('Location:index.php');
	}


 ?>