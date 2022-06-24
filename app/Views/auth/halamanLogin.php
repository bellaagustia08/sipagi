<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
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
            background-image: url(<?php echo base_url('public/picture/wallpaper3.jpg'); ?>);
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

        @media (max-width: 1650px) {
            .login-card {
                width: 80%;
            }

            .login-card .card-body {
                padding: 35px 24px;
            }
        }

        @media (max-width: 991px) {
            .login-card {
                width: 100%;
            }

            .login-card-img {
                margin-left: -120px;
                object-fit: cover;
            }

            .login-card .card-body {
                padding: 35px 24px;
            }
        }
    </style>
</head>

<body>
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
                                            <div class="input-group">
                                                <input type="password" name="password" id="password" placeholder="Masukan Kata Sandi" class="form-control" value="<?= set_value('password') ?>" required style="display: inline-block;">
                                                <div class="input-group-append">
                                                    <span id="mybutton" onclick="showHidePassword()" class="input-group-text">
                                                        <!-- icon mata bawaan bootstrap  -->
                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
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
        window.setTimeout(function() {
            $(".alert").fadeTo(100, 1).slideUp(1000, function() {
                $(this).remove();
            });
        }, 1200);

        function showHidePassword() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('password').type;
            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {
                //ubah form input password menjadi text
                document.getElementById('password').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
            } else {
                //ubah form input password menjadi text
                document.getElementById('password').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
            }
        }
    </script>
</body>

</html>