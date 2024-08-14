<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $this->renderSection('title') . ' | ' ?>TAGeologi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('dashboard_assets/images/favicon.ico') ?>">

    <!-- Bootstrap Css -->
    <link href="<?= base_url('dashboard_assets/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('dashboard_assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="<?= base_url('dashboard_assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="<?= base_url('dashboard_assets/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="<?= base_url('dashboard_assets/images/logo.svg') ?>" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('dashboard_assets/images/logo-dark.png') ?>" alt="" height="17">
                            </span>
                        </a>

                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?= base_url('dashboard_assets/images/logo-light.svg') ?>" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('dashboard_assets/images/logo-light.png') ?>" alt="" height="19">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="<?= base_url('dashboard_assets/images/users/user-dummy-img.jpg') ?>"
                                alt="Header Avatar">
                            <span class="d-none d-xl-inline-block ms-1" key="t-henry">
                                <?= session()->user['nama_lengkap'] ?>
                            </span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <form action="<?= base_url('auth/logout') ?>" method="post">
                                <?= csrf_field() ?>
                                <button type="submit" class="dropdown-item text-danger"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                    <span key="t-logout">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">

                        <li class="menu-title" key="t-menu">Menu</li>

                        <li>
                            <a href="#" class="waves-effect">
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
                                    <li><a href="#" key="t-seminar-kemajuan">Seminar Kemajuan</a></li>
                                    <li><a href="#" key="t-seminar-hasil">Seminar Hasil</a></li>
                                    <li><a href="#" key="t-sidang-akhir">Sidang Akhir</a></li>
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
                                    <li><a href="#" key="t-list-pengajuan">List Pengajuan</a></li>
                                    <li><a href="#" key="t-list-validasi">List Validasi</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect has-arrow">
                                    <i class="bx bx-file"></i>
                                    <span key="t-seminar-hasil">Seminar Hasil</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#" key="t-list-pengajuan">List Pengajuan</a></li>
                                    <li><a href="#" key="t-list-validasi">List Validasi</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="waves-effect has-arrow">
                                    <i class="bx bx-file"></i>
                                    <span key="t-sidang-akhir">Sidang Akhir</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="#" key="t-list-pengajuan">List Pengajuan</a></li>
                                    <li><a href="#" key="t-list-validasi">List Validasi</a></li>
                                </ul>
                            </li>
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
                                <a href="#" class="waves-effect">
                                    <i class="bx bx-group"></i>
                                    <span key="t-mahasiswa">Data Mahasiswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="waves-effect">
                                    <i class="bx bx-user"></i>
                                    <span key="t-dosen">Data Dosen</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class=" main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Skote.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('dashboard_assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/node-waves/waves.min.js') ?>"></script>

    <!-- apexcharts -->
    <script src="<?= base_url('dashboard_assets/libs/apexcharts/apexcharts.min.js') ?>"></script>

    <!-- dashboard init -->
    <script src="<?= base_url('dashboard_assets/js/pages/dashboard.init.js') ?>"></script>

    <!-- Sweet Alerts js -->
    <script src="<?= base_url('dashboard_assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>

    <!-- App js -->
    <script src="<?= base_url('dashboard_assets/js/app.js') ?>"></script>

    <?php if (session()->get('success')): ?>
        <script>
            Swal.fire({
                title: "Berhasil",
                text: "<?= session()->get('success') ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>

    <?php if (session()->get('error')): ?>
        <script>
            Swal.fire({
                title: "Gagal",
                text: "<?= session()->get('error') ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>
</body>

</html>