<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "DELETE FROM dokter WHERE id_dokter=$id ";
$delete = data($query);
	if($delete){
		header('Location:index.php');
	}


 ?>