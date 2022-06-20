<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login</title>

    <!-- CSS dan Script-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/assets/css/login.css') ?>">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <!-- untuk show hide password -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <style>
        html,
        body {
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Karla", sans-serif;
        }

        th {
            text-align: center;
        }

        .login-card {
            width: 80%;
            border: 0;
            border-radius: 30px;
            box-shadow: 0 10px 30px 0 rgba(172, 168, 168, 0.43);
            overflow: hidden;
            background-color: #FFFDF9;
        }

        .login-card .card-body {
            padding: 85px 60px 60px;
        }

        .login-card-img {
            border-radius: 0;
            margin-left: -150px;
            position: absolute;
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .login-card .login-tombol {
            padding: 13px 20px 12px;
            background-color: #827397;
            border-radius: 4px;
            font-size: 17px;
            font-weight: bold;
            line-height: 20px;
            color: #fff;
            margin-bottom: 24px;
        }

        .login-card .login-tombol:hover {
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
            .login-card .card-body {
                padding: 35px 24px;
            }
        }

        .btn.btn-circle.btn-simpan-lupa-password {
            background-color: #827397;
            color: white;
        }

        .btn.btn-circle.btn-simpan-lupa-password:hover {
            background-color: #E9D5DA;
            color: black;
        }

        .modal {
            top: 20%;
        }
    </style>
</head>

<body style="background-image: url(<?php echo base_url('public/picture/wallpaper3.jpg'); ?>)">

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <center>
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-5" id="gambarlogin">
                            <img src="<?php echo base_url('assets/assets/images/Login.png') ?>" alt="login" class="login-card-img">
                        </div>
                        <div class="col-md-7">
                            <center>
                                <div class="card-body">
                                    <center>
                                        <h1> - MASUK - </h1>
                                        <hr />
                                    </center>

                                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo session()->getFlashdata('success'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo session()->getFlashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty(session()->getFlashdata('warning'))) : ?>
                                        <div class="alert alert-warning" role="alert">
                                            <?php echo session()->getFlashdata('warning'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <form method="post" action="<?= base_url(); ?>/login/process">
                                        <?= csrf_field() ?>
                                        <div class="form-group">
                                            <label for="username">Nama Pengguna <b style="color: red; font-size:large;">*</b></label>
                                            <input type="text" name="username" id="username" placeholder="Masukan Nama Pengguna" class="form-control" value="<?= set_value('username') ?>" required autofocus>
                                        </div>
                                        <div class="form-group" id="show_hide_password">
                                            <label for="password">Kata Sandi <b style="color: red; font-size:large;">*</b></label>
                                            <input type="password" name="password" id="password" placeholder="Masukan Kata Sandi" class="form-control" value="<?= set_value('password') ?>" required style="display: inline-block; width:85%">
                                            <a href="" class="btn btn-outline-secondary"><i class="bi bi-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block login-tombol mb-4">Masuk</button>
                                        </div>
                                    </form>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#lupaPasswordModal" style="color: red; text-decoration:underline;">Lupa kata sandi ? </a>
                                    <p style="color: red">Belum punya akun ?<a href="<?= base_url(); ?>/registrasi" style="color: purple;"> Registrasi disini </a></p>
                                </div>
                            </center>
                        </div>

                    </div>
                    <center>
                        <div class='copyright'> Copyright 2022 © Bella Agustia</div>
                    </center>
                </div>
            </center>

        </div>
    </main>

    <!-- modal lupa password -->
    <?= form_open_multipart(base_url('lupaPassword/process')); ?>
    <div class="modal fade" id="lupaPasswordModal" tabindex="-1" aria-labelledby="lupaPasswordModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lupaPasswordModalLabel">Lupa Kata Sandi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email </label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email" value="<?= set_value('email') ?>" required autofocus>
                    </div>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-circle btn-simpan-lupa-password">Kirim Email Atur Ulang Kata Sandi</button>
                </div>
            </div>
        </div>
    </div>
    <?= form_close() ?>

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

            window.setTimeout(function() {
                $(".alert").fadeTo(100, 1).slideUp(800, function() {
                    $(this).remove();
                });
            }, 1200);
        });
    </script>
</body>

</html>