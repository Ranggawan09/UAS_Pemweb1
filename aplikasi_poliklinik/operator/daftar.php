<?php 
require_once 'view/view.php';
require_once '../Control.php';

if(!isset($_SESSION['user']) ){
    header('Location: ../index.php');
}

$id = $_GET['id'];

// Query untuk mendapatkan nama poliklinik
$queryPoliklinik = "SELECT * FROM poliklinik WHERE id_poli = $id ";
$getnama = mysqli_fetch_assoc(data($queryPoliklinik));

// Query untuk mendapatkan data pasien
$queryPasien = "SELECT * FROM pasien ORDER BY namapsn ASC ";
$dafpasien = data($queryPasien);

// Query untuk mendapatkan data dokter
$queryDokter = "SELECT * FROM dokter WHERE id_poli = $id ";
$datadkt = data($queryDokter);
$gettarif = mysqli_fetch_assoc(data($queryDokter));

if(isset($_POST['tambah'])){
    $poli = $_POST['poli'];
    $pasien = $_POST['pasien'];
    $dokter = $_POST['dokter'];
    $tarif = $_POST['tarif'];

    if( !empty($poli) && !empty($pasien) && !empty($dokter) && !empty($tarif)){
        $queryInsert = "INSERT INTO pendaftaran (dokter,pasien,poli,tarif)
                        VALUES ('$dokter','$pasien','$poli','$tarif') ";
        $daftar = data($queryInsert);
        if($daftar){
            header('Location: index.php');
        } else {
            echo "gagal";
        }
    }
}
?>

<?php headerku(); ?>
<div class="konten">
    <div class="mainop">
        <div class="k2 padding">
            <div class="form-abu border">
                <h2>Pendaftaran Poli <?= $getnama['poli'] ?></h2>
                <form action="" method="post">
                    <label for="">Nama Pasien</label>
                    <input type="hidden" value="<?= $getnama['poli'] ?>" name="poli"> 
                    <input type="hidden" value="<?= $gettarif['tarif'] ?>" name="tarif"> 
                    <select name="pasien" class="full">
                        <?php while($row = mysqli_fetch_assoc($dafpasien)){ ?>
                            <option value="<?= $row['namapsn'] ?>"><?= $row['namapsn'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="">Pilih Dokter</label>
                    <select name="dokter" class="full">
                        <?php while($row = mysqli_fetch_assoc($datadkt)){ ?>
                            <option value="<?= $row['namadkt'] ?>"><?= $row['namadkt'] ?></option>
                        <?php } ?>
                    </select>
                    <label for=""></label>
                    <input type="submit" value="Daftarkan Pasien" class="biru" name="tambah">
                </form>
            </div>
        </div>

        <div class="k2 padding">
            <table>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Dokter</td>
                        <td>Tarif</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 0;
                    mysqli_data_seek($datadkt, 0); // Kembali ke awal data dokter
                    while($row = mysqli_fetch_assoc($datadkt)){ 
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['namadkt'] ?></td>
                            <td>Rp <?= number_format($row['tarif']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php footerku(); ?>
