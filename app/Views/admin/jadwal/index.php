<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Jadwal Janji Temu</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Jadwal Janji Temu</h2>
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
    <span data-feather="plus-circle"></span> Tambah Jadwal
</button>

<!-- <a style="float: right;" class="nav-link" href="<?= base_url(); ?>/jadwal">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a> -->
<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal Jadwal</th>
            <th>Waktu</th>
            <th>Dokter</th>
            <th>Nama Pasien</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($jadwal as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:15%;" align="center"><?php $format = date('d - m -  Y', strtotime($row['tanggal_jadwal']));
                                                        echo $format ?></td>
                <td style="width: 15%;" align="center"><?php echo $row['waktu_jadwal'] ?></td>
                <td style="width:16%;" align="center">
                    <?php
                    if ($row['id_dokter'] == NULL) {
                        echo '-';
                    } else {
                        foreach ($dokter as $rowDokter) {
                            if ($row['id_dokter'] == $rowDokter['id_dokter']) {
                                echo $rowDokter['nama_dokter'];
                            }
                        }
                    }
                    ?>
                </td>
                <td style="width:19%;" align="center">
                    <?php
                    if ($row['id_pasien'] == NULL) {
                        echo '-';
                    } else {
                        foreach ($pasien as $rowpasien) {
                            if ($row['id_pasien'] == $rowpasien->id_pasien) {
                                echo $rowpasien->nama_pasien;
                            }
                        }
                    }
                    ?>
                </td>
                <td style="width:16%;" align="center"><?php echo $row['status'] ?></td>
                <td style="width: 15%;" align="center">
                    <?php if ($row['status'] == "Aktif") { ?>
                        <a style="width: 60px ;" class="btn btn-primary btn-sm btn-edit-jadwal disabled" data-id_jadwal="<?= $row['id_jadwal']; ?>" data-tanggal_jadwal="<?= $row['tanggal_jadwal']; ?>" data-waktu_jadwal="<?= $row['waktu_jadwal']; ?>" data-id_dokter="<?= $row['id_dokter']; ?>">Ubah</a>
                        <a style="width: 60px ;" class="btn btn-danger btn-sm btn-delete-jadwal" data-id_jadwal="<?= $row['id_jadwal']; ?>">Hapus</a>
                    <?php } else { ?>
                        <a style="width: 60px ;" class="btn btn-primary btn-sm btn-edit-jadwal" data-id_jadwal="<?= $row['id_jadwal']; ?>" data-tanggal_jadwal="<?= $row['tanggal_jadwal']; ?>" data-waktu_jadwal="<?= $row['waktu_jadwal']; ?>" data-id_dokter="<?= $row['id_dokter']; ?>">Ubah</a>
                        <a style="width: 60px ;" class="btn btn-danger btn-sm btn-delete-jadwal" data-id_jadwal="<?= $row['id_jadwal']; ?>">Hapus</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Tambah Jadwal -->
<?= form_open_multipart(base_url('jadwal/processTambah')); ?>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tanggal Jadwal</label>
                    <input type="text" class="form-control" name="tanggal_jadwal" id="tanggal_jadwal" required placeholder="Pilih Tanggal">
                </div>
                <br>
                <div class="form-group">
                    <label>Waktu</label>
                    <input type="time" class="form-control" name="waktu_jadwal" id="waktu_jadwal" required placeholder="Pilih Waktu">
                </div>
                <br>
                <div class="form-group">
                    <label>Dokter</label>
                    <select name="id_dokter" id="id_dokter" onchange="opsi(this)" class="selectpicker form-control" data-live-search="true" required autofocus value="<?= set_value('id_dokter') ?>">
                        <option value="<?php echo ''; ?>"> Pilih Dokter</option>
                        <?php foreach ($dokter as $row) : ?>
                            <option value="<?php echo $row['id_dokter'] ?>---<?php echo $row['nama_dokter']; ?>"><?php echo $row['nama_dokter']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <input type="text" hidden class="form-control" name="no_tiket" value="-">
                </div>
                <div class="form-group">
                    <input type="text" hidden class="form-control" name="status" value="Tidak Aktif">
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

<!-- Modal Ubah Jadwal-->
<?= form_open_multipart(base_url('jadwal/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control id_jadwal" name="id_jadwal" hidden>
                </div>
                <br>
                <div class="form-group">
                    <label>Tanggal Jadwal</label>
                    <input type="text" class="form-control tanggal_jadwal" name="tanggal_jadwal" id="tanggal_jadwal_edit" required>
                </div>
                <br>
                <div class="form-group">
                    <label>Waktu</label>
                    <input type="time" class="form-control waktu_jadwal" name="waktu_jadwal" id="waktu_jadwal">
                </div>
                <br>
                <div class="form-group">
                    <label>Dokter</label>
                    <input type="text" class="form-control id_dokter" name="id_dokter" hidden>
                    <select name="id_dokter" id="id_dokter" onchange="opsi(this)" class="selectpicker form-control id_dokter" data-live-search="true" required autofocus>
                        <?php foreach ($dokter as $row) : ?>
                            <option <?php if ($row['id_dokter'] == 1) {
                                        echo "selected";
                                    } ?> value="<?php echo $row['id_dokter']; ?>"><?php echo $row['nama_dokter']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <input type="text" hidden class="form-control" name="no_tiket" value="-">
                </div>
                <div class="form-group">
                    <input type="text" hidden class="form-control" name="status" value="Tidak Aktif">
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

<!-- Modal Hapus Jadwal-->
<?= form_open_multipart(base_url('jadwal/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_jadwal" name="id_jadwal">
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


<script>
    // pemilihan tanggal jadwal, min date 0 days offset = today
    $(function() {
        $("#tanggal_jadwal").datepicker({
            minDate: 0,
        });

        $("#tanggal_jadwal_edit").datepicker({
            minDate: 0,
        });
    });
</script>

<?= $this->endSection() ?>