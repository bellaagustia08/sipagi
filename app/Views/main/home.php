<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>Selamat Data di SiPaGi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Beranda</li>
        </ol>
    </nav>
</h4>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container">
    <center>
        <h1> Selamat Datang di SiPaGi </h1>
        <br>
        <h2 class="entry-title">
            SiPaGi hadir untuk mempermudah anda dalam melakukan konsultasi mandiri <br>
            dan membuat janji temu tanpa harus datang ke klinik.
        </h2>
        <br>
    </center>
    <hr>

    <h4>Cara penggunaan menu pada website SiPaGi : </h4>

    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo base_url('assets/assets/images/logo_konsultasi.png') ?>" style="height: 15rem ;" class="card-img-top">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Pengajuan Konsultasi</h5>
                    </center>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Jika sudah pernah menjadi pasien <br> - Masukan username <br> - Isi form gejala</li>
                    <li class="list-group-item">2. Jika belum pernah menjadi pasien <br> - Masukan " - " <br> - Isi form data diri <br> - Isi form gejala</li>
                    <li class="list-group-item">3. Tekan tombol "Proses Data Konsultasi", maka sistem akan menampilkan hasil diagnosa Anda.</li>
                    <li class="list-group-item">4. Untuk mengunduh hasil diagnosa, tekan tombol "Unduh Hasil".</li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url('assets/assets/images/logo_riwayat.png') ?>" class="card-img-top">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Riwayat Konsultasi</h5>
                    </center>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Riwayat konsultasi hanya dapat digunakan bagi Anda yang sudah pernah menjadi pasien di klinik ini.</li>
                    <li class="list-group-item">2. Masukan username untuk menampilkan daftar riwayat konsultasi.</li>
                    <li class="list-group-item">3. Tekan tombol "Cari", maka sistem akan menampilkan seluruh daftar riwayat konsultasi Anda.</li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url('assets/assets/images/logo_download.png') ?>" class="card-img-top">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Download</h5>
                    </center>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Download hanya dapat digunakan bagi Anda yang sudah pernah melakukan konsultasi mandiri di klinik ini.</li>
                    <li class="list-group-item">2. Masukan nomor tiket konsultasi.</li>
                    <li class="list-group-item">3. Tekan tombol "Cari", maka sistem akan menampilkan hasil konsultasi Anda.</li>
                    <li class="list-group-item">4. Untuk mengunduh hasil konsultasi, tekan tombol "Unduh Hasil".</li>
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <img src="<?php echo base_url('assets/assets/images/logo_janjitemu.png') ?>" class="card-img-top">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Janji Temu</h5>
                    </center>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">1. Pilih atau cari nama dokter yang anda ingin buat janji temu.</li>
                    <li class="list-group-item">2. Pilih jadwal yang tersedia.</li>
                    <li class="list-group-item">3. Isi form data diri.</li>
                    <li class="list-group-item">4. Tekan tombol "Kirim Permintaan Janji Temu", maka sistem akan menampilkan hasil janji temu anda.</li>
                    <li class="list-group-item">5. Untuk mengunduh hasil janji temu, tekan tombol "Unduh Hasil".</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>