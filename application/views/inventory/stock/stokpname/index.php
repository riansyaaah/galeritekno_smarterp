<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('inventory/stock/stokpname/css'); ?>
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
                                <h4 class="card-header"><?= $title; ?></h4>
                                <div class="card-body" id="konten"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="modal"></div>
            <?php $this->load->view('layout/v_footer'); ?>
        </div>
    </div>
    <?php $this->load->view('inventory/stock/stokpname/js'); ?>
    <script>
        const baseUrl = '<?= base_url('inventory/stock/stokpname/'); ?>';
        const sekarang = '<?= $sekarang; ?>';
        window.addEventListener('DOMContentLoaded', () => {
            let csfrData = {};
            const token = '<?= $this->security->get_csrf_token_name(); ?>';
            const hash = '<?= $this->security->get_csrf_hash(); ?>';
            csfrData[token] = hash;
            $.ajaxSetup({data: csfrData});
            renderAwal();
        });
    </script>
</body>
</html>