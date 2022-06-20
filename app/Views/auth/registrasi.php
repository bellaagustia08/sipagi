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
            /* height: 100%; */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Karla", sans-serif;
        }

        th {
            text-align: center;
        }

        .registrasi-card {
            width: 50%;
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

        @media (max-width: 1000px) {
            .registrasi-card .card-body {
                padding: 35px 24px;
            }
        }
    </style>
</head>

<body style="background-image: url(<?php echo base_url('public/picture/wallpaper3.jpg'); ?>)">
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <center>
                <div class="card registrasi-card">
                    <center>
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

                            <form method="post" action="<?= base_url(); ?>/registrasi/process">
                                <?= csrf_field() ?>
                                <br>
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama Lengkap" required autofocus value="<?= set_value('nama_lengkap') ?>">
                                </div>
                                <div class="form-group">
                                    <label for="username">Nama Pengguna</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Nama Pengguna" required autofocus value="<?= set_value('username') ?>" minlength="8" maxlength="10" title="Username harus 8-10 karakter dan mengandung minimal 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-zA-Z]).*$">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" required autofocus value="<?= set_value('email') ?>">
                                </div>
                                <div class="form-group" id="show_hide_password">
                                    <label for="password">Kata Sandi</label>
                                    <input type="password" name="password" id="password" placeholder="Masukan Kata Sandi" class="form-control" required minlength="8" maxlength="16" title="Kata sandi harus 8-16 karakter, mengandung minimal 1 huruf besar, 1 huruf kecil dan 1 angka." pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" style="display: inline-block; width:85%" value="<?= set_value('password') ?>">
                                    <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                    <!-- <small style="color: red;">*Kata sandi harus 8-16 karakter, mengandung minimal 1 huruf besar, 1 huruf kecil dan 1 angka.</small> -->
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
                    </center>

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
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi bi-eye-slash");
                    $('#show_hide_password i').removeClass("bi bi-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi bi-eye-slash");
                    $('#show_hide_password i').addClass("bi bi-eye");
                }
            });
        });

        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
    </script>
</body>

</html>