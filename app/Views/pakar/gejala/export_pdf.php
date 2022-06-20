<!DOCTYPE html>
<html>

<head>
    <link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Laporan Data Buku Tamu</title>
</head>

<style>
    html,
    body {
        background-color: whitesmoke;
        color: black;
        font-family: Serif;
        margin-right: 2px;
        margin-left: 2px;
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
        word-wrap: break-word;
    }

    th {
        text-align: center;
    }

    a {
        margin-top: 5px;
        margin-right: 2px;
        margin-left: 2px;
    }
</style>

<body>
    <div>
        <a href="<?php echo base_url('kelola/export_pdf'); ?>" class="btn btn-secondary">
            <i class="fas fa-sync"></i> Cetak PDF
        </a>
    </div>

    <div>

        <center>
            <h2>LAPORAN PDF PENCATATAN DATA LEGALISIR</h2>
        </center>

        <br>
        <table style="table-layout: fixed; width: 100%" cellpadding="2" cellspacing="2">
            <thead>
                <tr>
                    <th width="5%" align="center">No</th>
                    <th width="15%" align="center">Tanggal Legalisir</th>
                    <th width="25%" align="center">Nama Pegawai</th>
                    <th width="25%" align="center">Jenis Berkas Legalisir</th>
                    <th width="25%" align="center">Keterangan</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $hitung = 0;
                foreach ($kelolaPegawai as $row) {
                    $hitung = $hitung + 1;
                    foreach ($kelolaBerkas as $rowBerkas) {
                        if ($row['id_berkas'] == $rowBerkas['id_berkas']) {
                            $id_nama_berkas = $rowBerkas['id_nama_berkas'];
                            foreach ($jenis_berkas as $rowJenisBerkas) {
                                if ($rowJenisBerkas->id_jenis_berkas == $id_nama_berkas) {
                                    $nama_berkas = $rowJenisBerkas->nama_jenis_berkas;
                                }
                            }
                        }
                    }
                ?>
                    <tr>
                        <td align="center"><?php echo $row['id_kelola'] ?></td>
                        <td align="center"><?php echo date("d-m-Y", strtotime($row['tanggal_legalisir'])) ?></td>
                        <td><?php echo $row['nama_pegawai'] ?></td>
                        <td><?php echo $nama_berkas ?></td>
                        <td><?php echo $row['keterangan'] ?></td>
                    </tr>
                <?php
                } ?>

            </tbody>
        </table>
    </div>


    <script>
        window.print();
    </script>

</body>

</html>