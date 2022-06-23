<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Profil Pengguna</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Profil Pengguna</h2>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('error_email'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session()->getFlashdata('error_email'); ?>
    </div>
<?php endif; ?>

<center>
    <div class="card" id="cardProfil">
        <div class="container">
            <br>
            <img src="<?php echo base_url('assets/assets/images/avatar.png') ?>" alt="Avatar" style="width:25%">
            <br>
            <?php
            $tempIdUser = $_SESSION['id_user'];
            $tempNama = $_SESSION['nama_lengkap'];
            $tempUsername = $_SESSION['username'];
            $tempEmail = $_SESSION['email'];
            $tempRole = $_SESSION['role'];
            $tempStatus = $_SESSION['status'];
            ?>

            <h2><b><?php echo $tempNama ?></b></h2>
            <h4>Peran : <?php echo $tempRole ?></h4>
            <hr>
            <p>Username : <?php echo $tempUsername ?></p>
            <p>Email : <?php echo $tempEmail ?></p>
        </div>
    </div>
    <br>

    <a class="btn btn-circle btn-edit-profil" id="buttonEditProfil" data-id_user="<?= $tempIdUser; ?>" data-nama="<?= $tempNama; ?>" data-username="<?= $tempUsername; ?>" data-email="<?= $tempEmail; ?>" data-role="<?= $tempRole; ?>" data-status="<?= $tempStatus; ?>">Ubah Data Profil</a>
</center>


<!-- modal edit profil -->
<?= form_open_multipart(base_url('profil/processEditProfil')); ?>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Data Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control id_user" name="id_user" hidden>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control role" name="role" value="<?= $tempRole; ?>" hidden>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control status" name="status" value="<?= $tempStatus; ?>" hidden>
                </div>


                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="Masukan Nama Lengkap" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" class="form-control username" name="username" id="username" placeholder="Masukan Nama Pengguna" required autofocus minlength="8" maxlength="10" title="Username harus 8-10 karakter dan mengandung minimal 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                </div>
                <br>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control email" name="email" id="email" placeholder="Masukan Email" required autofocus>
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

<?= $this->endSection() ?>