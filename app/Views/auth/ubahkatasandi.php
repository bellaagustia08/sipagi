<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Ubah Kata Sandi</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Ubah Kata Sandi</h2>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<center>
    <div class="card" id="cardProfil">
        <div class="container">
            <img src="<?php echo base_url('assets/assets/images/ubah_password2.png') ?>" style="width:inherit;">
            <br>
            <?php
            $tempIdUser = $_SESSION['id_user'];
            $tempNama = $_SESSION['nama_lengkap'];
            $tempUsername = $_SESSION['username'];
            $tempEmail = $_SESSION['email'];
            $tempRole = $_SESSION['role'];
            $tempStatus = $_SESSION['status'];
            // dd($_SESSION);
            ?>

            <h4>Form Ubah Kata Sandi</h4>
            <hr>

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

            <form method="post" action="<?= base_url(); ?>/ubahKataSandi/processUbahKataSandi">
                <?= csrf_field() ?>
                <div class="form-group" hidden>
                    <input type="text" class="form-control" name="id_user" value="<?php echo $tempIdUser ?>">
                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $tempNama ?>">
                    <input type="text" class="form-control" name="username" value="<?php echo $tempUsername ?>">
                    <input type="text" class="form-control" name="email" value="<?php echo $tempEmail ?>">
                    <input type="text" class="form-control" name="role" value="<?php echo $tempRole ?>">
                    <input type="text" class="form-control" name="status" value="<?php echo $tempStatus ?>">
                </div>

                <div class="form-group" id="sandi_lama">
                    <label for="password_lama"><b>Kata Sandi Lama</b></label>
                    <div class="input-group">
                        <input type="password" name="password_lama" id="password_lama" placeholder="Masukan Kata Sandi Lama" class="form-control" value="<?= set_value('password_lama') ?>" required minlength="8" maxlength="16" title="Kata sandi harus 8-16 karakter, dan mengandung min. 1 huruf besar, 1 huruf kecil, 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" style="display: inline-block;">
                        <div class="input-group-append">
                            <span id="mybutton" onclick="showHidePasswordLama()" class="input-group-text">
                                <svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group" id="sandi_baru">
                    <label for="password_baru"><b>Kata Sandi Baru</b></label>
                    <div class="input-group">
                        <input type="password" name="password_baru" id="password_baru" value="<?= set_value('password_baru') ?>" placeholder="Masukan Kata Sandi Baru" class="form-control" required minlength="8" maxlength="16" title="Kata sandi harus 8-16 karakter, dan mengandung min. 1 huruf besar, 1 huruf kecil, 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" style="display: inline-block;">
                        <div class="input-group-append">
                            <span id="mybutton_baru" onclick="showHidePasswordBaru()" class="input-group-text">
                                <svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group" id="sandi_konfirmasi">
                    <label for="password_konfirmasi"><b>Konfirmasi Kata Sandi Baru</b></label>
                    <div class="input-group">
                        <input type="password" name="password_konfirmasi" id="password_konfirmasi" value="<?= set_value('password_konfirmasi') ?>" placeholder="Masukan Konfirmasi Kata Sandi Baru" class="form-control" required minlength="8" maxlength="16" title="Kata sandi harus 8-16 karakter, dan mengandung min. 1 huruf besar, 1 huruf kecil, 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" style="display: inline-block;">
                        <div class="input-group-append">
                            <span id="mybutton_konfirmasi" onclick="showHidePasswordKonfirmasi()" class="input-group-text">
                                <svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <button type="submit" class="btn btn-circle btn-simpan" style="width: 50% ;">Simpan</button>
                </div>
                <br>
            </form>

            <a type="button" data-bs-toggle="modal" data-bs-target="#lupaPasswordModal2" style="color: red; text-decoration:underline;">Lupa kata sandi ? </a>
            <br><br>
        </div>
    </div>
</center>
<br>

<!-- modal lupa password -->
<?= form_open_multipart(base_url('lupaPassword2/process')); ?>
<div class="modal fade" id="lupaPasswordModal2" tabindex="-1" aria-labelledby="lupaPasswordModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lupaPasswordModalLabel">Lupa Kata Sandi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group" hidden>
                    <input type="text" class="form-control" name="id_user" value="<?php echo $tempIdUser ?>">
                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $tempNama ?>">
                    <input type="text" class="form-control" name="username" value="<?php echo $tempUsername ?>">
                    <input type="text" class="form-control" name="role" value="<?php echo $tempRole ?>">
                    <input type="text" class="form-control" name="status" value="<?php echo $tempStatus ?>">
                </div>
                <div class="form-group">
                    <label>Email </label>
                    <input type="email" class="form-control" name="email" placeholder="Masukan Email" value="<?= set_value('email') ?>" required autofocus>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-circle btn-simpan-lupa-password">Kirim Link Atur Ulang Kata Sandi</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>


<?= $this->endSection() ?>