<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Script Firebase -->
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-storage.js"></script>

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Selectpicker search -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/dist/css/dselect.css" />
    <script src="<?php echo base_url(); ?>/assets/dist/js/dselect.js"></script>


    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");

        body {
            font-size: .880rem;
            background-color: #FFFDF9;
        }

        .feather {
            width: 16px;
            height: 16px;
            vertical-align: text-bottom;
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
            margin-bottom: 3rem;
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

        /* container */
        .container {
            width: 100%;
        }

        /* style card */
        #cardDataDiri,
        #cardKonsultasi {
            box-shadow: 4px 4px 8px 0 rgba(0, 0, 0, 0.2);
            height: fit-content;
            position: relative;
            padding-left: 30px;
            padding-right: 30px;
            padding-top: 25px;
            padding-bottom: 0;
            background-image: url(<?php echo base_url('public/picture/wallpaper3.jpg'); ?>);
            background-size: cover;
        }

        #cardHasilKonsultasi_datapasien,
        #cardHasilKonsultasi_hasildiagnosa,
        #cardDataPasienPengajuan,
        #cardDetailRiwayat {
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

        #cardPerhatian {
            box-shadow: 4px 4px 8px 0 rgba(0, 0, 0, 0.2);
            width: 50%;
            height: fit-content;
            position: relative;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 15px;
            padding-bottom: 10px;
            background-color: #FFD365;
            background-size: cover;
        }

        /* style button */
        #buttonSimpanPengajuanKonsultasi,
        #buttonKirimJanjiTemu {
            width: 100%;
            background-color: #FFD365;
        }

        #buttonCetakHasilKonsultasi {
            position: absolute;
            width: fit-content;
            background-color: #827397;
            color: white;
            font-size: 16px;
            box-shadow: 4px 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }

        #buttonDownloadHasil {
            position: absolute;
            width: fit-content;
            background-color: #FFD365;
            color: black;
            font-size: 16px;
            box-shadow: 4px 4px 8px 0 rgba(0, 0, 0, 0.2);
            border: 2px solid #827397;
            border-radius: 3px;
        }

        #buttonCariTiket,
        #buttonCariUsernamePasien,
        #buttonCariRiwayat {
            position: relative;
            padding: 6px 15px;
            left: -8px;
            border: 2px solid #827397;
            background-color: #827397;
            color: white;
        }

        #buttonCariTiket:hover,
        #buttonCariUsernamePasien:hover,
        #buttonCariRiwayat:hover,
        #buttonCetakHasilKonsultasi:hover,
        #buttonDownloadHasil:hover {
            background-color: whitesmoke;
            color: black;
            border: 2px solid black;
            border-radius: 3px;
        }

        /* style table */
        th {
            text-align: center;
        }

        /* style modal */
        #detailRiwayatModal {
            top: 20%;

        }
    </style>
</head>


<body>
    <!-- header navbar -->
    <header style="background-color: #827397;">
        <?= $this->include('layout/navbar') ?>
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
        $(document).ready(function() {
            // datatables
            $('#table-datatables').DataTable({
                responsive: true,
                stateSave: true,
                pageLength: 100,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.12.1/i18n/id.json"
                }
            });

            $('.btn-detail-riwayat').on('click', function() {
                // get data from button edit
                const id_konsultasi = $(this).data('id_konsultasi');
                // Set data to Form Edit
                $('#id_konsultasi').val(id_konsultasi);

                // Call Modal Edit
                $('#detailModal').modal('show');
            });
        });

        feather.replace()

        window.setTimeout(function() {
            $(".alert").fadeTo(100, 1).slideUp(1000, function() {
                $(this).remove();
            });
        }, 1200);

        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }

        function goBack() {
            window.history.back()
        }

        function goForward() {
            window.history.forward()
        }

        function goReload() {
            location.reload()
        }

        function fungsiSalinNoTiket() {
            /* Get the text field */
            var copyText = document.getElementById("copyText");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            // navigator.clipboard.writeText(copyText.value);
            document.execCommand('copy');

            /* Alert the copied text */
            // alert("Copied the text: " + copyText.value);
            Swal.fire({ //displays a pop up with sweetalert
                icon: 'success',
                title: 'No. Tiket berhasil di salin',
                showConfirmButton: false,
                timer: 1000
            });
        }

        function fungsiSalinUsername() {
            /* Get the text field */
            var copyText = document.getElementById("copyText");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            // navigator.clipboard.writeText(copyText.value);
            document.execCommand('copy');

            /* Alert the copied text */
            // alert("Copied the text: " + copyText.value);
            Swal.fire({ //displays a pop up with sweetalert
                icon: 'success',
                title: 'Username berhasil di salin',
                showConfirmButton: false,
                timer: 1000
            });
        }

        $('input[type=checkbox]').on('change', function(evt) {
            if ($('input[id=checkboxDokter]:checked').length > 1) {
                this.checked = false;
                alert('Hanya boleh memilih 1 dokter !');
            }

            if ($('input[id=chbx]:checked').length > 1) {
                this.checked = false;
                alert('Pilih salah satu !');
            }

            if ($('input[id=checkboxJadwal]:checked').length > 1) {
                this.checked = false;
                alert('Hanya bisa pilih salah satu jadwal !');
            }
        });

        function cekSpasiNama() {
            const variabel = document.querySelector("#nama");
            const button = document.querySelector("#buttonKirimJanjiTemu");
            if (variabel.value.toString().trim() === "") {
                button.setAttribute("disabled", "disabled");
                alert("Nama Harus Di Isi dan Tidak Boleh Diawali Spasi !")
            } else {
                button.removeAttribute("disabled");
            }
        }

        function cekSpasiAlamat() {
            const variabel = document.querySelector("#alamat");
            const button = document.querySelector("#buttonKirimJanjiTemu");
            if (variabel.value.toString().trim() === "") {
                button.setAttribute("disabled", "disabled");
                alert("Alamat Harus Di Isi dan Tidak Boleh Diawali Spasi !")
            } else {
                button.removeAttribute("disabled");
            }
        }

        function cekSpasiNamaInPengajuan() {
            const variabel = document.querySelector("#nama");
            const button = document.querySelector("#buttonSimpanPengajuanKonsultasi");
            if (variabel.value.toString().trim() === "") {
                button.setAttribute("disabled", "disabled");
                alert("Nama Harus Di Isi dan Tidak Boleh Diawali Spasi !")
            } else {
                button.removeAttribute("disabled");
            }
        }

        function cekSpasiAlamatInPengajuan() {
            const variabel = document.querySelector("#alamat");
            const button = document.querySelector("#buttonSimpanPengajuanKonsultasi");
            if (variabel.value.toString().trim() === "") {
                button.setAttribute("disabled", "disabled");
                alert("Alamat Harus Di Isi dan Tidak Boleh Diawali Spasi !")
            } else {
                button.removeAttribute("disabled");
            }
        }

        function cekSpasiUsernameInPengajuan() {
            const variabel = document.querySelector("#username_pasien");
            const button = document.querySelector("#buttonSimpanPengajuanKonsultasi");
            if (variabel.value.toString().trim() === "") {
                button.setAttribute("disabled", "disabled");
                alert("Username Pasien Harus Di Isi dan Tidak Boleh Diawali Spasi !")
            } else {
                button.removeAttribute("disabled");
            }
        }
    </script>
</body>

</html>