<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Resep</title>
	<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<?php 
require_once 'Control.php';
// $error = "";
if(isset($_SESSION['user']) ){
	if($_SESSION['user'] == 'admin'){
		header('Location:panel/');
	}else{
		header('Location:operator/');
	}
}


if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	$password = md5($password);
	$status = $_POST['status'];

	if( !empty($username) && !empty($password) && !empty($status) ){
		$query = "SELECT * FROM users WHERE username='$username' AND password ='$password' AND status='$status' ";
		if( $login = data($query) ){
			if(mysqli_num_rows( $login ) !=0 ){
				$_SESSION['user'] = $status;
				if($status == 'admin'){
					header('Location:panel/');
				}else{
					header('Location:operator/');
				}
			}else{
				header('Location:index.php');
			}
		}
	}


}

 ?>

		<div class="login">
			
			<div class="welcome">
				<h1>Selamat datang</h1> 
				<h3>Aplikasi Penebusan Resep Dokter</h3>
			</div>

				<form action="" method="post" class="form-abu border">
					<div class="logodok"><img src="asset/dokter_login.png" alt=""></div>
					<label for="">Username</label>
					<input type="text" name="username" placeholder="Username" class="full">
					<label for="">Password</label>
					<input type="password" name="password" placeholder="Password" class="full">
					<label for=""></label>
					<select name="status" class="full">
						<option value="admin">Administrator</option>
						<option value="operator">Operator</option>
					</select>
					<label for=""></label>
					<input type="submit" name="login" value="Login" class="biru full">
					<label for=""></label>
					<label for=""></label>
				</form>

			<div class="welcome">
				<p>&copy; Rangga, Luluk, Arif</p>
			</div>
			
		</div>




</body>
</html>
