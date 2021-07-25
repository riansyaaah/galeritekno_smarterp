<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('inventory/stock/stockopname/css'); ?>
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
                                <div class="card-body">
                                    <div id="header"></div>
                                    <div id="konten"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div id="modal"></div>
            <?php $this->load->view('layout/v_footer'); ?>
        </div>
    </div>
    <?php $this->load->view('inventory/stock/stockopname/js'); ?>
    <script>
        const baseUrl = '<?= base_url('inventory/stock/stockopname/'); ?>';
        window.addEventListener('DOMContentLoaded', () => {
            let csfrData = {};
            const token = '<?= $this->security->get_csrf_token_name(); ?>';
            const hash = '<?= $this->security->get_csrf_hash(); ?>';
            csfrData[token] = hash;
            $.ajaxSetup({data: csfrData});
            renderAwal();
        });
        document.querySelector('#header').addEventListener('click', e => {
            if(e.target.id == 'btnBack') {
                renderAwal();
            }
        });
        function renderAwal() {
            document.querySelector('#header').innerHTML = '';
            document.querySelector('#konten').innerHTML = tabelItemHTML();
            dataTableItem();
            document.querySelector('#modal').innerHTML = '';
        }
        function renderDetail(id) {
            renderHeader(id);
            document.querySelector('#konten').innerHTML = detailHTML();
            dataTableDetail(id);
        }
        function renderHeader(id) {
            fetch(`${baseUrl}gettransaction?id=${id}`)
                .then(res => res.json())
                .then(res => {
                    document.querySelector('#header').innerHTML = headerElement(res.data.noTransaction);
                })
                .catch(e => console.log(e));    
        }
        function dataTableItem() {
            $('#tableItem').dataTable({
                destroy: true,
                ajax: {
                    url: `${baseUrl}getitem`,
                    dataSrc: 'data'
                },
                columns: [
                    {"data": 'noTransaction'},
                    {"data": 'tglTransaction'},
                    {"data": 'tipe'},
                    {"data": 'btn'}
                ],
                "columnDefs": [{
                    "sortable": false,
                    "targets": [3]
                }],
                "createdRow": (row, data, index) => {
                    $('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(1).addClass('text-center');
                    $('td', row).eq(2).addClass('text-center');
                    $('td', row).eq(3).addClass('text-center');
                }
            });
        }
        function dataTableDetail(id) {
            const form = {id: id}
            $('#tableDetail').dataTable({
                destroy: true,
                bInfo: false,
                ajax: {
                    url: `${baseUrl}getitem`,
                    dataSrc: 'data',
                    type: 'POST',
                    dataType: 'json',
                    data: form
                },
                columns: [
                    {"data": 'itemmaster'},
                    {"data": 'jmlAwal'},
                    {"data": 'jmlAkhir'}
                ],
                "columnDefs": [{
                    "sortable": false,
                    "targets": [1, 2]
                }],
                "createdRow": (row, data, index) => {
                    $('td', row).eq(1).addClass('text-center');
                    $('td', row).eq(2).addClass('text-center');
                }
            });
        }
        function headerElement(noTransaction) {
            return `<div class="row mb-3">
                <div class="col-md-2">
                    <button class="btn btn-warning btn-sm" id="btnBack"><i class="fa fa-backward"></i> Kembali</button>
                </div>
                <div class="col-md">
                    <h6>${noTransaction}</h6>
                </div>
            </div>`;
        }
        function detailHTML() {
            return `<div class="table-responsive">
                <table style="width: 100%;" id="tableDetail" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Nama Item</th>
                            <th>Jumlah Awal</th>
                            <th>Jumlah Akhir</th>
                        </tr>
                    </thead>
                </table>
            </div>`;
        }
        function tabelItemHTML() {
            return `<div class="table-responsive">
                <table style="width: 100%;" id="tableItem" class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 30%;">No Transaksi</th>
                            <th style="width: 30%;">Tanggal</th>
                            <th style="width: 30%;">Tipe</th>
                            <th style="width: 10%;"></th>
                        </tr>
                    </thead>
                </table>
            </div>`;
        }
    </script>
</body>
</html>