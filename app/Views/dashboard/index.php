<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Beranda</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Beranda</h2>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="container">
    <center>
        <h1> Hallo <?php echo session()->get('nama_lengkap'); ?>, <br> Selamat Datang di SiPaGi </h1>
    </center>
    <hr>

    <?php
    if (session()->get('role') == "Admin") {
        $jumlah_user = count($allUser);
        $jumlah_pasien = count($pasien);
        $jumlah_dokter = count($dokter);
        $jumlah_jadwal = count($jadwal);
    ?>
        <center>
            <div class="row">
                <div class="col-md-3">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_user.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data User</h5>
                            <h1><?php echo $jumlah_user ?></h1>
                            <a href="<?= base_url(); ?>/user" class="btn btn-outline-info">Detail Data User</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_pasien.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data Pasien</h5>
                            <h1><?php echo $jumlah_pasien ?></h1>
                            <a href="<?= base_url(); ?>/pasien" class="btn btn-outline-info">Detail Data Pasien</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_dokter.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data Dokter</h5>
                            <h1><?php echo $jumlah_dokter ?></h1>
                            <a href="<?= base_url(); ?>/dokter" class="btn btn-outline-info">Detail Data Dokter</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_jadwal.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data Jadwal</h5>
                            <h1><?php echo $jumlah_jadwal ?></h1>
                            <a href="<?= base_url(); ?>/jadwal" class="btn btn-outline-info">Detail Data Jadwal</a>
                        </div>
                    </div>
                </div>
            </div>
        </center>
    <?php
    } else if (session()->get('role') == "Pakar") {
        $jumlah_gejala = count($gejala);
        $jumlah_penyakit = count($penyakit);
        $jumlah_aturan = count($aturan);
    ?>
        <center>
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_gejala.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data Gejala</h5>
                            <h1><?php echo $jumlah_gejala ?></h1>
                            <a href="<?= base_url(); ?>/gejala" class="btn btn-outline-info">Detail Data Gejala</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_penyakit.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data Penyakit</h5>
                            <h1><?php echo $jumlah_penyakit ?></h1>
                            <a href="<?= base_url(); ?>/penyakit" class="btn btn-outline-info">Detail Data Penyakit</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 20rem;">
                        <img src="<?php echo base_url('assets/assets/images/logo_aturan.png') ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Data Aturan</h5>
                            <h1><?php echo $jumlah_aturan ?></h1>
                            <a href="<?= base_url(); ?>/aturan" class="btn btn-outline-info">Detail Data Aturan</a>
                        </div>
                    </div>
                </div>
            </div>
        </center>

    <?php
    }

    ?>
    <hr>
</div>

<?= $this->endSection() ?>