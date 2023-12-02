<?php 
session_start();
$link = mysqli_connect('localhost','root','','epoli');
function data($query){
	global $link;
	$result = mysqli_query($link,$query);
	return $result;
}

?>