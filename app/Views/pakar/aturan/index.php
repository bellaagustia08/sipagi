<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Aturan</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Aturan</h2>
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

<!-- button tambah aturan -->
<button id="buttonTambah" type="button" class="btn btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <span data-feather="plus-circle"></span> Tambah Aturan
</button>

<!-- button refresh -->
<!-- <a style="float: right;" class="nav-link" href="<?= base_url(); ?>/aturan">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a> -->
<br><br>

<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Penyakit</th>
            <th>Gejala</th>
            <th>CF Pakar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($aturan as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:25%;" align="center">
                    <?php
                    foreach ($penyakit as $rowpenyakit) {
                        if ($row->id_penyakit == $rowpenyakit->id_penyakit) {
                            echo $rowpenyakit->kode_penyakit . ' - ' . $rowpenyakit->nama_penyakit;
                        }
                    }
                    ?>
                </td>
                <td style="width:45%;">
                    <?php
                    foreach ($gejala as $rowgejala) {
                        if ($row->id_gejala == $rowgejala->id_gejala) {
                            echo $rowgejala->kode_gejala . ' - ' . $rowgejala->nama_gejala;
                        }
                    }
                    ?>
                </td>
                <td style="width: 10%;" align="center"><?php echo $row->cf_pakar ?></td>
                <td style="width: 15%;" align="center">
                    <a style="width: 60px ;" class="btn btn-primary btn-sm btn-edit-aturan" data-id_aturan="<?= $row->id_aturan; ?>" data-id_gejala="<?= $row->id_gejala; ?>" data-id_penyakit="<?= $row->id_penyakit; ?>" data-cf_pakar="<?= $row->cf_pakar; ?>">Ubah</a>
                    <a style="width: 60px ;" class="btn btn-danger btn-sm btn-delete-aturan" data-id_aturan="<?= $row->id_aturan; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<!-- Modal Tambah Jadwal -->
<?= form_open_multipart(base_url('aturan/processTambah')); ?>
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Aturan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body after-add-more">
                <div class="form-group">
                    <label>Penyakit</label>
                    <select name="id_penyakit" id="id_penyakit" class="form-select" required autofocus value="<?= set_value('id_penyakit') ?>">
                        <option value="<?php echo ''; ?>"> Pilih Penyakit</option>
                        <?php foreach ($penyakit as $row) : ?>
                            <option value="<?php echo $row->id_penyakit ?>"><?php echo $row->kode_penyakit; ?> - <?php echo $row->nama_penyakit; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Gejala</label>
                    <select name="id_gejala[]" id="id_gejala" class="form-select" required value="<?= set_value('id_gejala[]') ?>">
                        <option value="<?php echo ''; ?>"> Pilih Gejala</option>
                        <?php foreach ($gejala as $row) : ?>
                            <option value="<?php echo $row->id_gejala ?>"><?php echo $row->kode_gejala; ?> - <?php echo $row->nama_gejala; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Tingkat Keyakinan</label>
                    <select name="cf_pakar[]" id="cf_pakar" class="form-select" required value="<?= set_value('cf_pakar[]') ?>">
                        <option value="<?php echo ''; ?>">Pilih Tingkat Keyakinan</option>
                        <option value="<?php echo $cf_pakar = 1; ?>">Sangat Yakin [1]</option>
                        <option value="<?php echo $cf_pakar = 0.8; ?>">Yakin [0.8]</option>
                        <option value="<?php echo $cf_pakar = 0.6; ?>">Cukup Yakin [0.6]</option>
                        <option value="<?php echo $cf_pakar = 0.4; ?>">Sedikit Yakin [0.4]</option>
                        <option value="<?php echo $cf_pakar = 0.2; ?>">Tidak Tahu [0.2]</option>
                        <option value="<?php echo $cf_pakar = 0; ?>">Tidak Yakin [0]</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-success add-more" type="button" style="float: right;">
                    <span data-feather="plus"></span> Tambah gejala
                </button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-circle btn-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- bagian add more gejala -->
<div class="copy invisible">
    <div class="modal-body">
        <div class="form-group">
            <label>Gejala</label>
            <select name="id_gejala[]" id="id_gejala_addmore" class="form-select" required value="<?= set_value('id_gejala[]') ?>">
                <option value="<?php echo ''; ?>"> Pilih Gejala</option>
                <?php foreach ($gejala as $row) : ?>
                    <option value="<?php echo $row->id_gejala ?>"><?php echo $row->kode_gejala; ?> - <?php echo $row->nama_gejala; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label>Tingkat Keyakinan</label>
            <select name="cf_pakar[]" id="cf_pakar_addmore" class="form-select" required value="<?= set_value('cf_pakar[]') ?>">
                <option value="<?php echo ''; ?>">Pilih Tingkat Keyakinan</option>
                <option value="<?php echo $cf_pakar = 1; ?>">Sangat Yakin [1]</option>
                <option value="<?php echo $cf_pakar = 0.8; ?>">Yakin [0.8]</option>
                <option value="<?php echo $cf_pakar = 0.6; ?>">Cukup Yakin [0.6]</option>
                <option value="<?php echo $cf_pakar = 0.4; ?>">Sedikit Yakin [0.4]</option>
                <option value="<?php echo $cf_pakar = 0.2; ?>">Tidak Tahu [0.2]</option>
                <option value="<?php echo $cf_pakar = 0; ?>">Tidak Yakin [0]</option>
            </select>
        </div>
        <br>
        <button class="btn btn-danger remove" type="button" style="float: left;"><i class="glyphicon glyphicon-remove"></i> Remove</button>
    </div>
</div>


<!-- Modal Ubah Aturan-->
<?= form_open_multipart(base_url('aturan/processEdit')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Aturan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control id_aturan" name="id_aturan" hidden>
                </div>
                <br>
                <div class="form-group">
                    <label>Penyakit</label>
                    <select name="id_penyakit" id="id_penyakit_edit" class="form-select id_penyakit_edit" data-live-search="true" required autofocus value="<?= set_value('id_penyakit') ?>">
                        <option value="<?php echo ''; ?>"> Pilih Penyakit</option>
                        <?php foreach ($penyakit as $row) : ?>
                            <option value="<?php echo $row->id_penyakit ?>"><?php echo $row->kode_penyakit; ?> - <?php echo $row->nama_penyakit; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Gejala</label>
                    <select name="id_gejala" id="id_gejala_edit" class="form-select id_gejala_edit" data-live-search="true" required autofocus value="<?= set_value('id_gejala') ?>">
                        <option value="<?php echo ''; ?>"> Pilih Gejala</option>
                        <?php foreach ($gejala as $row) : ?>
                            <option value="<?php echo $row->id_gejala ?>"><?php echo $row->kode_gejala; ?> - <?php echo $row->nama_gejala; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Tingkat Keyakinan</label>
                    <select name="cf_pakar" id="cf_pakar_edit" class="form-select cf_pakar_edit" data-live-search="true" required autofocus value="<?= set_value('cf_pakar') ?>">
                        <option value="<?php echo ''; ?>">Pilih Tingkat Keyakinan</option>
                        <option value="<?php echo $cf_pakar = 1; ?>">Sangat Yakin</option>
                        <option value="<?php echo $cf_pakar = 0.8; ?>">Yakin</option>
                        <option value="<?php echo $cf_pakar = 0.6; ?>">Cukup Yakin</option>
                        <option value="<?php echo $cf_pakar = 0.4; ?>">Sedikit Yakin</option>
                        <option value="<?php echo $cf_pakar = 0.2; ?>">Tidak Tahu</option>
                        <option value="<?php echo $cf_pakar = 0; ?>">Tidak Yakin</option>
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

<!-- Modal Hapus Aturan-->
<?= form_open_multipart(base_url('aturan/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Aturan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_aturan" name="id_aturan">
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


<script type="text/javascript">
    // search select option
    dselect(document.querySelector('#id_penyakit'), {
        search: true,
        clearable: true
    });
    dselect(document.querySelector('#id_gejala'), {
        search: true,
        clearable: true
    });
    dselect(document.querySelector('#cf_pakar'), {
        search: true,
        clearable: true
    });

    // untuk tombol addmore
    $(".add-more").click(function() {
        var html = $(".copy").html();
        $(".after-add-more").after(html).show;
        dselect(document.querySelector('#id_gejala_addmore'), {
            search: true,
            clearable: true
        });
        dselect(document.querySelector('#cf_pakar_addmore'), {
            search: true,
            clearable: true
        });
    });

    // saat tombol remove dklik control group akan dihapus 
    $("body").on("click", ".remove", function() {
        $(this).parents(".modal-body").remove();
    });
</script>

<?= $this->endSection() ?>