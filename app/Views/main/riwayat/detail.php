<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="color: black; text-decoration: underline;" type="button" onclick="goBack()">Riwayat</a></li>
            <li class="breadcrumb-item active">Detail Riwayat</li>
        </ol>
    </nav>
</h4>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="card" id="cardDetailRiwayat">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h4>Detail Riwayat</h4>
            <input type="text" value="<?php echo $konsultasi->no_tiket; ?>" id="copyText" readonly hidden>
            <button align="right" id="copyBtn" onclick="fungsiSalinNoTiket()"><span data-feather="copy"></span> No. Tiket : <?php echo $konsultasi->no_tiket; ?></button>
        </div>
        <br>


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

        <h6>Hasil Diagnosa : </h6>
        <img src="<?php echo $penyakit->gambar_penyakit ?>" alt="" id="imageHasilGambar" style="width:250px">
        <br>

        <h6>Anda menderita penyakit <?php echo $penyakit->nama_penyakit ?> dengan hasil hipotesis <?php echo round($konsultasi->cf_gabungan * 100, 2) ?>%</h6>
        <p style="font-size: 15px;"><?php echo $penyakit->definisi_penyakit ?></p>
        <br>

        <h6>Saran Penanganan : </h6>
        <p style="font-size: 15px;"><?php echo $penyakit->penanganan_penyakit ?></p>
        <br><br>
    </div>
</div>
<?= $this->endSection() ?>