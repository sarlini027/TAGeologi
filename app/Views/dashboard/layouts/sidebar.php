<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="<?= base_url('/dashboard') ?>" class="waves-effect">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <?php if (session()->user['role'] == 'mahasiswa'): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect has-arrow">
                            <i class="bx bx-file"></i>
                            <span key="t-pendaftaran">Pendaftaran</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url('/seminar-kemajuan') ?>" key="t-seminar-kemajuan">Seminar Kemajuan</a></li>
                            <li><a href="<?= base_url('/seminar-hasil') ?>" key="t-seminar-hasil">Seminar Hasil</a></li>
                            <li><a href="<?= base_url('/sidang-akhir') ?>" key="t-sidang-akhir">Sidang Akhir</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (session()->user['role'] == 'admin' || session()->user['role'] == 'dosen'): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect has-arrow">
                            <i class="bx bx-file"></i>
                            <span key="t-seminar-kemajuan">Seminar Kemajuan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url('/seminar-kemajuan/list-pengajuan') ?>" key="t-list-pengajuan">List Pengajuan</a></li>
                            <li><a href="<?= base_url('/seminar-kemajuan/list-riwayat-pengajuan') ?>" key="t-list-validasi">List Validasi</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect has-arrow">
                            <i class="bx bx-file"></i>
                            <span key="t-seminar-hasil">Seminar Hasil</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url('/seminar-hasil/list-pengajuan') ?>" key="t-list-pengajuan">List Pengajuan</a></li>
                            <li><a href="<?= base_url('/seminar-hasil/list-riwayat-pengajuan') ?>" key="t-list-validasi">List Validasi</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect has-arrow">
                            <i class="bx bx-file"></i>
                            <span key="t-sidang-akhir">Sidang Akhir</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url('/sidang-akhir/list-pengajuan') ?>" key="t-list-pengajuan">List Pengajuan</a></li>
                            <li><a href="<?= base_url('/sidang-akhir/list-riwayat-pengajuan') ?>" key="t-list-validasi">List Validasi</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (session()->user['role'] == 'dosen'): ?>
                    <li>
                        <a href="javascript: void(0);" class="waves-effect has-arrow">
                            <i class="bx bx-file"></i>
                            <span key="t-nilai-ta">Nilai Tugas Akhir</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="#" key="t-seminar-kemajuan">Nilai Seminar Kemajuan</a></li>
                            <li><a href="#" key="t-seminar-hasil">Nilai Seminar Hasil</a></li>
                            <li><a href="#" key="t-sidang-akhir">Nilai Sidang Akhir</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if (session()->user['role'] == 'admin'): ?>
                    <li>
                        <a href="<?= base_url('/data-mahasiswa') ?>" class="waves-effect">
                            <i class="bx bx-group"></i>
                            <span key="t-mahasiswa">Data Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/data-dosen') ?>" class="waves-effect">
                            <i class="bx bx-user"></i>
                            <span key="t-dosen">Data Dosen</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/data-template-dokumen') ?>" class="waves-effect">
                            <i class="bx bx-file"></i>
                            <span key="t-template">Data Template</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('/indikator-penilaian') ?>" class="waves-effect">
                            <i class="bx bx-folder"></i>
                            <span key="t-indikator-penilaian">Indikator Penilaian</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->