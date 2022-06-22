<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Download</li>
        </ol>
    </nav>
</h4>
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

<div class="container">
    <div class="card" id="cardPerhatian">
        <h6>Perhatian!</h6>
        Pastikan Anda Sudah Melakukan Konsultasi Mandiri !
    </div>
    <br>

    <h2> Download Hasil Konsultasi</h2>
    <br>
    <form method="get" action="<?= base_url(); ?>/download">
        <div class="row">
            <div class="col">
                <?php
                $no_tiket = "";
                if (isset($_GET['no_tiket'])) {
                    $no_tiket = $_GET['no_tiket'];
                }
                ?>
                <div class="form-group">
                    <input class="form-control" type="text" name="no_tiket" placeholder="No.Tiket Konsultasi..." required autofocus value="<?php echo $no_tiket; ?>">
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-circle" id="buttonCariTiket">
                    <center><span data-feather="search"></span> Cari</center>
                </button>
            </div>
        </div>
    </form>
    <br>

    <?php
    include "koneksi.php";

    if (isset($_GET['no_tiket'])) {
        $no_tiket = $_GET['no_tiket'];
        $sql = "SELECT * FROM konsultasi WHERE no_tiket LIKE '$no_tiket' ";
    } else {
        $sql = null;
    }
    // dd($sql);

    if ($sql == null) {
    ?>

        <?php
    } else {
        $hasil = mysqli_query($kon, $sql);
        $data = mysqli_fetch_array($hasil);

        // dd($data);
        if ($data == null) {
        ?>
            <h6>Data Tidak Ditemukan</h6>
        <?php
        } else {
            $id_konsultasi = $data['id_konsultasi'];
            $sql_gejalayangdialami = "SELECT * FROM detail_konsultasi WHERE id_konsultasi = '$id_konsultasi' ";
            $hasil_gejalayangdialami = mysqli_query($kon, $sql_gejalayangdialami);
        ?>
            <a class="nav-item nav-link" href="<?= base_url(); ?>/download/cetakHasilDownload/<?php echo $no_tiket ?>" id="buttonDownloadHasil">
                <span data-feather="printer"></span> Unduh Hasil
            </a>
            <br><br><br>

            <div class="card" id="cardHasilKonsultasi_datapasien">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                    <h4>Data Pasien</h4>
                    <h6 align="right">No. Tiket Konsultasi : <?php echo $data['no_tiket']; ?></h6>
                </div>
                <br>
                <table>
                    <tbody>
                        <?php
                        foreach ($pasien as $rowpasien) {
                            if ($data['id_pasien'] == $rowpasien->id_pasien) {
                        ?>
                                <tr>
                                    <td style="width: 8%;">Nama</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td>
                                        <?php echo $rowpasien->nama_pasien; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Username</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td><?php echo $rowpasien->username_pasien ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Alamat</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td><?php echo $rowpasien->alamat_pasien ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">No. Telepon</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td><?php echo $rowpasien->no_telp_pasien ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Jenis Kelamin</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td><?php echo $rowpasien->jenis_kelamin_pasien ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Tanggal Lahir</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td><?php echo tgl_indo($rowpasien->tanggal_lahir_pasien) ?></td>
                                </tr>
                                <tr>
                                    <td style="width: 8%;">Umur</td>
                                    <td style="width: 4%;" align="center">:</td>
                                    <td><?php echo $rowpasien->umur_pasien ?></td>
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
                while ($data_gejalayangdialami = mysqli_fetch_array($hasil_gejalayangdialami)) {
                    foreach ($gejala as $rowgejala) {
                        if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.2) {
                            echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Tidak Tahu ]';
                            echo '<br>';
                        } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.4) {
                            echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Sedikit Yakin ]';
                            echo '<br>';
                        } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.6) {
                            echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Cukup Yakin ]';
                            echo '<br>';
                        } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.8) {
                            echo $rowgejala->nama_gejala . ' [ Tingkat Keyakinan : Yakin ]';
                            echo '<br>';
                        } else if ($data_gejalayangdialami['id_gejala'] == $rowgejala->id_gejala && $data_gejalayangdialami['cf_user'] == 0.1) {
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
                <?php
                foreach ($penyakit as $rowpenyakit) {
                    if ($data['id_penyakit'] == $rowpenyakit->id_penyakit) {
                ?>
                        <!-- <img src="<?php echo $rowpenyakit->gambar_penyakit ?>" alt="" id="imageHasilGambar" style="width:250px">
                        <br> -->

                        <h6>Anda menderita penyakit <?php echo $rowpenyakit->nama_penyakit ?> dengan hasil hipotesis <?php echo round($data['cf_gabungan'] * 100, 2) ?>%</h6>
                        <p style="font-size: 15px;"><?php echo $rowpenyakit->definisi_penyakit ?></p>
                        <br>

                        <h6>Saran Penanganan : </h6>
                        <p style="font-size: 15px;"><?php echo $rowpenyakit->penanganan_penyakit ?></p>
                        <br>
                <?php
                    }
                }

                ?>
            </div>
        <?php
        }
        ?>

    <?php
    }
    ?>
</div>

<?= $this->endSection() ?>