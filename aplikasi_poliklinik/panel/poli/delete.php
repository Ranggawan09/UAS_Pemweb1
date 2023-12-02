<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "DELETE FROM poliklinik WHERE id_poli=$id ";
$delete = data($query);
	if($delete){
		header('Location:index.php');
	}


 ?>