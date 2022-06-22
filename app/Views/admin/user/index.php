<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>User</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data User</h2>
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

<a style="float: right;" class="nav-link" href="<?= base_url(); ?>/user">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a>

<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Lengkap</th>
            <th>Peran</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($user as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:26%;"><?php echo $row->nama_lengkap ?></td>
                <td style="width:26%;" align="center"><?php echo $row->role ?></td>
                <td style="width:26%;" align="center"><?php echo $row->status ?></td>
                <td style="width: 17%;" align="center">
                    <a style="width: 60px ;" class="btn btn-primary btn-sm btn-edit-user" data-id_user="<?= $row->id_user; ?>" data-nama_lengkap="<?= $row->nama_lengkap; ?>" data-role="<?= $row->role; ?>" data-status="<?= $row->status; ?>">Ubah</a>
                    <a style="width: 60px ;" class="btn btn-danger btn-sm btn-delete-user" data-id_user="<?= $row->id_user; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal Ubah User-->
<?= form_open_multipart(base_url('user/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_user" name="id_user">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control nama_lengkap" name="nama_lengkap" required autofocus value="<?= set_value('nama_lengkap') ?>" readonly>
                </div>
                <br>
                <div class="form-group">
                    <label>Peran</label>
                    <select name="role" id="role" class="form-select role" data-live-search="true" required autofocus value="<?= set_value('role') ?>">
                        <option value="<?php echo '' ?>" selected>Pilih Peran Sebagai</option>
                        <option value="<?php echo 'Admin' ?>">Admin</option>
                        <option value="<?php echo 'Pakar' ?>">Pakar</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" class="form-select status" data-live-search="true" required autofocus value="<?= set_value('status') ?>">
                        <option value="<?php echo '' ?>" selected>Pilih Status</option>
                        <option value="<?php echo 'Aktif' ?>">Aktif</option>
                        <option value="<?php echo 'Tidak Aktif' ?>">Tidak Aktif</option>
                    </select>
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

<!-- Modal Hapus Member-->
<?= form_open_multipart(base_url('user/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_user" name="id_user">
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