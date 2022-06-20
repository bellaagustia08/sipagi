<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Konsultasi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Konsultasi</h2>
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


<a style="float: right;" class="nav-link" href="<?= base_url(); ?>/konsultasi">
    <span data-feather="refresh-ccw"></span> Refresh
</a>

<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.Urut</th>
            <th>No.Tiket</th>
            <th>Username</th>
            <th>Penyakit</th>
            <th>Persentase</th>
            <!-- <th>Aksi</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($konsultasi as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:8%;" align="center"><?php echo $row->no_tiket ?></td>
                <td style="width:16%;">
                    <?php
                    foreach ($member as $rowmember) {
                        if ($rowmember->username_member == $row->username_member) {
                            echo $rowmember->nama_member;
                        }
                    }
                    ?>
                </td>
                <?php
                foreach ($penyakit as $rowPenyakit) {
                    if ($rowPenyakit->id_penyakit == $row->id_penyakit) { ?>
                        <td style="width:16%;"><?php echo $rowPenyakit->nama_penyakit ?></td>
                    <?php break;
                    } ?>
                <?php
                }
                ?>
                <td style="width:5%;"><?php echo round($row->cf_gabungan * 100, 2) ?> %</td>
                <!-- <td style="width: 12%;" align="center">
                    <a class="btn btn-primary btn-sm btn-edit-konsultasi" data-id_konsultasi="<?= $row->id_konsultasi; ?>" data-username_member="<?= $row->username_member; ?>" >Ubah</a>
                    <a class="btn btn-danger btn-sm btn-delete-konsultasi" data-id_konsultasi="<?= $row->id_konsultasi; ?>">Hapus</a>
                </td> -->
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Ubah Konsultasi-->
<?= form_open_multipart(base_url('konsultasi/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_konsultasi" name="id_konsultasi">
                </div>
                <div class="form-group">
                    <input type="text" hidden class="form-control id_member" name="id_member">
                </div>
                <div class="form-group">
                    <input type="text" hidden class="form-control id_penyakit" name="id_penyakit">
                </div>
                <div class="form-group">
                    <input type="float" hidden class="form-control cf_gabungan" name="cf_gabungan">
                </div>
                <div class="form-group">
                    <input type="float" hidden class="form-control persentase" name="persentase">
                </div>
                <div class="form-group">
                    <label>No. Tiket</label>
                    <input type="text" class="form-control no_tiket" name="no_tiket" required autofocus readonly>
                </div>
                <br>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control nama" name="nama" placeholder="Masukan Nama" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea type="text" class="form-control alamat" name="alamat" placeholder="Masukan Alamat" rows="7" required autofocus></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control no_telp" name="no_telp" placeholder="Masukan Nomor Telepon" required autofocus onkeypress="return hanyaAngka(event)">
                </div>
                <br>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control tanggal_lahir" name="tanggal_lahir" id="tanggal_lahir" placeholder="Pilih Tanggal Lahir" required value="<?php date_default_timezone_set('Asia/Jakarta');
                                                                                                                                                                    echo date('d-m-Y'); ?>">
                </div>
                <br>
                <div class="form-group">
                    <label>Penyakit</label>
                    <input type="text" class="form-control nama_penyakit" name="nama_penyakit" required autofocus readonly>
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

<!-- Modal Hapus Konsultasi-->
<?= form_open_multipart(base_url('konsultasi/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Konsultasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_konsultasi" name="id_konsultasi">
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