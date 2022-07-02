<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Registrasi</title>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/assets/css/login.css') ?>">

    <!-- untuk show hide password -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <style>
        html,
        body {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Karla", sans-serif;
            background-image: url(<?php echo base_url('public/picture/wallpaper3.jpg'); ?>);
        }

        th {
            text-align: center;
        }

        .registrasi-card {
            width: 60%;
            border: 0;
            border-radius: 30px;
            box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
            overflow: hidden;
            background-color: #FFFDF9;
        }

        .registrasi-card .card-body {
            padding: 85px 60px 60px;
        }

        .registrasi-card-img {
            border-radius: 0;
            margin-left: -150px;
            position: absolute;
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .registrasi-card .registrasi-tombol {
            padding: 13px 20px 12px;
            background-color: #827397;
            border-radius: 4px;
            font-size: 17px;
            font-weight: bold;
            line-height: 20px;
            color: #fff;
            margin-bottom: 24px;
        }

        .registrasi-card .registrasi-tombol:hover {
            border: 1px solid #000;
            background-color: #E9D5DA;
            color: #000;
        }

        .copyright {
            float: none;
            padding-top: 5px;
            padding-bottom: 5px;
            font: normal 80% Verdana, Trebuchet, Arial, Sans-serif;
        }

        @media (max-width: 1650px) {
            .registrasi-card {
                width: 60%;
            }

            .registrasi-card .card-body {
                padding: 35px 24px;
            }
        }

        @media (max-width: 1030px) {
            .registrasi-card {
                width: 80%;
            }

            .registrasi-card .card-body {
                padding: 35px 24px;
            }
        }

        @media (max-width: 460px) {
            .registrasi-card {
                width: 100%;
            }

            .registrasi-card .card-body {
                padding: 35px 24px;
            }
        }
    </style>
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <center>
                <div class="card registrasi-card">
                    <div class="card-body">
                        <center>
                            <h1> - REGISTRASI - </h1>
                            <hr />
                        </center>

                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo session()->getFlashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty(session()->getFlashdata('success'))) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo session()->getFlashdata('success'); ?>
                            </div>
                        <?php endif; ?>

                        <form novalidate id="formRegistrasi" method="post" action="<?= base_url(); ?>/registrasi/process">
                            <?= csrf_field() ?>
                            <br>
                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap <b style="color: red; font-size:large;">*</b></label>
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama Lengkap" required autofocus value="<?= set_value('nama_lengkap') ?>">
                                <div class="invalid-feedback">
                                    Nama tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Nama Pengguna <b style="color: red; font-size:large;">*</b></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Nama Pengguna" required autofocus value="<?= set_value('username') ?>" minlength="8" maxlength="10" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                                <div class="invalid-feedback">
                                    Nama pengguna harus 8-10 karakter dan mengandung huruf dan minimal 1 angka.
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <b style="color: red; font-size:large;">*</b></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" required autofocus value="<?= set_value('email') ?>">
                                <div class="invalid-feedback">
                                    contoh: example@email.com. Email tidak boleh kosong.
                                </div>
                            </div>
                            <div class="form-group" id="show_hide_password">
                                <label for="password">Kata Sandi <b style="color: red; font-size:large;">*</b></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" placeholder="Masukan Kata Sandi" class="form-control" required minlength="8" maxlength="16" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" style="display: inline-block;" value="<?= set_value('password') ?>">
                                    <div class="input-group-append">
                                        <span id="mybutton_registrasi" onclick="showHidePasswordRegistrasi()" class="input-group-text">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="invalid-feedback">
                                        Kata sandi harus 8-16 karakter, mengandung minimal 1 huruf besar, 1 huruf kecil dan 1 angka.
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label>Peran Sebagai : </label>
                                <select name="role" id="role" class="selectpicker form-control" data-live-search="true" placeholder="Pilih peran sebagai" required autofocus value="<?= set_value('role') ?>">
                                    <option <?php if (set_value('role') == '') {
                                                echo 'selected';
                                            } ?> value="<?php echo '' ?>" selected>Pilih Peran Sebagai</option>
                                    <option <?php if (set_value('role') == 'Admin') {
                                                echo 'selected';
                                            } ?> value="<?php echo 'Admin' ?>">Admin</option>
                                    <option <?php if (set_value('role') == 'Pakar') {
                                                echo 'selected';
                                            } ?> value="<?php echo 'Pakar' ?>">Pakar</option>
                                </select>
                                <div class="invalid-feedback">
                                    Peran tidak boleh kosong.
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="text" hidden class="form-control" name="status" id="status" value="<?php echo 'Tidak Aktif'; ?>">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-block registrasi-tombol mb-4">Registrasi</button>
                            </div>
                        </form>
                        <p style="color: red">Sudah punya akun ? <a href="<?= base_url(); ?>/login" style="color: purple;">Masuk disini</a></p>
                    </div>

                    <center>
                        <div class='copyright'> Copyright 2022 © Bella Agustia </div>
                    </center>
                </div>
            </center>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('#formRegistrasi')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })()
        });

        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        function showHidePasswordRegistrasi() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('password').type;
            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {
                //ubah form input password menjadi text
                document.getElementById('password').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton_registrasi').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
            } else {
                //ubah form input password menjadi text
                document.getElementById('password').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton_registrasi').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
            }
        }
    </script>
</body>

</html>