<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Pasien</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Pasien</h2>
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
<?php if (!empty(session()->getFlashdata('warning'))) : ?>
    <div class="alert alert-warning" role="alert">
        <?php echo session()->getFlashdata('warning'); ?>
    </div>
<?php endif; ?>

<!-- Button trigger tambah modal -->
<button id="buttonTambah" type="button" class="btn btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <span data-feather="plus-circle"></span> Tambah Pasien
</button>
<!-- <a style="float: right;" class="nav-link" href="<?= base_url(); ?>/pasien">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a> -->
<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No.Telp</th>
            <th>Tanggal Lahir</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($pasien as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td><?php echo $row->nama_pasien ?></td>
                <td style="word-wrap: break-word;"><?php echo $row->alamat_pasien ?></td>
                <td align="center"><?php echo $row->no_telp_pasien ?></td>
                <td align="center"><?php $format = date('d-m-Y', strtotime($row->tanggal_lahir_pasien));
                                    echo $format ?></td>
                <td align="center"><?php echo $row->umur_pasien ?> Tahun</td>
                <td align="center"><?php echo $row->jenis_kelamin_pasien ?></td>
                <td style="width: 15%;" align="center">
                    <a style="width: 60px ;" class="btn btn-primary btn-sm btn-edit-pasien" data-id_pasien="<?= $row->id_pasien; ?>" data-nama_pasien="<?= $row->nama_pasien; ?>" data-username_pasien="<?= $row->username_pasien; ?>" data-alamat_pasien="<?= $row->alamat_pasien; ?>" data-no_telp_pasien="<?= $row->no_telp_pasien; ?>" data-tanggal_lahir_pasien="<?= $row->tanggal_lahir_pasien; ?>" data-umur_pasien="<?= $row->umur_pasien; ?>" data-jenis_kelamin_pasien="<?= $row->jenis_kelamin_pasien; ?>">Ubah</a>
                    <a style="width: 60px ;" class="btn btn-danger btn-sm btn-delete-pasien" data-id_pasien="<?= $row->id_pasien; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal Tambah Pasien -->
<?= form_open_multipart(base_url('pasien/processTambah'), 'id="formTambahPasien", novalidate'); ?>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_pasien" placeholder="Masukan Nama Lengkap" required autofocus value="<?= set_value('nama_pasien') ?>">
                    <div class="invalid-feedback">
                        Nama lengkap tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Nama Unik</label>
                    <input type="text" class="form-control" name="username_pasien" placeholder="Masukan Nama Unik" required autofocus value="<?= set_value('username_pasien') ?>" minlength="8" maxlength="10" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                    <div class="invalid-feedback">
                        Nama unik harus 8-10 karakter, mengandung huruf dan minimal 1 angka.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" class="form-control" name="alamat_pasien" placeholder="Masukan Alamat" rows="7" required autofocus value="<?= set_value('alamat_pasien') ?>"></textarea>
                    <div class="invalid-feedback">
                        Alamat tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" class="form-control" name="no_telp_pasien" placeholder="Masukan Nomor Telepon" min="1" maxlength="13" required autofocus onkeypress="return hanyaAngka(event)" value="<?= set_value('no_telp_pasien') ?>">
                    <div class="invalid-feedback">
                        Nomor telepon tidak boleh kosong dan 0.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir_pasien" id="tanggal_lahir_pasien" placeholder="Pilih Tanggal Lahir" required autofocus value="<?= set_value('tanggal_lahir_pasien') ?>">
                    <div class="invalid-feedback">
                        Tanggal lahir tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" class="form-control" name="umur_pasien" id="umur_pasien" placeholder="Masukan Umur" min="1" required autofocus value="<?= set_value('umur_pasien') ?>">
                    <div class="invalid-feedback">
                        Umur tidak boleh kosong dan 0.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin_pasien" id="jenis_kelamin_pasien" class="selectpicker form-control" data-live-search="true" required autofocus value="<?= set_value('jenis_kelamin_pasien') ?>">
                        <option value="<?php echo '' ?>" selected>Pilih Jenis Kelamin</option>
                        <option value="<?php echo 'Perempuan' ?>">Perempuan</option>
                        <option value="<?php echo 'Laki-laki' ?>">Laki-laki</option>
                    </select>
                    <div class="invalid-feedback">
                        Jenis kelamin tidak boleh kosong.
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-circle btn-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Ubah Pasien-->
<?= form_open_multipart(base_url('pasien/processEdit'), 'id="formUbahPasien", novalidate'); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_pasien" name="id_pasien">
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control nama_pasien" name="nama_pasien" placeholder="Masukan Nama Lengkap" required autofocus value="<?= set_value('nama_pasien') ?>">
                    <div class="invalid-feedback">
                        Nama lengkap tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Nama Unik</label>
                    <input type="text" class="form-control username_pasien" name="username_pasien" placeholder="Masukan Nama Unik" required autofocus value="<?= set_value('username_pasien') ?>" minlength="8" maxlength="10" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                    <div class="invalid-feedback">
                        Nama unik harus 8-10 karakter, mengandung huruf dan minimal 1 angka.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" class="form-control alamat_pasien" name="alamat_pasien" placeholder="Masukan Alamat" rows="7" required autofocus value="<?= set_value('alamat_pasien') ?>"></textarea>
                    <div class="invalid-feedback">
                        Alamat tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="number" class="form-control no_telp_pasien" name="no_telp_pasien" placeholder="Masukan Nomor Telepon" min="1" maxlength="13" required autofocus onkeypress="return hanyaAngka(event)" value="<?= set_value('no_telp_pasien') ?>">
                    <div class="invalid-feedback">
                        Nomor telepon tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control tanggal_lahir_pasien" name="tanggal_lahir_pasien" id="tanggal_lahir_pasien" placeholder="Pilih Tanggal Lahir" required value="<?= set_value('tanggal_lahir_pasien') ?>">
                    <div class="invalid-feedback">
                        Tanggal lahir tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Masukan Umur</label>
                    <input type="number" class="form-control umur_pasien" name="umur_pasien" id="umur_pasien" min="1" required autofocus value="<?= set_value('umur_pasien') ?>">
                    <div class="invalid-feedback">
                        Umur tidak boleh kosong.
                    </div>
                </div>
                <br>
                <div class="form-group">
                    <label>Pilih Jenis Kelamin</label>
                    <select name="jenis_kelamin_pasien" id="jenis_kelamin_pasien" class="selectpicker form-control jenis_kelamin_pasien" data-live-search="true" required autofocus value="<?= set_value('jenis_kelamin_pasien') ?>">
                        <option value="<?php echo '' ?>" selected>Pilih Jenis Kelamin</option>
                        <option value="<?php echo 'Perempuan' ?>">Perempuan</option>
                        <option value="<?php echo 'Laki-laki' ?>">Laki-laki</option>
                    </select>
                    <div class="invalid-feedback">
                        Jenis kelamin tidak boleh kosong.
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Hapus Pasien-->
<?= form_open_multipart(base_url('pasien/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_pasien" name="id_pasien">
                </div>
                <h5 style="color: red;">Apakah anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-danger">Ya</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<?= $this->endSection() ?>