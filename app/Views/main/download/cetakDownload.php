<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>Hasil Konsultasi Mandiri</title>
<?= $this->endSection() ?>


<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Hasil Konsultasi Mandiri</li>
        </ol>
    </nav>
</h4>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<script>
    <?php
    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }
    ?>
</script>

<div class="container">
    <div class="card" id="cardHasilKonsultasi_datapasien">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h4>Data Diri Pasien</h4>
        </div>
        <br>
        <?php

        ?>
        <h6>No. Tiket Konsultasi : <?php echo $konsultasi->no_tiket; ?></h6>
        <table>
            <tbody>
                <?php
                foreach ($pasien as $rowpasien) {
                    if ($konsultasi->id_pasien == $rowpasien->id_pasien) {
                ?>
                        <tr>
                            <td style="width: 16%;">Nama</td>
                            <td style="width: 3%;">:</td>
                            <td>
                                <?php
                                echo $rowpasien->nama_pasien;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td>
                                <?php
                                echo $rowpasien->username_pasien;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                <?php
                                echo $rowpasien->alamat_pasien;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>No. Telepon</td>
                            <td>:</td>
                            <td>
                                <?php
                                echo $rowpasien->no_telp_pasien;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                <?php
                                echo $rowpasien->jenis_kelamin_pasien;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td>
                                <?php
                                echo tgl_indo($rowpasien->tanggal_lahir_pasien);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>
                                <?php
                                echo $rowpasien->umur_pasien;
                                ?>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="card" id="cardHasilKonsultasi_hasildiagnosa">
        <h4>Gejala yang Dialami : </h4>
        <?php
        include "koneksi.php";

        $id_konsultasi = $konsultasi->id_konsultasi;
        $sql_gejalayangdialami = "SELECT * FROM detail_konsultasi WHERE id_konsultasi = '$id_konsultasi' ";
        $hasil_gejalayangdialami = mysqli_query($kon, $sql_gejalayangdialami);

        while ($data_gejalayangdialami = mysqli_fetch_array($hasil_gejalayangdialami)) {
            foreach ($gejala as $rowgejala) {
                if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.2) {
                    echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Tidak Tahu ]'; echo '<br>';
                } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.4) {
                    echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Sedikit Yakin ]'; echo '<br>';
                } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.6) {
                    echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Cukup Yakin ]'; echo '<br>';
                } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.8) {
                    echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Yakin ]'; echo '<br>';
                } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.1) {
                    echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Sangat Yakin ]'; echo '<br>';
                }
            }
        }
        ?>
        <br>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h4>Hasil Diagnosa</h4>
        </div>
        <br>
        <?php
        foreach ($penyakit as $rowpenyakit) {
            if ($konsultasi->id_penyakit == $rowpenyakit->id_penyakit) {
        ?>
                <h6>Anda menderita penyakit <?php echo $rowpenyakit->nama_penyakit ?> dengan hasil hipotesis <?php echo round($konsultasi->cf_gabungan * 100, 2) ?>%</h6>
                <p style="font-size: 15px;"><?php echo $rowpenyakit->definisi_penyakit ?></p>
                <br>

                <h6>Saran Penanganan : </h6>
                <p style="font-size: 15px;"><?php echo $rowpenyakit->penanganan_penyakit ?></p>
                <br>
                <br>
        <?php
            }
        }
        ?>
    </div>

</div>

<script>
    window.print();
</script>

<?= $this->endSection() ?>