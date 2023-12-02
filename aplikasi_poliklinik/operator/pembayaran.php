<!-- Bagian HTML sebelum pemisahan -->
<script src="hitung_obat.js"></script>

<?php
require_once 'view/view.php';
require_once '../Control.php';


if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
}

// Fungsi untuk mendapatkan data pasien berdasarkan nama
function getDataPasien($nama_pasien)
{
    global $link;
    $query = "SELECT * FROM pendaftaran WHERE pasien = '$nama_pasien'";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}

// Fungsi untuk mendapatkan data obat berdasarkan nama obat
//function getDataObat($nama_obat)
//{
//    global $link;
//    $query = "SELECT * FROM obat WHERE nama_obat = '$nama_obat'";
//    $result = mysqli_query($link, $query);
 //   return mysqli_fetch_assoc($result);
//}

// Fungsi untuk mendapatkan total harga obat berdasarkan nama obat
function getTotalHargaObat($selected_obat)
{
    global $link;
    $total_harga_obat = 0;

    foreach ($selected_obat as $obat) {
        $query_harga_obat = "SELECT harga_obat FROM obat WHERE nama_obat = '$obat'";
        $result_harga_obat = mysqli_query($link, $query_harga_obat);
        $row_harga_obat = mysqli_fetch_assoc($result_harga_obat);
        $total_harga_obat += $row_harga_obat['harga_obat'];
    }

    return $total_harga_obat;
}

// Fungsi untuk mendapatkan data Pembayaran berdasarkan id pembayaran
function getDataPembayaran($bayar_pasien)
{
    global $link;
    $query = "SELECT * FROM pembayaran WHERE nama_pasien = '$bayar_pasien'";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}
?>

<?php headerku(); ?>
<div class="konten">
    <div class="mainop">
        <div class="k2 padding">
            <div class="form-abu border">
                <h2>Pembayaran Poli</h2>
                <!-- Form untuk pencarian nama pasien -->
                <form action="" method="get">
                    <label for="search_pasien">Cari Nama Pasien:</label>
                    <input type="text" name="search_pasien" id="search_pasien" class="f50" placeholder="Masukkan Nama Pasien">
                    <input type="submit" value="Cari" class="biru" name="search_pasien_submit">
                </form>

                <?php
if (isset($_GET['search_pasien_submit'])) {
    $nama_pasien = mysqli_real_escape_string($link, $_GET['search_pasien']);
    $data_pasien = getDataPasien($nama_pasien);

    if ($data_pasien) {
        $tanggal_pendaftaran = $data_pasien['tanggal_daftar'];
        $nama = $data_pasien['pasien'];
        $jenis_poli = $data_pasien['poli'];
        $nama_dokter = $data_pasien['dokter'];
        $tarif_dokter = $data_pasien['tarif'];

        echo "<form action='' method='post'>";
        echo "<input type='hidden' name='nama_pasien' value='$nama_pasien'>";
        echo "<input type='hidden' name='tanggal_pembayaran' value='" . date('Y-m-d H:i:s') . "'>";

        // Formulir untuk memilih obat
        echo "<label for='obat'>Pilih Obat:</label>";
        echo "<select name='obat[]' multiple class='f50' id='obatSelect' onchange='obatDipilih()'>";
        // Ambil daftar obat dari tabel obat
        $query_obat = "SELECT * FROM obat";
        $result_obat = mysqli_query($link, $query_obat);
        while ($row_obat = mysqli_fetch_assoc($result_obat)) {
            echo "<option value='{$row_obat['nama_obat']}' data-harga='{$row_obat['harga_obat']}'>{$row_obat['nama_obat']} - Rp {$row_obat['harga_obat']}</option>";
        }
        echo "</select>";

        // Elemen untuk menampilkan total pembayaran
        echo "<label for='total_pembayaran'>Total Pembayaran:</label>";
        echo "<input type='text' value='total_pembayaran' name='total_pembayaran' id='total_pembayaran' class='f50' readonly>";


        // Tombol bayar
        echo "<input type='submit' value='Bayar' class='biru' name='bayar_submit'>";
        echo "</form>";

        // Script JavaScript untuk menghitung total tagihan obat dan menampilkan nama obat yang dipilih
        

    } else {
        echo "<p>Pasien tidak ditemukan.</p>";
    }
}
?>
<!-- Tambahkan script JavaScript -->
<script>
    // Fungsi untuk menghitung total pembayaran
    function hitungTotalPembayaran() {
        // Ambil nilai tarif dokter dari PHP
        var tarifDokter = <?php echo $tarif_dokter; ?>;
        
        // Ambil nilai total tagihan obat dari elemen HTML
        var totalTagihanObat = parseInt(document.getElementById('total_tagihan_obat').textContent);

        // Hitung total pembayaran
        var totalPembayaran = tarifDokter + totalTagihanObat;

        // Tampilkan total pembayaran pada elemen HTML
        document.getElementById('total_pembayaran').value = totalPembayaran.toFixed(2);
    }
    // Fungsi untuk dipanggil saat obat dipilih
    function obatDipilih() {
        // Panggil fungsi hitungTotalPembayaran
        hitungTotalPembayaran();
    }

    // Panggil fungsi hitungTotalPembayaran saat halaman dimuat
    window.onload = hitungTotalPembayaran;
</script>



            </div>
        </div>
        <?php
if (isset($_POST['bayar_submit'])) {
    // Hitung total harga obat
    $selected_obat = isset($_POST['obat']) ? $_POST['obat'] : array();
    $total_harga_obat = getTotalHargaObat($selected_obat);

    // Hitung total tagihan (tarif dokter + total harga obat)
    $total_tagihan = $tarif_dokter + $total_harga_obat;

    // Ambil data pembayaran dari database
    $data_pembayaran = getDataPembayaran($nama_pasien);
    // Perbarui atau tambahkan informasi pembayaran ke dalam tabel pembayaran
    if ($data_pembayaran) {
        $update_query = "UPDATE pembayaran SET jenis_poli = '$jenis_poli', tagihan_obat = $total_harga_obat, tarif_dokter = $tarif_dokter, total_pembayaran = $total_tagihan WHERE nama_pasien = '$nama_pasien'";
        mysqli_query($link, $update_query);
    } else {
        // id_pembayaran akan diisi otomatis karena kolom tersebut auto-increment
        $insert_query = "INSERT INTO pembayaran (nama_pasien, jenis_poli, tagihan_obat, tarif_dokter, total_pembayaran, tanggal_pembayaran) VALUES ('$nama_pasien', '$jenis_poli', $total_harga_obat, $tarif_dokter, $total_tagihan, NOW())";
        mysqli_query($link, $insert_query);
    }
}
?>

    <div class="k2 padding">
    <?php
    // Cek apakah pasien ditemukan
    if (isset($data_pasien) && $data_pasien) {
        // Tampilkan informasi pasien
        echo "<table>";
        echo "<tr><td>Tanggal Pendaftaran:</td><td>$tanggal_pendaftaran</td></tr>";
        echo "<tr><td>Nama Pasien:</td><td>$nama_pasien</td></tr>";
        echo "<tr><td>Jenis Poli:</td><td>$jenis_poli</td></tr>";
        echo "<tr><td>Nama Dokter:</td><td>$nama_dokter</td></tr>";
        echo "<tr><td>Tarif Dokter:</td><td>$tarif_dokter</td></tr>";
                // Tabel untuk menampilkan obat yang dipilih
                echo "<table id='tabelObat'>";
                echo "</br><thead><tr><th>Nama Obat</th></tr></thead>";
                echo "<tbody></tbody>";
                echo "</table>";
        
                // Elemen untuk menampilkan total tagihan obat
                echo "<label for='total_tagihan_obat'>Total Tagihan Obat:</label>";
                echo "<span id='total_tagihan_obat'>0</span>";

        echo "</table>";
    } else {
        // Tampilkan pemberitahuan jika pasien tidak ditemukan
        echo "<p>Pasien tidak ditemukan.</p>";
    }

    echo "</br>";
    // Tampilkan pesan sukses atau gagal kepada pengguna
    if (isset($_POST['bayar_submit'])){
        if (mysqli_affected_rows($link) > 0) {
            echo "Pembayaran berhasil ditambahkan atau diperbarui.";
        } else {
            echo "Gagal menambahkan atau memperbarui pembayaran.";
        }
    }
    
    ?>
</div>



    </div>
</div>
<?php footerku(); ?>
