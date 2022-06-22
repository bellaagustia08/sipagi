<?= $this->extend('layout/page_layout_user') ?>

<?= $this->section('title') ?>
<title>Penyakit</title>
<?= $this->endSection() ?>

<?= $this->section('title_content') ?>
<h2>Data Penyakit</h2>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php if (!empty(session()->getFlashdata('success'))) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('deleted'))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo session()->getFlashdata('deleted'); ?>
    </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('warning'))) : ?>
    <div class="alert alert-warning" role="alert">
        <?php echo session()->getFlashdata('warning'); ?>
    </div>
<?php endif; ?>

<!-- button tambah penyakit -->
<button id="buttonTambah" type="button" class="btn btn-circle mb-2" data-bs-toggle="modal" data-bs-target="#tambahModalPenyakit">
    <span data-feather="plus-circle"></span> Tambah Penyakit
</button>

<!-- button refresh -->
<!-- <a style="float: right;" class="nav-link" href="<?= base_url(); ?>/penyakit">
    <span data-feather="refresh-ccw"></span> Muat Ulang
</a> -->
<br><br>


<table id="table-datatables" class="table table-hover row-border">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Penyakit</th>
            <th>Gambar Penyakit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hitung = 0;
        foreach ($penyakit as $row) {
            $hitung = $hitung + 1;
        ?>
            <tr>
                <td style="width: 5%;" align="center"><?php echo $hitung ?></td>
                <td style="width:30%;"><?php echo $row->nama_penyakit ?></td>
                <td style="width: 50%;" align="center"><img src="<?php echo $row->gambar_penyakit ?>" alt="" id="imageTampilGambar" style="width:180px"></td>
                <td style="width: 15%;" align="center">
                    <a style="width: 60px ;" class="btn btn-sm btn-circle btn-simpan btn-detail-penyakit" data-id_penyakit="<?= $row->id_penyakit; ?>" data-nama_penyakit="<?= $row->nama_penyakit; ?>" data-definisi_penyakit="<?= $row->definisi_penyakit; ?>" data-penanganan_penyakit="<?= $row->penanganan_penyakit; ?>">Detail</a>
                    <a style="width: 60px ;" class="btn btn-primary btn-sm btn-edit-penyakit" data-id_penyakit="<?= $row->id_penyakit; ?>" data-gambar_penyakit="<?= $row->gambar_penyakit; ?>" data-nama_penyakit="<?= $row->nama_penyakit; ?>" data-definisi_penyakit="<?= $row->definisi_penyakit; ?>" data-penanganan_penyakit="<?= $row->penanganan_penyakit; ?>">Ubah</a>
                    <a style="width: 60px ;" class="btn btn-danger btn-sm btn-delete-penyakit" data-id_penyakit="<?= $row->id_penyakit; ?>">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<!-- Modal Tambah Penyakit -->
<?= form_open_multipart(base_url('penyakit/processTambah')); ?>
<div class="modal fade" id="tambahModalPenyakit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Form Tambah Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <input type="text" class="form-control" name="nama_penyakit" placeholder="Masukan Nama Penyakit" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Definisi Penyakit</label>
                    <textarea rows="7" type="text" class="form-control" name="definisi_penyakit" placeholder="Masukan Definisi Penyakit" required autofocus></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Penanganan Penyakit</label>
                    <textarea rows="7" type="text" class="form-control" name="penanganan_penyakit" placeholder="Masukan Penanganan Penyakit" required autofocus></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Gambar Penyakit</label>
                    <input type="file" class="form-control" name="gambar_penyakit" id="gambar_penyakit" accept="image/*" required>
                    <progress id="progress_bar" value="0" max="100" style="width: 100%;"></progress>
                    <b style="color: red;">Tunggu sampai proses upload gambar selesai !</b>
                    <br>
                    <img src="" alt="" id="image" style="width:250px">
                    <input type="text" class="form-control" name="url_gambar_penyakit" id="url_gambar_penyakit" value="" hidden>
                    <input type="text" class="form-control" name="nama_file" id="nama_file" value="" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-circle btn-simpan" id="buttonSimpanPenyakit">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- Modal Ubah Penyakit-->
<?= form_open_multipart(base_url('penyakit/processEdit')); ?>
<div class="modal fade" id="editModalPenyakit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Form Ubah Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" hidden class="form-control id_penyakit" name="id_penyakit">
                </div>
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <input type="text" class="form-control nama_penyakit" name="nama_penyakit" placeholder="Nama Penyakit" required autofocus>
                </div>
                <br>
                <div class="form-group">
                    <label>Definisi Penyakit</label>
                    <textarea rows="7" type="text" class="form-control definisi_penyakit" name="definisi_penyakit" placeholder="Masukan Definisi Penyakit" required autofocus></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label>Penanganan Penyakit</label>
                    <textarea rows="7" type="text" class="form-control penanganan_penyakit" name="penanganan_penyakit" placeholder="Masukan Penanganan Penyakit" required autofocus></textarea>
                </div>
                <br>
                <!-- imageFormEdit untuk preview -->
                <img src="" alt="" id="imageFormEdit" style="width:250px">
                <br> <br>
                <div class="form-group">
                    <label>Ubah Gambar Penyakit</label>
                    <input type="file" class="form-control" name="gambar_penyakit_edit" id="gambar_penyakit_edit" accept="image/*">
                    <progress id="progress_bar_edit" value="0" max="100" style="width: 100%;"></progress>
                    <b style="color: red;">Tunggu sampai proses upload gambar selesai !</b>
                    <br>
                    <!-- image_edit untuk preview saat ubah gambar -->
                    <img src="" alt="" id="image_edit" style="width:250px">
                    <input type="text" class="form-control" name="url_gambar_penyakit_edit" id="url_gambar_penyakit_edit" value="" hidden>
                    <input type="text" class="form-control" name="nama_file_edit" id="nama_file_edit" value="" hidden>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>

<!-- modal detail -->
<div class="modal fade" id="detailModalPenyakit" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Detail Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h6>Nama Penyakit</h6>
                    <input type="text" class="form-control nama_penyakit" name="nama_penyakit" readonly>
                    <br>
                    <h6>Definisi</h6>
                    <textarea rows="5" type="text" class="form-control definisi_penyakit" name="definisi_penyakit" readonly></textarea>
                    <br>
                    <h6>Penanganan</h6>
                    <textarea rows="5" type="text" class="form-control penanganan_penyakit" name="penanganan_penyakit" readonly></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Penyakit-->
<!-- <form method="post" name="formDelete" id="formDelete" action="<?= base_url(); ?>/penyakit/delete"> -->
<?= form_open_multipart(base_url('penyakit/delete')); ?>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Penyakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control id_penyakit" name="id_penyakit" hidden>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control url_gambar_delete" name="url_gambar_delete" id="url_gambar_delete" hidden>
                    <input type="text" class="form-control nama_file_delete" name="nama_file_delete" id="nama_file_delete" hidden>
                </div>
                <h5 style="color: red;">Apakah anda yakin ingin menghapus data tersebut?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Tidak</button>
                <!-- <input class="btn btn-danger" id="submit" name="submit" type="submit" value="Ya" onclick="return deleteImageStorage();" /> -->
                <button type="submit" class="btn btn-danger">Ya</button>
            </div>
        </div>
    </div>
</div>
<?= form_close() ?>
<!-- </form> -->


<script>
    var firebaseConfig = {
        apiKey: "AIzaSyBRF7H2SykKIFUmMZPoUjaPOA37nfuR_ZU",
        authDomain: "sipagi.firebaseapp.com",
        projectId: "sipagi",
        storageBucket: "sipagi.appspot.com",
        messagingSenderId: "744187200309",
        appId: "1:744187200309:web:7b8b6e7e7f6f9c19a5c27c",
        measurementId: "G-NEW5DGTEPF"
    };
    firebase.initializeApp(firebaseConfig);
</script>

<script type="text/javascript">
    // upload gambar bagian tambah tanpa button
    document.getElementById("gambar_penyakit").addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (!file.type.match('image/jp.*') && !file.type.match('image/pn.*')) {
            alert('Maaf... Hanya file JPG dan PNG yang boleh diupload..!');
            $('#gambar_penyakit').val('');
            return;
        } else {
            var imageName = file.name;
            const storageRef = firebase.storage().ref('penyakit/' + imageName);
            storageRef.put(file);


            storageRef.put(file).on('state_changed', (snapshot) => {
                const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                console.log("upload is " + progress + "% done");
                const progressBar = document.getElementById('progress_bar');
                progressBar.value = progress;
            }, function(error) {
                console.log(error.message);
            }, function() {
                storageRef.put(file).snapshot.ref.getDownloadURL().then(function(downloadURL) {
                    const image = document.getElementById("image");
                    image.src = downloadURL;
                    console.log('File available at ', downloadURL);

                    // untuk value gambar penyakit. simpan url nya
                    const url_gambar_penyakit = document.getElementById("url_gambar_penyakit");
                    url_gambar_penyakit.value = downloadURL;

                    const nama_file = document.getElementById("nama_file");
                    nama_file.value = file.name;
                });
                alert('Upload Gambar Selesai');
            });
        }

    });


    // upload gambar bagian edit
    document.getElementById("gambar_penyakit_edit").addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (!file.type.match('image/jp.*') && !file.type.match('image/pn.*')) {
            alert('Maaf... Hanya file JPG dan PNG yang boleh diupload..!');
            $('#gambar_penyakit').val('');
            return;
        } else {
            var imageName = file.name;
            const storageRef = firebase.storage().ref('penyakit/' + imageName);
            storageRef.put(file);


            storageRef.put(file).on('state_changed', (snapshot) => {
                const progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                console.log("upload is " + progress + "% done");
                const progressBar = document.getElementById('progress_bar_edit');
                progressBar.value = progress;
            }, function(error) {
                console.log(error.message);
            }, function() {
                storageRef.put(file).snapshot.ref.getDownloadURL().then(function(downloadURL) {
                    const image = document.getElementById("image_edit");
                    image.src = downloadURL;
                    console.log('File available at ', downloadURL);

                    // untuk value gambar penyakit. simpan url nya
                    const url_gambar_penyakit_edit = document.getElementById("url_gambar_penyakit_edit");
                    url_gambar_penyakit_edit.value = downloadURL;

                    const nama_file_edit = document.getElementById("nama_file_edit");
                    nama_file_edit.value = file.name;
                });
                alert('Upload Gambar Selesai');
            });
        }

    });

    function deleteImageStorage() {
        var nama_file_delete = document.getElementById("nama_file_delete");
        const url_gambar_delete = document.getElementById("url_gambar_delete")

        var storageRef = storageRef.child('penyakit/' + nama_file_delete);

        storageRef.delete()
            .then(() => {
                alert("berhasil");
                console.log("berhasil");
                return true;
            })
            .catch((error) => {
                alert('gagal');
                console.log("gagal");
                return false;
            });

        document.getElementById('formDelete').submit();
        // alert('Form has been submitted');
        return true;
    }
</script>

<?= $this->endSection() ?>