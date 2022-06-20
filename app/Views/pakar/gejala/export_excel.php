<?php

header("Content-type: application/octet-stream");
ob_end_clean();

header("Content-Disposition: attachment; filename=Laporan Excel Pencatatan Data Legalisir.xls");

header("Pragma: no-cache");

header("Expires: 1");

?>

<table border="1" style="width: 100%; border-collapse: collapse">
    <thead>
        <tr>
            <th colspan="5">LAPORAN EXCEL PENCATATAN DATA LEGALISIR</th>
        </tr>
        <tr>
            <th width="5%" align="center">No</th>
            <th width="15%" align="center">Tanggal Legalisir</th>
            <th width="20%" align="center">Nama Pegawai</th>
            <th width="20%" align="center">Berkas</th>
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