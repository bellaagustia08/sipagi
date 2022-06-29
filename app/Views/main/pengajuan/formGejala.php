<?= $this->extend('layout/page_layout') ?>

<?= $this->section('title') ?>
<title>SiPaGi</title>
<?= $this->endSection() ?>


<?= $this->section('title_content') ?>
<h4>
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Konsultasi Mandiri</li>
        </ol>
    </nav>
</h4>
<?= $this->endSection() ?>


<script>
    <?php

    use Kint\Zval\Value;

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

    window.onload = function() {
        $('#tanggal_lahir').on('change', function() {
            var dob = new Date(this.value);
            var today = new Date();
            var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
            $('#umur').val(age);
        });
    }
</script>


<?= $this->section('content') ?>

<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('error_username_konsultasi'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session()->getFlashdata('error_username_konsultasi'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('warning'))) : ?>
    <div class="alert alert-warning" role="alert">
        <?php echo session()->getFlashdata('warning'); ?>
    </div>
<?php endif; ?>




<!-- if tidak ada session -->

<div class="container">
    <div class="card" id="cardPerhatian">
        <h6>Perhatian!</h6>
        Dimohon Untuk Mengisi Data Dengan Valid.
        <br>
        Jika Anda Pasien Baru di SiPaGi, Masukan "-"
    </div>
    <br>

    <h2> Form Pengajuan Konsultasi</h2>
    <br>

    <!-- form cari -->
    <form method="get" action="<?= base_url(); ?>/pengajuan">
        <div class="row">
            <div class="col">
                <?php
                $username_pasien_cari = "";
                if (isset($_GET['username_pasien_cari'])) {
                    $username_pasien_cari = $_GET['username_pasien_cari'];
                }
                ?>
                <div class="form-group">
                    <input class="form-control" type="text" id="username_pasien_cari" name="username_pasien_cari" placeholder="Username Pasien..." required autofocus value="<?= set_value('username_pasien_cari') ?>">
                </div>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-circle" id="buttonCariUsernamePasien">
                    <center><span data-feather="search"></span> Cari</center>
                </button>
            </div>
        </div>
    </form>
    <br><br>

    <?php
    include "koneksi.php";

    if (isset($_GET['username_pasien_cari'])) {
        $username_pasien_cari = $_GET['username_pasien_cari'];
        $sql = "SELECT * FROM pasien WHERE username_pasien LIKE '$username_pasien_cari' ";
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
            <!-- data tidak ditemukan -->

            <center>
                <h4>Pendaftaran Pasien Baru</h4>
            </center> <br>
            <h6 style="color: red;">Silahkan isi data diri di bawah ini.</h6>

            <!-- form konsultasi -->
            <form name="formDataDiri" method="post" action="<?= base_url(); ?>/pengajuan/process" onsubmit="return validateForm()">
                <?= csrf_field() ?>
                <div class="card" id="cardDataDiri">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                        <h3>Form Data Diri Pasien</h3>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="datetime" class="form-control" name="waktu" id="waktu" required autofocus value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                        echo date('Y/m/d H:i:s'); ?>" hidden>
                    </div>

                    <h6>Nama Lengkap</h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="nama" id="nama" required autofocus value="<?= set_value('nama'); ?>">
                        <label>Masukan Nama Lengkap &nbsp;<b style="color: red; font-size:large;">*</b></label>
                    </div>
                    <h6>Username</h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username_pasien" id="username_pasien" required autofocus value="<?= set_value('username_pasien'); ?>" minlength="8" maxlength="10" title="Username harus 8-10 karakter dan mengandung minimal 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                        <label>Masukan Username &nbsp;<b style="color: red; font-size:large;">*</b></label>
                        <p style="color: red; font-size:small;">Username harus 8-10 karakter dan mengandung minimal 1 angka.</p>
                    </div>
                    <h6>Alamat</h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="alamat" id="alamat" required autofocus value="<?= set_value('alamat'); ?>">
                        <label>Masukan Alamat &nbsp;<b style="color: red; font-size:large;">*</b></label>
                    </div>
                    <h6>Nomor Telepon</h6>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" name="no_telp" id="no_telp" required autofocus value="<?= set_value('no_telp') ?>" min="1" maxlength="13" onkeypress="return hanyaAngka(event)">
                        <label>Masukan Nomor Telepon &nbsp;<b style="color: red; font-size:large;">*</b></label>
                    </div>
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
                                    } ?> value="<?php echo '' ?>"></option>
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
                <br><br>

                <h6 style="color: red;">Silahkan isi form gejala dan isi sesuai gejala yang anda alami.</h6>
                <div class="card align-self-center" id="cardKonsultasi">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                        <h3>Form Gejala</h3>
                    </div>
                    <br>

                    <table id="table-datatable" class="table table-hover row-border">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Gejala</th>
                                <th>Pilih Tingkat Keyakinan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 0;
                            foreach ($gejala as $row) {
                                $nomor = $nomor + 1;
                            ?>
                                <tr>
                                    <td style="width:5%" align="center"><?php echo $nomor ?></td>
                                    <td style="width: 55%; word-wrap: break-word;">
                                        <?php
                                        echo $row->nama_gejala;
                                        ?>
                                    </td>
                                    <td style="width: 40%;" align="center">
                                        <div class="form-group">
                                            <select name="cf_user[]" id="cf_user" class="form-select" required value="<?= set_value('cf_user[]') ?>">
                                                <option value="0">Pilih Tingkat Keyakinan</option>
                                                <option value="1">Sangat Yakin</option>
                                                <option value="0.8">Yakin</option>
                                                <option value="0.6">Cukup Yakin</option>
                                                <option value="0.4">Sedikit Yakin</option>
                                                <option value="0.2">Tidak Tahu</option>
                                                <option value="0">Tidak Yakin</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br>

                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-circle" id="buttonSimpanPengajuanKonsultasi">Proses Data Konsultasi</button>
                        </center>
                    </div>
                    <br>
                </div>
            </form>
        <?php
        } else {
        ?>
            <!-- data ditemukan -->
            <div class="card" id="cardDataPasienPengajuan">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                    <h4>Data Pasien</h4>
                </div>
                <br>
                <table>
                    <tbody>
                        <?php
                        foreach ($pasien as $rowpasien) {
                            if ($data['username_pasien'] == $rowpasien->username_pasien) {
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
            <br>


            <h6 style="color: red;">Silahkan isi form gejala dan isi sesuai gejala yang anda alami.</h6>
            <!-- form konsultasi -->
            <form method="post" action="<?= base_url(); ?>/pengajuan/process">
                <?= csrf_field() ?>

                <div class="card" id="cardDataDiri" hidden>
                    <div class="form-group">
                        <input type="datetime" class="form-control" name="waktu" id="waktu" required autofocus value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                        echo date('Y/m/d H:i:s'); ?>" readonly>
                        <input type="text" class="form-control" name="id_pasien" id="id_pasien" required autofocus value="<?= $data['id_pasien'] ?>" readonly>
                        <input type="text" class="form-control" name="nama" id="nama" required autofocus value="<?= $data['nama_pasien'] ?>" readonly>
                        <input type="text" class="form-control" name="username_pasien" id="username_pasien" required autofocus value="<?= $data['username_pasien'] ?>" readonly>
                        <input type="text" class="form-control" name="alamat" id="alamat" required autofocus value="<?= $data['alamat_pasien'] ?>" readonly>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" required autofocus value="<?= $data['no_telp_pasien'] ?>" maxlength="13" onkeypress="return hanyaAngka(event)" readonly>
                        <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required autofocus value="<?= $data['tanggal_lahir_pasien'] ?>" readonly>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="selectpicker form-control" data-live-search="true" required autofocus value="<?= $data['jenis_kelamin_pasien'] ?>" readonly>
                            <option value="<?php echo '' ?>"> Jenis Kelamin </option>
                            <option value="<?php echo 'Perempuan' ?>"> Perempuan </option>
                            <option value="<?php echo 'Laki-laki' ?>"> Laki-laki </option>
                        </select>
                        <input type="number" class="form-control" name="umur" id="umur" required autofocus value="<?= $data['umur_pasien'] ?>" readonly>
                    </div>
                    <br>
                </div>

                <div class="card align-self-center" id="cardKonsultasi">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                        <h3>Form Gejala</h3>
                    </div>
                    <br>
                    <table id="table-datatable" class="table table-hover row-border">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Gejala</th>
                                <th>Tingkat Keyakinan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 0;
                            foreach ($gejala as $row) {
                                $nomor = $nomor + 1;
                            ?>
                                <tr>
                                    <td style="width:5%" align="center"><?php echo $nomor ?></td>
                                    <td style="width: 55%; word-wrap: break-word;">
                                        <?php
                                        echo $row->nama_gejala;
                                        ?>
                                    </td>
                                    <td style="width: 40%;" align="center">
                                        <div class="form-group">
                                            <select name="cf_user[]" id="cf_user" class="form-select" required value="<?= set_select('cf_user') ?>">
                                                <option value="0">Pilih Tingkat Keyakinan</option>
                                                <option value="1">Sangat Yakin</option>
                                                <option value="0.8">Yakin</option>
                                                <option value="0.6">Cukup Yakin</option>
                                                <option value="0.4">Sedikit Yakin</option>
                                                <option value="0.2">Tidak Tahu</option>
                                                <option value="0">Tidak Yakin</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <br>
                    <div class="form-group">
                        <center>
                            <button type="submit" class="btn btn-circle" id="buttonSimpanPengajuanKonsultasi">Proses Data Konsultasi</button>
                        </center>
                    </div>
                    <br>
                </div>
            </form>
        <?php
        }
        ?>

    <?php
    }
    ?>
</div>

<!-- end if tidak ada session -->

<?= $this->endSection() ?>