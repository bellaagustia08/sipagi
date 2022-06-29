<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Konsultasi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2><a style="color: black; text-decoration: underline;" type="button" onclick="goBack()">Data Konsultasi </a> / Detail</h2>
<?= $this->endSection() ?>

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
<?php if (!empty(session()->getFlashdata('warning'))) : ?>
    <div class="alert alert-warning" role="alert">
        <?php echo session()->getFlashdata('warning'); ?>
    </div>
<?php endif; ?>

<div class="card" id="cardDetailDataPasien">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h4>Data Pasien</h4>
    </div>
    <br>
    <h6>No. Tiket : <?php echo $konsultasi->no_tiket ?></h6>
    <table>
        <tbody>
            <tr>
                <td style="width: 100px;">Nama</td>
                <td style="width: 45px;" align="center">:</td>
                <td>
                    <?php echo $pasien->nama_pasien; ?>
                </td>
            </tr>
            <tr>
                <td>Username</td>
                <td style="width: 25px;" align="center">:</td>
                <td><?php echo $pasien->username_pasien ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td style="width: 25px;" align="center">:</td>
                <td><?php echo $pasien->alamat_pasien ?></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td style="width: 25px;" align="center">:</td>
                <td><?php echo $pasien->no_telp_pasien ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td style="width: 25px;" align="center">:</td>
                <td><?php echo $pasien->jenis_kelamin_pasien ?></td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td style="width: 25px;" align="center">:</td>
                <td><?php echo tgl_indo($pasien->tanggal_lahir_pasien) ?></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td style="width: 25px;" align="center">:</td>
                <td><?php echo $pasien->umur_pasien ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="card" id="cardDetailKonsultasi">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <h4>Detail Konsultasi</h4>
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


<?= $this->endSection() ?>