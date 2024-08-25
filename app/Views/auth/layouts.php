<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?= $this->renderSection('page_title') ?> | TAGeologi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Website TA Prodi Geologi" name="description" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('dashboard_assets/images/favicon.ico') ?>">
    <!-- Bootstrap Css -->
    <link href="<?= base_url('dashboard_assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('dashboard_assets/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('dashboard_assets/css/app.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="<?= base_url('dashboard_assets/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />

    <!-- App js -->
    <script src="<?= base_url('dashboard_assets/js/plugin.js') ?>"></script>

</head>

<body>
    <?= $this->renderSection('content') ?>

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('dashboard_assets/libs/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/metismenu/metisMenu.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/simplebar/simplebar.min.js') ?>"></script>
    <script src="<?= base_url('dashboard_assets/libs/node-waves/waves.min.js') ?>"></script>

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