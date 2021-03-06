<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>


<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item"><a style="color: black; text-decoration: underline;" type="button" onclick="goBack()">Konsultasi</a></li> -->
            <li class="breadcrumb-item active" aria-current="page">Hasil Konsultasi</li>
        </ol>
    </nav>
</h4>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (!empty(session()->getFlashdata('deleted'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session()->getFlashdata('deleted'); ?>
    </div>
<?php endif; ?>

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

    <?php
    if ($konsultasi[0]['cf_gabungan'] == 0) {
    ?>
        <br>
        <center>
            <h4>Hasil Diagnosa Tidak Ditemukan</h4>
        </center>
    <?php
    } else {
    ?>
        <div class="card" id="cardPerhatian">
            <h6>Perhatian!</h6>
            Simpan Nama Unik Anda Untuk Konsultasi Lainnya !<br>
            Simpan No. Tiket Konsultasi Anda Untuk Mencetak Ulang Di Halaman Download !
        </div>
        <br>

        <a class="nav-item nav-link" href="<?= base_url(); ?>/pengajuan/hasilKonsultasi/cetakHasil" id="buttonCetakHasilKonsultasi">
            <span data-feather="printer"></span> Unduh Hasil
        </a>
        <br><br><br>

        <div class="card" id="cardHasilKonsultasi_datapasien">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <h4>Data Pasien</h4>
                <div class="row">
                    <div class="col float-end">
                        <div class="input-group mb-3">
                            <b>No. Tiket Konsultasi : <?php echo $_SESSION['no_tiket']; ?></b> &nbsp;
                            <!-- <input id="copyText" type="text" value="<?php echo $_SESSION['no_tiket']; ?>" readonly style="width:100px; text-align:center;">
                            <button id="copyBtn" onclick="fungsiSalinNoTiket()"><span data-feather="copy"></span> Salin </button> -->
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <table>
                <tbody>
                    <tr>
                        <td style="width: 105px;">Nama Unik</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo $pasien->username_pasien ?></td>
                    </tr>
                    <tr>
                        <td style="width: 105px;">Nama Lengkap</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo $pasien->nama_pasien; ?></td>
                    </tr>
                    <tr>
                        <td style="width: 105px;">Alamat</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo $pasien->alamat_pasien ?></td>
                    </tr>
                    <tr>
                        <td style="width: 105px;">No. Telepon</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo $pasien->no_telp_pasien ?></td>
                    </tr>
                    <tr>
                        <td style="width: 105px;">Jenis Kelamin</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo $pasien->jenis_kelamin_pasien ?></td>
                    </tr>
                    <tr>
                        <td style="width: 105px;">Tanggal Lahir</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo tgl_indo($pasien->tanggal_lahir_pasien) ?></td>
                    </tr>
                    <tr>
                        <td style="width: 105px;">Umur</td>
                        <td style="width: 25px;" align="center">:</td>
                        <td><?php echo $pasien->umur_pasien ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>

        <div class="card" id="cardHasilKonsultasi_hasildiagnosa">
            <h6>Gejala yang Dialami : </h6>
            <?php
            foreach ($detail_konsultasi as $row) {
                $hitung = 0;
                foreach ($gejala as $rowgejala) {
                    if ($row['id_gejala'] == $rowgejala->id_gejala && $row['cf_user'] == 0.2) {
                        echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Tidak Tahu ]';
                        echo '<br>';
                    } else if ($row['id_gejala'] == $rowgejala->id_gejala && $row['cf_user'] == 0.4) {
                        echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Sedikit Yakin ]';
                        echo '<br>';
                    } else if ($row['id_gejala'] == $rowgejala->id_gejala && $row['cf_user'] == 0.6) {
                        echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Cukup Yakin ]';
                        echo '<br>';
                    } else if ($row['id_gejala'] == $rowgejala->id_gejala && $row['cf_user'] == 0.8) {
                        echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Yakin ]';
                        echo '<br>';
                    } else if ($row['id_gejala'] == $rowgejala->id_gejala && $row['cf_user'] == 0.1) {
                        echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Sangat Yakin ]';
                        echo '<br>';
                    }
                }
            }
            ?>
            <br>
            
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <h4>Hasil Diagnosa</h4>
            </div>
            <br>

            <img src="<?php echo $penyakit->gambar_penyakit ?>" alt="" id="imageHasilGambar" style="width:250px">
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
                        foreach ($penyakitAll as $penyakit) {
                            if ($_SESSION['arrayCF_GabunganPerPenyakit'][$i]['id_penyakit'] == $penyakit->id_penyakit) {
                                echo $hit . '. ' . $penyakit->nama_penyakit . ', Hasil hipotesis : ' . round($_SESSION['arrayCF_GabunganPerPenyakit'][$i]['cf_gabungan'] * 100, 2) . '%';
                            }
                        }
                        echo "<br>";
                    }
                }
                ?>
            </p>
            <br><br>
        </div>
    <?php
    }
    ?>

</div>


<?= $this->endSection() ?>