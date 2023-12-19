<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
	header('Location: ../index.php');
}

$query = "SELECT * FROM pasien ";
$read = data($query);

if(isset($_POST['tambah'])){
	$nama 			= $_POST['nama'];
	$gender 		= $_POST['gender'];
	$alamat 		= $_POST['alamat'];
	$telepon 		= $_POST['telepon'];
	$umur 			= $_POST['umur'];

	if( !empty($nama) && !empty($gender) && !empty($alamat) && !empty($telepon) && !empty($umur) ){
		$query = "INSERT INTO pasien (namapsn,alamatpsn,genderpsn,umurpsn,teleponpsn) VALUES 
							('$nama','$alamat','$gender','$umur','$telepon') ";
		$insert = data($query);
		if($insert){
            $_SESSION['success_message'] = 'Data berhasil ditambahkan';
            header('Location: pasien.php');
            exit();
		}
	}

}

// Check if there is a success message in the session
if (isset($_SESSION['success_message'])) {
    echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';

    // Unset the session variable to clear the message
    unset($_SESSION['success_message']);
}

 ?>

<?php headerku(); ?>
<div class="konten">
	<div class="mainop">

	<div class="k2 padding">
		<div class="form-abu border">
<!-- 				<div class="head-form">
					<h2>Pendaftaran Pasien</h2>
				</div> -->
			<label for=""><h3>PENDAFTARAN PASIEN</h3></label>
			<hr>
			<form action="" method="post">
				<label for="">Nama Pasien</label>
				<input type="text" name="nama" class="full" placeholder="Nama Pasien">
				<label for="">Jenis Kelamin</label>
				<select name="gender" class="f50">
					<option value="L">Laki-laki</option>
					<option value="P">Perempuan</option>
				</select>
				<label for="">Alamat</label>
				<textarea name="alamat" class="full"></textarea>
				<label for="">Umur</label>
				<input type="text" class="f50" name="umur">
				<label for="">Telepon</label>
				<input type="number" class="f50" name="telepon">
				<label for=""></label>
				<input type="submit" value="Daftarkan Pasien" class="hijau" name="tambah">
			</form>
		</div>
	</div>
		
	<style>
    .scrollable-table {
        max-height: 555px; /* Set the maximum height for the table body */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    /* Add any additional styles for your table, such as borders, spacing, etc. */
    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<div class="k2 padding">
    <div class="scrollable-table">
        <table>
            <thead>
                <tr>
                    <td>No</td>
                    <td>Nama Pasien</td>
                    <td>Jenis Kelamin</td>
                    <td>Alamat</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                while ($row = mysqli_fetch_assoc($read)) {
                    $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['namapsn'] ?></td>
                        <td><?= $row['genderpsn'] ?></td>
                        <td><?= $row['alamatpsn'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
	</div>
</div>
<?php footerku(); ?>
