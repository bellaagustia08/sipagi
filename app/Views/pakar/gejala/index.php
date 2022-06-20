<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Gejala</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Gejala</h2>
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

<!-- button tambah gejala -->
<button id="buttonTambah" type="button" class="btn btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <span data-feather="plus-circle"></span> Tambah Gejala
</button>

<!-- button refresh -->
<a style="float: right;" class="nav-link" href="<?= base_url(); ?>/gejala">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a>

<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Gejala</th>
            <th>Nama Gejala</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($gejala as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:10%;" align="center"><?php echo $row->kode_gejala ?></td>
                <td style="width:65%; word-wrap:unset;"><?php echo $row->nama_gejala ?></td>
                <td style="width: 20%;" align="center">
                    <a class="btn btn-primary btn-sm btn-edit-gejala" data-id_gejala="<?= $row->id_gejala; ?>" data-nama_gejala="<?= $row->nama_gejala; ?>">Ubah</a>
                    <a class="btn btn-danger btn-sm btn-delete-gejala" data-id_gejala="<?= $row->id_gejala; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Tambah Gejala -->
<?= form_open_multipart(base_url('gejala/processTambah')); ?>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Gejala</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Gejala</label>
                    <input type="text" class="form-control" name="nama_gejala" placeholder="Masukan Nama Gejala" required autofocus>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-circle btn-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Ubah Gejala-->
<?= form_open_multipart(base_url('gejala/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Gejala</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_gejala" name="id_gejala">
                </div>
                <div class="form-group">
                    <label>Nama Gejala</label>
                    <input type="text" class="form-control nama_gejala" name="nama_gejala" placeholder="Nama Gejala" required autofocus>
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

<!-- Modal Hapus Gejala-->
<?= form_open_multipart(base_url('gejala/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Gejala</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_gejala" name="id_gejala">
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