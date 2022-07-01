<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>


<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Hasil Janji Temu</li>
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
    <a class="nav-item nav-link" href="<?= base_url(); ?>/janjitemu/hasilJanjiTemu/cetakHasil" id="buttonCetakHasilKonsultasi">
        <span data-feather="printer"></span> Unduh Hasil
    </a>
    <br><br><br>

    <div class="card" id="cardHasilKonsultasi_datapasien">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h4>Data Pasien</h4>
        </div>
        <br>
        <table>
            <tbody>
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
        <br><br>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h4>Janji Temu</h4>
        </div>
        <br>
        <p>
            Janji Temu anda dengan dokter
            <?php echo $dokter->nama_dokter; ?> 
            pada tanggal
            <?php echo tgl_indo($jadwal[0]['tanggal_jadwal']); ?>
            pukul
            <?php
            $t = strtotime($jadwal[0]['waktu_jadwal']);
            echo date("H:i", $t);
            ?>
        </p>
    </div>
    <br>
</div>

<?= $this->endSection() ?>