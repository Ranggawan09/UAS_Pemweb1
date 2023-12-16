<?php
require 'view/view.php';
require '../Control.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../index.php');
}

function getDataPasien($nama_pasien)
{
    global $link;
    $query = "SELECT * FROM pendaftaran WHERE pasien = '$nama_pasien'";
    $result = mysqli_query($link, $query);
    return mysqli_fetch_assoc($result);
}

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

headerku();

?>

<div class="konten">
    <div class="mainop">
        <div class="k2 padding">
            <div class="form-abu border">
                <h2>Pembayaran Poli</h2>

                <!-- Form untuk pencarian nama pasien -->
                <form action="" method="get">
                    <label for="search_pasien">Cari Nama Pasien:</label>
                    <input
                        type="text"
                        name="search_pasien"
                        id="search_pasien"
                        class="f50"
                        placeholder="Masukkan Nama Pasien">
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
                        $tarif_dokter = (int)$data_pasien['tarif']; // cast to integer
                        ?>

                <form action='' method='post'>
                    <input type='hidden' name='nama_pasien' value='<?php echo $nama_pasien; ?>'>
                    <input
                        type='hidden'
                        name='tanggal_pembayaran'
                        value='<?php echo date('Y-m-d H:i:s'); ?>'>

                    <!-- Formulir untuk memilih obat -->
                    <label for='obat'>Pilih Obat:</label>
                    <select
                        name='obat[]'
                        multiple="multiple"
                        class='f50'
                        id='obatSelect'
                        onchange='checkboxObat()'>
                        <!-- Ambil daftar obat dari tabel obat -->
                        <?php
                                $query_obat = "SELECT * FROM obat";
                                $result_obat = mysqli_query($link, $query_obat);
                                while ($row_obat = mysqli_fetch_assoc($result_obat)) {
                                    echo "<option value='{$row_obat['nama_obat']}' data-harga='{$row_obat['harga_obat']}'>{$row_obat['nama_obat']} - Rp {$row_obat['harga_obat']}</option>";
                                }
                                ?>
                    </select>

                    <!-- Elemen untuk menampilkan total pembayaran -->
                    <label for='total_pembayaran'>Total Pembayaran:</label>
                    <input
                        type='text'
                        name='total_pembayaran'
                        id='total_pembayaran'
                        class='f50'
                        readonly="readonly">

                    <!-- Tombol bayar -->
                    <input type='submit' value='Bayar' class='biru' name='bayar_submit'>
                </form>

                <!-- Script JavaScript untuk menghitung total tagihan obat dan menampilkan nama
                obat yang dipilih -->
                <script>
                    function checkboxObat() {
                var totalHargaObat = 0;
                var obatSelect = document.getElementById("obatSelect");
                var selectedObat = obatSelect.selectedOptions;

                // Tampilkan nama obat yang dipilih dalam tabel
                var tbody = document.getElementById("tbody");
                tbody.innerHTML = "";
                for (var i = 0; i < selectedObat.length; i++) {
                    var obatName = selectedObat[i].value;
                    var row = "<tr><td>" + obatName + "</td></tr>";
                    tbody.innerHTML += row;

                    totalHargaObat += parseFloat(selectedObat[i].getAttribute("data-harga"));
                }

                // Update total tagihan obat
                var totalTagihanObat = totalHargaObat.toFixed(2);
                document.getElementById("total_tagihan_obat").textContent = totalTagihanObat;
                
                // Update total pembayaran
                document.getElementById("total_pembayaran").value = (totalHargaObat + <?php echo $tarif_dokter; ?>).toFixed(2);
            }            
                </script>

            <?php
                    } else {
                        echo "<p>Pasien tidak ditemukan.</p>";
                    }
                }
                ?>
            </div>
        </div>

    <?php
        if (isset($_POST['bayar_submit'])) {
            $selected_obat = isset($_POST['obat']) ? $_POST['obat'] : array();
            $total_harga_obat = getTotalHargaObat($selected_obat);
            $total_tagihan = $tarif_dokter + $total_harga_obat;

            if ($nama_pasien) {
                $insert_query = "INSERT INTO pembayaran (nama_pasien, jenis_poli, tagihan_obat, tarif_dokter, total_pembayaran, tanggal_pembayaran) VALUES ('$nama_pasien', '$jenis_poli', $total_harga_obat, $tarif_dokter, $total_tagihan, NOW())";
                mysqli_query($link, $insert_query);

                // Hapus data pasien dari tabel pendaftaran
                $delete_query = "DELETE FROM pendaftaran WHERE pasien = '$nama_pasien'";
                mysqli_query($link, $delete_query);

                // Kurangi stok obat
        foreach ($selected_obat as $obat) {
            $update_stok_query = "UPDATE obat SET stok = stok - 1 WHERE nama_obat = '$obat'";
            mysqli_query($link, $update_stok_query);
            }
        }
    }
        ?>

        <div class="k2 padding">
            <?php
if (isset($data_pasien) && $data_pasien) {
    ?>
            <table>
                <tr>
                    <td>Tanggal Pendaftaran:</td>
                    <td><?php echo $tanggal_pendaftaran; ?></td>
                </tr>
                <tr>
                    <td>Nama Pasien:</td>
                    <td><?php echo $nama_pasien; ?></td>
                </tr>
                <tr>
                    <td>Jenis Poli:</td>
                    <td><?php echo $jenis_poli; ?></td>
                </tr>
                <tr>
                    <td>Nama Dokter:</td>
                    <td><?php echo $nama_dokter; ?></td>
                </tr>
                <tr>
                    <td>Tarif Dokter:</td>
                    <td><?php echo $tarif_dokter; ?></td>
                </tr>

                <!-- Tabel untuk menampilkan obat yang dipilih -->
                <table id='tabelObat'>
                    </br>
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                        </tr>
                    </thead>
                    <tbody id='tbody'></tbody>
                </table>

                <!-- Elemen untuk menampilkan total tagihan obat -->
                <label for='total_tagihan_obat'>Total Tagihan Obat:</label>
                <span id='total_tagihan_obat' name='total_tagihan_obat'>0</span>
            </table>
        <?php
} else {
    echo "<p>Pasien tidak ditemukan.</p>";
}
echo "</br>";

if (isset($_POST['bayar_submit'])) {
    if (mysqli_affected_rows($link) > 0) {
        echo "Pembayaran berhasil dilakukan.";
    } else {
        echo "Gagal melakukan pembayaran.";
    }
}
?>

        </div>
    </div>
</div>

<?php
footerku();
?>
