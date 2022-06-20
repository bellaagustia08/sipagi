<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Riwayat</li>
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
        Pastikan Anda Sudah Pernah Mendaftar Menjadi Pasien !
    </div>
    <br>


    <h2> Lihat Riwayat Konsultasi </h2>
    <br>
    <form method="get" action="<?= base_url(); ?>/riwayat">
        <div class="row">
            <div class="col">
                <?php
                $username_pasien = "";
                if (isset($_GET['username_pasien'])) {
                    $username_pasien = $_GET['username_pasien'];
                }
                ?>
                <div class="form-group">
                    <input class="form-control" type="text" id="username_pasien" name="username_pasien" placeholder="Masukan Username Anda..." required autofocus value="<?php echo $username_pasien ?>">
                </div>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-circle" id="buttonCariRiwayat">
                    <center><span data-feather="search"></span> Cari</center>
                </button>
            </div>
        </div>
    </form>
    <br><br>

    <?php
    include "koneksi.php";

    if (isset($_GET['username_pasien'])) {
        $username_pasien = $_GET['username_pasien'];
        $temp_sql = "SELECT * FROM pasien WHERE username_pasien = '$username_pasien'";
        $temp_sql_getpasien = mysqli_query($kon, $temp_sql);
        $tempData_sql_getpasien = mysqli_fetch_array($temp_sql_getpasien);

        if ($tempData_sql_getpasien != null) {
            // get id pasien 
            $temp_id_pasien = $tempData_sql_getpasien['id_pasien'];
            // get all id konsultasi where id pasien
            $sql = "SELECT * FROM konsultasi WHERE id_pasien = '$temp_id_pasien' ORDER BY id_konsultasi DESC";
        } else {
            $sql = null;
    ?>
            <center>
                <h4>Username Tidak Ditemukan</h4>
            </center>
        <?php
        }
    } else {
        $sql = null;
    }
    // dd($sql);

    if ($sql == null) {
        ?>
        <!-- tidak ada yang di cari -->
        <?php
    } else {
        $hasil = mysqli_query($kon, $sql);
        $tempData = mysqli_fetch_array($hasil);
        // dd($tempData);

        if ($tempData == null) {
        ?>
            <center>
                <h4>Daftar Riwayat Konsultasi Tidak Ditemukan</h4>
            </center>
        <?php
        } else {
        ?>
            <div class="card" id="cardHasilKonsultasi_datapasien">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                    <h4>Data Pasien</h4>
                </div>
                <br>
                <table>
                    <tbody>
                        <?php
                        foreach ($pasien as $rowpasien) {
                            if ($tempData['id_pasien'] == $rowpasien->id_pasien) {
                        ?>
                                <tr>
                                    <td style="width: 9%;">Nama</td>
                                    <td style="width: 2%;">:</td>
                                    <td>
                                        <?php
                                        echo $rowpasien->nama_pasien;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?php echo $rowpasien->username_pasien ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?php echo $rowpasien->alamat_pasien ?></td>
                                </tr>
                                <tr>
                                    <td>No. Telepon</td>
                                    <td>:</td>
                                    <td><?php echo $rowpasien->no_telp_pasien ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?php echo $rowpasien->jenis_kelamin_pasien ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?php echo tgl_indo($rowpasien->tanggal_lahir_pasien) ?></td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>:</td>
                                    <td><?php echo $rowpasien->umur_pasien ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <center>
                <h4>Daftar Riwayat Konsultasi</h4>
            </center>

            <div class="card" id="cardHasilKonsultasi_datapasien">
                <table id="table-datatables" class="table table-hover row-border">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Waktu</th>
                            <th>No. Tiket</th>
                            <th>Nama Penyakit</th>
                            <th>Hasil Hipotesis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $hasil = mysqli_query($kon, $sql);
                        $hitung = 0;
                        while ($data = mysqli_fetch_array($hasil)) {
                            $hitung = $hitung + 1;
                        ?>
                            <tr>
                                <td style="width:fit-content;" align="center"><?php echo $hitung ?></td>
                                <td style="width:fit-content;" align="center"><?php echo $data['waktu']; ?></td>
                                <td style="width:fit-content;" align="center"><?php echo $data['no_tiket']; ?></td>
                                <td style="width:fit-content;" align="center">
                                    <?php
                                    foreach ($penyakit as $rowpenyakit) {
                                        if ($data['id_penyakit'] == $rowpenyakit->id_penyakit) {
                                            echo $rowpenyakit->nama_penyakit;
                                        }
                                    }
                                    ?>
                                </td>
                                <td style="width:fit-content;" align="center"><?php echo round($data['cf_gabungan'] * 100, 2) ?>%</td>
                                <td style="width:fit-content;" align="center">
                                    <a class="btn btn-sm btn-primary" href="<?= base_url(); ?>/riwayat/detail/<?php echo $data['id_konsultasi'] ?>">Detail</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        <?php
        }
        ?>

    <?php
    }
    ?>
</div>
<?= $this->endSection() ?>