<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/template/css/app.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/style.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
</head>

<body>
    <div class="loader"></div>
    <div id="snackbar_custom"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php $this->load->view('layout/v_header'); ?>
            <?php $this->load->view('layout/v_menu'); ?>
            <div class="main-content">
                <section class="section">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4><?= $title; ?></h4><hr>
                                </div>
                                <div class="card-body"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('layout/v_footer'); ?>
        </div>
    </div>
    <script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
    <script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
    <script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
    <script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
    <script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            var csfrData = {};
            csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
            $.ajaxSetup({
                data: csfrData
            });
        }
    </script>
</body>

</html>