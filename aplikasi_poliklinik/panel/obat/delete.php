<?php 
require_once '../../Control.php';

$id = $_GET['id'];
$query = "DELETE FROM obat WHERE id_obat=$id ";
$delete = data($query);
	if($delete){
		header('Location:index.php');
	}


 ?>