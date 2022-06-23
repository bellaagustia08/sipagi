<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>Hasil Konsultasi Mandiri (<?php echo $_SESSION['no_tiket']; ?>)</title>
<?= $this->endSection() ?>


<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Hasil Konsultasi</li>
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
            <h4>Data Pasien</h4>
            <div class="row">
                <div class="col float-end">
                    <h6>No. Tiket Konsultasi : <?php echo $_SESSION['no_tiket']; ?></h6>
                </div>
            </div>
        </div>
        <br>


        <table>
            <tbody>
                <tr>
                    <td style="width: 150px;">Username Pasien</td>
                    <td style="width: 25px;">:</td>
                    <td> <?php echo $_SESSION['username_pasien']; ?> </td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td> <?php echo $pasien->nama_pasien; ?> </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td> <?php echo $pasien->alamat_pasien; ?> </td>
                </tr>
                <tr>
                    <td>No. Telepon</td>
                    <td>:</td>
                    <td> <?php echo $pasien->no_telp_pasien; ?> </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td> <?php echo $pasien->jenis_kelamin_pasien; ?> </td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td> <?php echo $pasien->tanggal_lahir_pasien; ?> </td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td> <?php echo $pasien->umur_pasien; ?> </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card" id="cardHasilKonsultasi_hasildiagnosa">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h4>Hasil Diagnosa</h4>
        </div>
        <br>
        <h6>Anda menderita penyakit <?php echo $penyakit->nama_penyakit ?> dengan hasil hipotesis <?php echo round($konsultasi[0]['cf_gabungan'] * 100, 2) ?>%</h6>
        <p style="font-size: 15px;"><?php echo $penyakit->definisi_penyakit ?></p>
        <br>

        <h6>Saran Penanganan : </h6>
        <p style="font-size: 15px;"><?php echo $penyakit->penanganan_penyakit ?></p>
        <br>

        <h6>Kemungkinan penyakit lainnya : </h6>
        <p style="font-size: 15px;">
            <?php
            $total = count($_SESSION['arrayCF_GabunganPerPenyakit']);
            $hit = 0;
            for ($i = 0; $i < $total; $i++) {
                if (
                    $i != 0
                    && $_SESSION['arrayCF_GabunganPerPenyakit'][$i]['cf_gabungan'] != 0
                ) {
                    $hit = $hit + 1;
                    foreach ($penyakitAll as $rowpenyakit) {
                        if ($_SESSION['arrayCF_GabunganPerPenyakit'][$i]['id_penyakit'] == $rowpenyakit->id_penyakit) {
                            echo $hit . '. ' . $rowpenyakit->nama_penyakit . ', Hasil hipotesis : ' . round($_SESSION['arrayCF_GabunganPerPenyakit'][$i]['cf_gabungan'] * 100, 2) . '%';
                        }
                    }
                    echo "<br>";
                }
            }
            ?>
        </p>
        <br><br>
    </div>

</div>

<script>
    window.print();
</script>

<?= $this->endSection() ?>