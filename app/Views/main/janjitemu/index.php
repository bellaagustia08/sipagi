<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Janji Temu dengan Dokter</li>
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

<div class="container">
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
    <br>

    <!-- form cari nama dokter -->
    <form method="get" action="<?= base_url(); ?>/janjitemu">
        <div class="row">
            <div class="col">
                <?php
                $nama_dokter = "";
                if (isset($_GET['nama_dokter'])) {
                    $nama_dokter = $_GET['nama_dokter'];
                }
                ?>
                <div class="form-group">
                    <input class="form-control" type="text" id="nama_dokter" name="nama_dokter" placeholder="Cari Nama Dokter..." required autofocus value="<?= set_value('nama_dokter') ?>">
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-circle" id="buttonCariUsernamePasien">
                    <center><span data-feather="search"></span> Cari</center>
                </button>
            </div>
        </div>
    </form>
    <br>

    <?php
    include "koneksi.php";
    if (isset($_GET['nama_dokter'])) {
        $nama_dokter = $_GET['nama_dokter'];
        $sql = "SELECT * FROM dokter WHERE nama_dokter LIKE '%" . $nama_dokter . "%' ";
    } else {
        $sql = null;
    }

    ///////////////////// fitur cari tidak digunakan /////////////////////
    if ($sql == null) {
    ?>
        <h4>Pilih Dokter</h4>
        <form method="GET" name="form" action="<?= base_url(); ?>/janjitemu">
            <?php
            $hitung = 0;
            foreach ($dokter as $row) {
                $hitung = $hitung + 1;
                $checkboxDokter = "";
                if (isset($_GET['checkboxDokter'])) {
                    $checkboxDokter = $_GET['checkboxDokter'];
                }
            ?>
                <h6>
                    <input type="checkbox" id="checkboxDokter" name="checkboxDokter[]" value="<?php echo $row->id_dokter ?>" <?php echo set_checkbox('checkboxDokter[]', $row->id_dokter); ?>>
                    <label for="id_dokter"><?php echo $row->nama_dokter ?></label>
                </h6>
            <?php
            }
            ?>
            <!-- button untuk tampil jadwal sesuai dokter yang dipilih -->
            <input type="submit" value="Lihat Jadwal">
        </form>
        <br>

        <?php
        if (isset($checkboxDokter)) {
            include "koneksi.php";
            $id_dokter_cek = $checkboxDokter[0];
            $sql = "SELECT * FROM jadwal WHERE id_dokter = " . $id_dokter_cek . " ";

            $hasil = mysqli_query($kon, $sql);
            $data = mysqli_fetch_array($hasil);

            if ($data == null) {
        ?>
                <h6>Jadwal Tidak Tersedia</h6>
            <?php
            } else {
            ?>
                <?php if (!empty(session()->getFlashdata('warning2'))) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo session()->getFlashdata('warning2'); ?>
                    </div>
                <?php endif; ?>

                <!-- form untuk update tabel jadwal jika ada yang membuat janji temu -->
                <form method="post" id="formJadwal" action="<?= base_url(); ?>/janjitemu/process">
                    <?= csrf_field() ?>
                    <div class="card align-self-center" id="cardKonsultasi">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                            <?php
                            foreach ($dokter as $row) {
                                if ($row->id_dokter == $data['id_dokter']) {
                                    $nama_dokter = $row->nama_dokter;
                                }
                            }
                            ?>
                            <h3>Jadwal Janji Temu <?php echo $nama_dokter;  ?></h3>
                        </div>
                        <br>

                        <?php
                        $hitung = 0;
                        foreach ($jadwal as $row) {
                            if ($row->id_dokter == $data['id_dokter']) {
                                if ($row->status == 'Tidak Aktif') {
                        ?>
                                    <div class="input-group mb-3" style="width:fit-content; position:relative;">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="checkbox" id="checkboxJadwal" name="jadwal[]" value="<?php echo $row->id_jadwal ?>" autofocus>
                                        </div>
                                        <input type="text" class="form-control" value="<?php echo tgl_indo($row->tanggal_jadwal) ?>" style="width:35%;">
                                        <input type="text" class="form-control" value="<?php echo $row->waktu_jadwal ?>" style="text-align:center ;">
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                        <br>
                    </div>
                    <br>

                    <div class="card align-self-center" id="cardDataDiri">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                            <h3>Form Data Diri</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <br>
                                <h6>Nama Lengkap</h6>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="nama" id="nama" required autofocus value="<?= set_value('nama') ?>">
                                    <label>Masukan Nama Lengkap &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div>
                                <!-- <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="username_pasien" id="username_pasien" required autofocus value="<?= set_value('username_pasien') ?>" minlength="8" maxlength="10" title="Username harus 8-10 karakter dan mengandung minimal 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                                    <label>Masukan Username &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div> -->
                                <h6>Alamat</h6>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="alamat" id="alamat" required autofocus value="<?= set_value('alamat') ?>">
                                    <label>Masukan Alamat &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div>
                                <h6>Nomor Telepon</h6>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="no_telp" id="no_telp" required autofocus value="<?= set_value('no_telp') ?>" maxlength="13" onkeypress="return hanyaAngka(event)">
                                    <label>Masukan Nomor Telepon &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <h6>Tanggal Lahir</h6>
                                <div class="form-floating mb-3">
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required autofocus value="<?= set_value('tanggal_lahir') ?>">
                                    <label>Pilih Tanggal Lahir &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div>
                                <h6>Jenis Kelamin</h6>
                                <div class="form-floating mb-3">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="selectpicker form-control" data-live-search="true" required autofocus value="<?= set_value('jenis_kelamin') ?>">
                                        <option <?php if (set_value('jenis_kelamin') == '') {
                                                    echo 'selected';
                                                } ?> value="<?php echo '' ?>"> Jenis Kelamin</option>
                                        <option <?php if (set_value('jenis_kelamin') == 'Perempuan') {
                                                    echo 'selected';
                                                } ?> value="<?php echo 'Perempuan' ?>">Perempuan</option>
                                        <option <?php if (set_value('jenis_kelamin') == 'Laki-laki') {
                                                    echo 'selected';
                                                } ?> value="<?php echo 'Laki-laki' ?>">Laki-laki</option>
                                    </select>
                                    <label>Pilih Jenis Kelamin &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div>
                                <h6>Umur</h6>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" name="umur" id="umur" required autofocus value="<?= set_value('umur') ?>" onkeypress="return hanyaAngka(event)" min="1">
                                    <label>Masukan Umur &nbsp;<b style="color: red; font-size:large;">*</b></label>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-circle" id="buttonKirimJanjiTemu">Kirim Permintaan Janji Temu</button>
                        </center>
                    </div>
                    <br>
                </form>
            <?php
            }
        } else {
            echo 'Tidak Ada Dokter yang Dipilih';
        }
    }
    ///////////////////// fitur cari tidak digunakan /////////////////////
    ///////////////////// fitur cari digunakan /////////////////////
    else {
        $hasil = mysqli_query($kon, $sql);
        $hasil2 = mysqli_query($kon, $sql);
        $data = mysqli_fetch_array($hasil);

        if ($data == null) {
            ?>
            <h6>Nama Dokter Tidak Ditemukan</h6>
        <?php
        } else {
        ?>
            <h4>Pilih Dokter</h4>
            <form method="get" name="form" action="<?= base_url(); ?>/janjitemu">
                <?php
                $hitung = 0;
                while ($temp = mysqli_fetch_array($hasil2)) {
                    $hitung = $hitung + 1;
                    $checkboxDokter = "";
                    if (isset($_GET['checkboxDokter'])) {
                        $checkboxDokter = $_GET['checkboxDokter'];
                    }
                ?>
                    <h6>
                        <input type="checkbox" name="checkboxDokter[]" id="checkboxDokter" value="<?php echo $temp['id_dokter'] ?>">
                        <label for="id_dokter"><?php echo $temp['nama_dokter'] ?></label>
                    </h6>
                <?php
                }
                ?>
                <!-- button untuk tampil jadwal sesuai dokter yang dipilih -->
                <input type="submit" value="Lihat Jadwal">
            </form>
            <br>
    <?php
        }
    }
    ///////////////////// fitur cari digunakan /////////////////////
    ?>
    <br>

</div>
<?= $this->endSection() ?>