<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Dokter</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Dokter</h2>
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
    <span data-feather="plus-circle"></span> Tambah Dokter
</button>
<a style="float: right;" class="nav-link" href="<?= base_url(); ?>/dokter">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a>

<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No.Telp</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($dokter as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:25%;"><?php echo $row['nama_dokter'] ?></td>
                <td style="width:30%; word-wrap: break-word;"><?php echo $row['alamat_dokter'] ?></td>
                <td style="width:20%;" align="center"><?php echo $row['no_telp_dokter'] ?></td>
                <td style="width: 20%;" align="center">
                    <a class="btn btn-primary btn-sm btn-edit-dokter" data-id_dokter="<?= $row['id_dokter']; ?>" data-nama_dokter="<?= $row['nama_dokter']; ?>" data-alamat_dokter="<?= $row['alamat_dokter']; ?>" data-no_telp_dokter="<?= $row['no_telp_dokter']; ?>">Ubah</a>
                    <a class="btn btn-danger btn-sm btn-delete-dokter" data-id_dokter="<?= $row['id_dokter']; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal Tambah Dokter -->
<?= form_open_multipart(base_url('dokter/processTambah')); ?>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" name="nama_dokter" placeholder="Masukan Nama" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" class="form-control" name="alamat_dokter" placeholder="Masukan Alamat" rows="7" required autofocus></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp_dokter" placeholder="Masukan Nomor Telepon" required autofocus onkeypress="return hanyaAngka(event)">
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

<!-- Modal Ubah Dokter-->
<?= form_open_multipart(base_url('dokter/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_dokter" name="id_dokter">
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control nama_dokter" name="nama_dokter" placeholder="Masukan Nama" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" class="form-control alamat_dokter" name="alamat_dokter" placeholder="Masukan Alamat" rows="7" required autofocus></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control no_telp_dokter" name="no_telp_dokter" placeholder="Masukan Nomor Telepon" required autofocus onkeypress="return hanyaAngka(event)">
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

<!-- Modal Hapus Dokter-->
<?= form_open_multipart(base_url('dokter/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_dokter" name="id_dokter">
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