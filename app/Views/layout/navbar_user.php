<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url(); ?>/dashboard"> Sistem Pakar Diagnosa Penyakit Gigi <i class="fa fa-stethoscope"></i></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav">
                <?php
                $role = session()->get('role');
                // role sebagai admin 
                if ($role == "Admin") { ?>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/user">
                        <span data-feather="users"></span>
                        User
                    </a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/pasien">
                        <span data-feather="users"></span>
                        Pasien
                    </a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/dokter">
                        <span data-feather="users"></span>
                        Dokter
                    </a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/jadwal">
                        <span data-feather="calendar"></span>
                        Jadwal Janji Temu
                    </a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/konsultasi">
                        <span data-feather="database"></span>
                        Konsultasi
                    </a>
                <?php }
                // role sebagai pakar 
                elseif ($role == "Pakar") { ?>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/gejala">
                        <span data-feather="database"></span>
                        Gejala
                    </a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/penyakit">
                        <span data-feather="list"></span>
                        Penyakit
                    </a>
                    <a class="nav-item nav-link" href="<?= base_url(); ?>/aturan">
                        <span data-feather="tool"></span>
                        Aturan
                    </a>
                <?php } ?>

            </div>
            <div class="navbar-nav ms-auto">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo session()->get('role') ?></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="<?= base_url(); ?>/profil" class="dropdown-item"><span data-feather="user"></span> Profil Pengguna</a>
                    <a href="<?= base_url(); ?>/ubahKataSandi" class="dropdown-item"><span data-feather="edit-3"></span> Ubah Kata Sandi</a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url(); ?>/logout" class="dropdown-item"><span data-feather="log-out"></span> Keluar</a>
                </div>
            </div>
        </div>
    </div>
</nav>