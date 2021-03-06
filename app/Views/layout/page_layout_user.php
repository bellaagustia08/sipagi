<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">

    <?= $this->renderSection('title') ?>

    <!-- CSS dan Script-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

    <!-- Datepicker -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Script Firebase -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-storage.js"></script>

    <!-- Selectpicker search -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/dselect.css" />
    <script src="<?php echo base_url(); ?>/assets/dist/js/dselect.js"></script>



    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");

        body {
            font-size: .880rem;
            background-color: #FFFDF9;
            background-size: cover;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
        }

        /* header */
        header {
            width: 100%;
            background: #827397;
            color: white;
            bottom: 0;
            /* position: fixed; */
        }

        /* navbar */
        .navbar {
            width: 100%;
            padding-right: 0;
        }


        /* main */
        main {
            width: 95%;
            margin: auto;
            padding-bottom: 5rem;
        }

        /* footer */
        .footer {
            width: 100%;
            height: 50px;
            line-height: 50px;
            background: #827397;
            color: white;
            bottom: 0;
            position: fixed;
            padding-left: 10px;
        }

        /* button */
        #buttonTambah,
        #buttonEditProfil {
            background-color: #827397;
            color: white;
        }

        #buttonTambah:hover,
        #buttonEditProfil:hover {
            background-color: #E9D5DA;
            color: black;
        }

        #buttonCariPenyakit {
            position: relative;
            padding: 6px 15px;
            left: -8px;
            border: 2px solid #827397;
            background-color: #827397;
            color: white;
        }

        #buttonCariPenyakit:hover {
            background-color: whitesmoke;
            color: black;
            border: 2px solid black;
            border-radius: 3px;
        }

        .btn.btn-circle.btn-simpan {
            background-color: #827397;
            color: white;
        }

        .btn.btn-circle.btn-simpan:hover {
            background-color: #E9D5DA;
            color: black;
        }

        .btn.btn-circle.btn-simpan-lupa-password {
            background-color: #827397;
            color: white;
        }

        .btn.btn-circle.btn-simpan-lupa-password:hover {
            background-color: #E9D5DA;
            color: black;
        }


        /* card */
        .card#cardProfil,
        .card#cardUbahKataSandi {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 30%;
            border-radius: 20px;
        }

        .card#cardProfil:hover,
        .card#cardUbahKataSandi:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .card#cardProfil .container,
        .card#cardUbahKataSandi .container {
            padding: 2px 16px;
        }

        .card#cardProfil img {
            border-radius: 10px;
        }

        #cardDetailDataPasien,
        #cardDetailKonsultasi {
            box-shadow: 4px 4px 8px 0 rgba(0, 0, 0, 0.2);
            height: fit-content;
            position: relative;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 25px;
            padding-bottom: 10px;
            background-image: url(<?php echo base_url('public/picture/wallpaper3.jpg'); ?>);
            background-size: cover;
            margin-bottom: 2%;
        }

        @media (max-width: 1000.98px) {
            .card#cardProfil {
                width: 100%;
                height: 100%;
            }

            .card#cardUbahKataSandi {
                width: 100%;
                height: 100%;
            }
        }

        th {
            text-align: center;
        }

        .modal {
            top: 2%;
        }

        .modal#tambahModalPenyakit,
        .modal#editModalPenyakit {
            top: 2%;
        }

        .modal#lupaPasswordModal2 {
            top: 15%;
        }
    </style>
</head>


<body>
    <!-- header navbar -->
    <header style="background-color: #827397;">
        <?= $this->include('layout/navbar_user') ?>
    </header>

    <!-- content -->
    <main>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <?= $this->renderSection('title_content') ?>
        </div>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- footer -->
    <?= $this->include('layout/footer') ?>

    <script type="text/javascript">
        feather.replace()

        // setting tampilan window peringatan
        window.setTimeout(function() {
            $(".alert").fadeTo(100, 1).slideUp(1000, function() {
                $(this).remove();
            });
        }, 1200);

        // auto hitung umur
        window.onload = function() {
            $('#tanggal_lahir_pasien').on('change', function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today - dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#umur_pasien').val(age);
            });
        }

        // fungsi untuk input nomor telepon hanya angka saja 
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        function goBack() {
            window.history.back()
        }

        function showHidePasswordLama() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('password_lama').type;
            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {
                //ubah form input password menjadi text
                document.getElementById('password_lama').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
            } else {
                //ubah form input password menjadi text
                document.getElementById('password_lama').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton').innerHTML = `<svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
            }
        }

        function showHidePasswordBaru() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('password_baru').type;
            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {
                //ubah form input password menjadi text
                document.getElementById('password_baru').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton_baru').innerHTML = `<svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
            } else {
                //ubah form input password menjadi text
                document.getElementById('password_baru').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton_baru').innerHTML = `<svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
            }
        }

        function showHidePasswordKonfirmasi() {
            // membuat variabel berisi tipe input dari id='pass', id='pass' adalah form input password 
            var x = document.getElementById('password_konfirmasi').type;
            //membuat if kondisi, jika tipe x adalah password maka jalankan perintah di bawahnya
            if (x == 'password') {
                //ubah form input password menjadi text
                document.getElementById('password_konfirmasi').type = 'text';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton_konfirmasi').innerHTML = `<svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                                                        <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                                                        </svg>`;
            } else {
                //ubah form input password menjadi text
                document.getElementById('password_konfirmasi').type = 'password';

                //ubah icon mata terbuka menjadi tertutup
                document.getElementById('mybutton_konfirmasi').innerHTML = `<svg width="1em" height="2em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                        </svg>`;
            }
        }


        $(document).ready(function() {
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var formsTambahPasien = document.querySelectorAll('#formTambahPasien')
                var formsUbahPasien = document.querySelectorAll('#formUbahPasien')
                var formsTambahDokter = document.querySelectorAll('#formTambahDokter')
                var formsUbahDokter = document.querySelectorAll('#formUbahDokter')
                var formsTambahJadwal = document.querySelectorAll('#formTambahJadwal')
                var formsUbahJadwal = document.querySelectorAll('#formUbahJadwal')
                var formsUbahDataProfil = document.querySelectorAll('#formUbahDataProfil')
                var formsUbahKataSandi = document.querySelectorAll('#formUbahKataSandi')

                // Loop over them and prevent submission
                Array.prototype.slice.call(formsTambahPasien).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsUbahPasien).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsTambahDokter).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsUbahDokter).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsTambahJadwal).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsUbahDokter).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsUbahDataProfil).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })

                Array.prototype.slice.call(formsUbahKataSandi).forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            })()

            // show hide password 
            $("#sandi_lama a").on('click', function(event) {
                event.preventDefault();
                if ($('#sandi_lama input').attr("type") == "text") {
                    $('#sandi_lama input').attr('type', 'password');
                    $('#sandi_lama i').addClass("bi bi-eye-slash");
                    $('#sandi_lama i').removeClass("bi bi-eye");
                } else if ($('#sandi_lama input').attr("type") == "password") {
                    $('#sandi_lama input').attr('type', 'text');
                    $('#sandi_lama i').removeClass("bi bi-eye-slash");
                    $('#sandi_lama i').addClass("bi bi-eye");
                }
            });

            $("#sandi_baru a").on('click', function(event) {
                event.preventDefault();
                if ($('#sandi_baru input').attr("type") == "text") {
                    $('#sandi_baru input').attr('type', 'password');
                    $('#sandi_baru i').addClass("bi bi-eye-slash");
                    $('#sandi_baru i').removeClass("bi bi-eye");
                } else if ($('#sandi_baru input').attr("type") == "password") {
                    $('#sandi_baru input').attr('type', 'text');
                    $('#sandi_baru i').removeClass("bi bi-eye-slash");
                    $('#sandi_baru i').addClass("bi bi-eye");
                }
            });

            $("#sandi_konfirmasi a").on('click', function(event) {
                event.preventDefault();
                if ($('#sandi_konfirmasi input').attr("type") == "text") {
                    $('#sandi_konfirmasi input').attr('type', 'password');
                    $('#sandi_konfirmasi i').addClass("bi bi-eye-slash");
                    $('#sandi_konfirmasi i').removeClass("bi bi-eye");
                } else if ($('#sandi_konfirmasi input').attr("type") == "password") {
                    $('#sandi_konfirmasi input').attr('type', 'text');
                    $('#sandi_konfirmasi i').removeClass("bi bi-eye-slash");
                    $('#sandi_konfirmasi i').addClass("bi bi-eye");
                }
            });

            // datatables
            $('#table-datatables').DataTable({
                responsive: true,
                stateSave: true,
                pageLength: 50,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json"
                }
            });


            //////////////////// BUTTON EDIT DAN DELETE USER ////////////////////
            $('.btn-edit-user').on('click', function() {
                // get data from button edit
                const id_user = $(this).data('id_user');
                const nama_lengkap = $(this).data('nama_lengkap');
                const role = $(this).data('role');
                const status = $(this).data('status');
                // Set data to Form Edit
                $('.id_user').val(id_user);
                $('.nama_lengkap').val(nama_lengkap);
                $('.role').val(role);
                $('.status').val(status);
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            $('.btn-delete-user').on('click', function() {
                // get data from button edit
                const id_user = $(this).data('id_user');
                // Set data to Form Edit
                $('.id_user').val(id_user);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });

            //////////////////// BUTTON EDIT DAN DELETE PASIEN ////////////////////
            $('.btn-edit-pasien').on('click', function() {
                // get data from button edit
                const id_pasien = $(this).data('id_pasien');
                const nama_pasien = $(this).data('nama_pasien');
                const username_pasien = $(this).data('username_pasien');
                const no_telp_pasien = $(this).data('no_telp_pasien');
                const alamat_pasien = $(this).data('alamat_pasien');
                const tanggal_lahir_pasien = $(this).data('tanggal_lahir_pasien');
                const umur_pasien = $(this).data('umur_pasien');
                const jenis_kelamin_pasien = $(this).data('jenis_kelamin_pasien');

                // Set data to Form Edit
                $('.id_pasien').val(id_pasien);
                $('.nama_pasien').val(nama_pasien);
                $('.username_pasien').val(username_pasien);
                $('.no_telp_pasien').val(no_telp_pasien);
                $('.alamat_pasien').val(alamat_pasien);
                $('.tanggal_lahir_pasien').val(tanggal_lahir_pasien);
                $('.umur_pasien').val(umur_pasien);
                $('.jenis_kelamin_pasien').val(jenis_kelamin_pasien);
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            $('.btn-delete-pasien').on('click', function() {
                // get data from button edit
                const id_pasien = $(this).data('id_pasien');
                // Set data to Form Edit
                $('.id_pasien').val(id_pasien);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });

            //////////////////// BUTTON EDIT DAN DELETE DOKTER ////////////////////
            $('.btn-edit-dokter').on('click', function() {
                // get data from button edit
                const id_dokter = $(this).data('id_dokter');
                const nama_dokter = $(this).data('nama_dokter');
                const no_telp_dokter = $(this).data('no_telp_dokter');
                const alamat_dokter = $(this).data('alamat_dokter');
                // Set data to Form Edit
                $('.id_dokter').val(id_dokter);
                $('.nama_dokter').val(nama_dokter);
                $('.no_telp_dokter').val(no_telp_dokter);
                $('.alamat_dokter').val(alamat_dokter)
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            $('.btn-delete-dokter').on('click', function() {
                // get data from button edit
                const id_dokter = $(this).data('id_dokter');
                // Set data to Form Edit
                $('.id_dokter').val(id_dokter);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });

            //////////////////// BUTTON EDIT DAN DELETE JADWAL ////////////////////
            $('.btn-edit-jadwal').on('click', function() {
                // get data from button edit
                const id_jadwal = $(this).data('id_jadwal');
                const tanggal_jadwal = $(this).data('tanggal_jadwal');
                const waktu_jadwal = $(this).data('waktu_jadwal');
                const id_dokter = $(this).data('id_dokter');
                // Set data to Form Edit
                $('.id_jadwal').val(id_jadwal);
                $('.tanggal_jadwal').val(tanggal_jadwal);
                $('.waktu_jadwal').val(waktu_jadwal);
                $('.id_dokter').val(id_dokter);
                // Call Modal Edit
                $('#editModal').modal('show');

            });

            $('.btn-delete-jadwal').on('click', function() {
                // get data from button edit
                const id_jadwal = $(this).data('id_jadwal');
                // Set data to Form Edit
                $('.id_jadwal').val(id_jadwal);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });


            //////////////////// BUTTON EDIT DAN DELETE GEJALA ////////////////////
            $('.btn-edit-gejala').on('click', function() {
                // get data from button edit
                const id_gejala = $(this).data('id_gejala');
                const nama_gejala = $(this).data('nama_gejala');
                // Set data to Form Edit
                $('.id_gejala').val(id_gejala);
                $('.nama_gejala').val(nama_gejala);
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            $('.btn-delete-gejala').on('click', function() {
                // get data from button edit
                const id_gejala = $(this).data('id_gejala');
                // Set data to Form Edit
                $('.id_gejala').val(id_gejala);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });

            //////////////////// BUTTON EDIT DAN DELETE PENYAKIT ////////////////////
            $('.btn-edit-penyakit').on('click', function() {
                // get data from button edit
                const id_penyakit = $(this).data('id_penyakit');
                const nama_penyakit = $(this).data('nama_penyakit');
                const definisi_penyakit = $(this).data('definisi_penyakit');
                const penanganan_penyakit = $(this).data('penanganan_penyakit');
                const gambar_penyakit = $(this).data('gambar_penyakit');
                const nama_file = $(this).data('nama_file');

                // Set data to Form Edit
                $('.id_penyakit').val(id_penyakit);
                $('.nama_penyakit').val(nama_penyakit);
                $('.definisi_penyakit').val(definisi_penyakit);
                $('.penanganan_penyakit').val(penanganan_penyakit);
                $('.gambar_penyakit').val(gambar_penyakit);
                $('.nama_file').val(nama_file);

                // tampil gambar penyakit
                const imageFormEdit = document.getElementById("imageFormEdit");
                imageFormEdit.src = gambar_penyakit;

                // Call Modal Edit
                $('#editModalPenyakit').modal('show');
            });

            $('.btn-delete-penyakit').on('click', function() {
                // get data from button delete
                const id_penyakit = $(this).data('id_penyakit');
                const nama_file_delete = $(this).data('nama_file');
                const url_gambar_delete = $(this).data('gambar_penyakit');

                // Set data to delete 
                $('.id_penyakit').val(id_penyakit);
                $('.nama_file_delete').val(nama_file_delete);
                $('.url_gambar_delete').val(url_gambar_delete);

                // Call Modal Edit
                $('#deleteModal').modal('show');
            });

            $('.btn-detail-penyakit').on('click', function() {
                // get data from button detail
                const id_penyakit = $(this).data('id_penyakit');
                const nama_penyakit = $(this).data('nama_penyakit');
                const definisi_penyakit = $(this).data('definisi_penyakit');
                const penanganan_penyakit = $(this).data('penanganan_penyakit');

                // Set data to detail
                $('.id_penyakit').val(id_penyakit);
                $('.nama_penyakit').val(nama_penyakit);
                $('.definisi_penyakit').val(definisi_penyakit);
                $('.penanganan_penyakit').val(penanganan_penyakit);

                // Call Modal Detail
                $('#detailModalPenyakit').modal('show');
            });


            //////////////////// BUTTON EDIT DAN DELETE ATURAN ////////////////////
            $('.btn-edit-aturan').on('click', function() {
                // get data from button edit
                const id_aturan = $(this).data('id_aturan');
                const id_gejala = $(this).data('id_gejala');
                const id_penyakit = $(this).data('id_penyakit');
                const cf_pakar = $(this).data('cf_pakar');
                // Set data to Form Edit
                $('.id_aturan').val(id_aturan);
                $('#id_gejala_edit').val(id_gejala);
                $('#id_penyakit_edit').val(id_penyakit);
                $('#cf_pakar_edit').val(cf_pakar);

                // Call Modal Edit
                $('#editModal').modal('show');

                dselect(document.querySelector('#id_penyakit_edit'), {
                    search: true,
                    clearable: true
                });
                dselect(document.querySelector('#id_gejala_edit'), {
                    search: true,
                    clearable: true
                });
                dselect(document.querySelector('#cf_pakar_edit'), {
                    search: true,
                    clearable: true
                });
            });

            $('.btn-delete-aturan').on('click', function() {
                // get data from button edit
                const id_aturan = $(this).data('id_aturan');
                // Set data to Form Edit
                $('.id_aturan').val(id_aturan);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });

            //////////////////// BUTTON EDIT DAN DELETE KONSULTASI ////////////////////
            $('.btn-edit-konsultasi').on('click', function() {
                // get data from button edit
                const id_konsultasi = $(this).data('id_konsultasi');
                const username_pasien = $(this).data('username_pasien');
                const no_tiket = $(this).data('no_tiket');
                const id_penyakit = $(this).data('id_penyakit');
                const cf_gabungan = $(this).data('cf_gabungan');
                // Set data to Form Edit
                $('.id_konsultasi').val(id_konsultasi);
                $('.username_pasien').val(username_pasien);
                $('.no_tiket').val(no_tiket);
                $('.id_penyakit').val(id_penyakit);
                $('.cf_gabungan').val(cf_gabungan);
                // Call Modal Edit
                $('#editModal').modal('show');
            });

            $('.btn-delete-konsultasi').on('click', function() {
                // get data from button edit
                const id_konsultasi = $(this).data('id_konsultasi');
                // Set data to Form Edit
                $('.id_konsultasi').val(id_konsultasi);
                // Call Modal Edit
                $('#deleteModal').modal('show');
            });


            //////////////////// BUTTON EDIT DAN DELETE PROFIL ////////////////////
            $('.btn-edit-profil').on('click', function() {
                // get data from button edit
                const id_user = $(this).data('id_user');
                const nama = $(this).data('nama');
                const username = $(this).data('username');
                const email = $(this).data('email');
                const password = $(this).data('password');
                const role = $(this).data('role');
                const status = $(this).data('status');
                // Set data to Form Edit
                $('.id_user').val(id_user);
                $('.nama').val(nama);
                $('.username').val(username);
                $('.email').val(email);
                $('.password').val(password);
                $('.role').val(role);
                $('.status').val(status);
                // Call Modal Edit
                $('#editModal').modal('show');
            });

        });
    </script>
</body>

</html>