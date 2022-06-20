<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Sesi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Sesi</h2>
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
<!-- Button trigger tambah modal -->
<button id="buttonTambah" type="button" class="btn btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
    Tambah Sesi
</button>

<a style="float: right;" class="nav-link" href="<?= base_url(); ?>/sesi">
    <span data-feather="refresh-ccw"></span> Refresh
</a>

<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Sesi</th>
            <th>Waktu Sesi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($sesi as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width: 40%;" align="center"><?php echo $row->nama_sesi ?></td>
                <td style="width: 40%;" align="center"><?php $format = date('H:i', strtotime($row->waktu_sesi));
                                                        echo $format ?></td>
                <td style="width: 15%;" align="center">
                    <a class="btn btn-primary btn-sm btn-edit-sesi" data-id_sesi="<?= $row->id_sesi; ?>" data-nama_sesi="<?= $row->nama_sesi; ?>" data-waktu_sesi="<?= $row->waktu_sesi; ?>">Ubah</a>
                    <a class="btn btn-danger btn-sm btn-delete-sesi" data-id_sesi="<?= $row->id_sesi; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal Tambah Sesi -->
<?= form_open_multipart(base_url('sesi/processTambah')); ?>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Sesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Sesi</label>
                    <input type="text" class="form-control" name="nama_sesi" placeholder="Masukan Nama Sesi" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Waktu Sesi</label>
                    <input type="time" class="form-control" name="waktu_sesi" placeholder="Pilih Waktu Sesi" required autofocus>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-circle" id="buttonSimpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Ubah Sesi-->
<?= form_open_multipart(base_url('sesi/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Sesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_sesi" name="id_sesi">
                </div>
                <div class="form-group">
                    <label>Nama Sesi</label>
                    <input type="text" class="form-control nama_sesi" name="nama_sesi" placeholder="Nama Sesi" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Waktu Sesi</label>
                    <input type="time" class="form-control waktu_sesi" name="waktu_sesi" placeholder="Pilih Waktu Sesi" required autofocus>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Hapus Sesi-->
<?= form_open_multipart(base_url('sesi/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Sesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_sesi" name="id_sesi">
                </div>
                <h5 style="color: red;">Apakah anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Ya</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<?= $this->endSection() ?>