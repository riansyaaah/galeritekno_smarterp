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
    <style>
        .custom-select-sm {
            height: calc(1.5em + 0.5rem + 2px);
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
            padding-left: 0.5rem;
            font-size: 0.875rem;
        }
        .hidetd {
            display: none !important;
        }
    </style>
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
                                <div class="card-body">
                                    <button class="btn btn-primary" id="btnAdd"><i class="fa fa-plus"></i> Tambah</button>
                                </div>
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
    <input type="hidden" id="baseUrl" value="<?= base_url('inventory/masterdata/tokoecommerce/'); ?>">
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
        const baseUrl = document.querySelector('#baseUrl').value;
        window.addEventListener('DOMContentLoaded', e => {
            const csfrData = {};
            csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
            $.ajaxSetup({
                data: csfrData
            });
            aksiAwal();
        });
        document.querySelector('#btnAdd').addEventListener('click', e => {
            document.querySelector('#modal').innerHTML = modalFormHTML('tambahModal', 'Tambah', 'addConfirm', insertBody());
            $('#tambahModal').modal();
        });
        document.querySelector('#modal').addEventListener('click', e => {
            if(e.target.id == 'addConfirm') {
                validasi(e.target, 1);
            } else if(e.target.id == 'editConfirm') {
                validasi(e.target, 2);
            } else if(e.target.id == 'hapusConfirm') {
                const footer = e.target.parentElement;
                const body = footer.previousElementSibling;
                const id = body.firstElementChild.value;
                fetchData(e.target, `${baseUrl}hapus?id=${id}`);
            }
        });
        function aksiAwal() {
            document.querySelector('#konten').innerHTML = tableAwalHTML();
            dataTableAwal();
        }
        function validasi(target, type) {
            const idEcommerce = document.querySelector('#idEcommerce');
            const namaToko = document.querySelector('#namaToko');
            const url = document.querySelector('#url');
            const data = {
                idEcommerce: idEcommerce.value,
                namaToko: namaToko.value,
                url: url.value,
                id: (type == 1)? '' : document.querySelector('#idTokoEcommerce').value
            };
            if(!data.idEcommerce) {
                idEcommerce.classList.add('is-invalid');
                showSnackError('Harap isi');
            } else if(!data.namaToko) {
                namaToko.classList.add('is-invalid');
                showSnackError('Harap isi');
            } else if(!data.url) {
                url.classList.add('is-invalid');
                showSnackError('Harap isi');
            } else {
                fetchData(target, `${baseUrl}simpan?${new URLSearchParams(data).toString()}&type=${type}`);
            }
        }
        function edit(id) {
            fetch(`${baseUrl}gettoko?id=${id}`)
                .then(res => res.json())
                .then(res => {
                    document.querySelector('#modal').innerHTML = modalFormHTML('editModal', 'Edit', 'editConfirm', insertBody(res.data));
                    $('#editModal').modal();
                })
                .catch(e => console.log(e));
        }
        function hapus(id) {
            fetch(`${baseUrl}gettoko?id=${id}`)
                .then(res => res.json())
                .then(res => {
                    document.querySelector('#modal').innerHTML = modalFormHTML('hapusModal', 'Hapus', 'hapusConfirm', hapusBody(res.data));
                    $('#hapusModal').modal();
                })
                .catch(e => console.log(e));
        }
        function fetchData(btn, url) {
            btn.value = 'Loading...';
            btn.disabled = true;
            fetch(url)
                .then(res => res.json())
                .then(res => {
                    if(res.status_json) {
                        success(res.remarks)
                    } else {
                        btn.innerHTML = 'Gagal, Coba lagi';
                        btn.disabled = false;
                        showSnackError(res.remarks);
                    }
                })
                .catch(e => {
                    console.log(e);
                    btn.innerHTML = 'Gagal, Coba lagi';
                    btn.disabled = false;
                });
        }
        function dataTableAwal() {
            $('#tableAwal').dataTable({
                destroy: true,
                ajax: {
                    url: `${baseUrl}gettoko`,
                    dataSrc: 'data'
                },
                columns: [
                    {"data": 'kode_toko'},
                    {"data": 'nama_ecommerce'},
                    {"data": 'nama_toko'},
                    {"data": 'btn'},
                    {"data": 'id'}
                ],
                "columnDefs": [
                    {
                        "sortable": false,
                        "targets": [3]
                    }
                ],
                "order": [
                    [4, 'desc']
                ],
                "createdRow": (row, data, index) => {
                    $('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(3).addClass('text-center');
                    $('td', row).eq(4).addClass('hidetd');
                }
            });
        }
        function showSnackError(text) {
            iziToast.error({
                title: 'Info',
                message: text,
                position: 'topRight'
            });
        }
        function showSnackSuccess(text) {
            iziToast.success({
                title: 'Info',
                message: text,
                position: 'topRight'
            });
        }
        function success(text) {
            Swal.fire({
                title: 'Info',
                html: text,
                type: "success",
                confirmButtonText: 'Ok',
                confirmButtonColor: "#46b654",
            }).then(result => {
                $('.modal').modal('hide');
                aksiAwal();
            });
        }
        function tableAwalHTML() {
            return `<div class="table-responsive">
                <table class="table table-bordered table-striped" id="tableAwal" style="width: 100%">
                    <thead>
                        <tr class="text-center">
                            <th style="width: 16%">Kode Toko</th>
                            <th style="width: 28%">Nama E-Commerce</th>
                            <th style="width: 28%">Nama Toko</th>
                            <th style="width: 28%"></th>
                            <th class="hidetd">id</th>
                        </tr>
                    </thead>
                </table>
            </div>`;
        }
        function modalFormHTML(id, judul, idBtn, modalBody, aksi = null) {
            return `<div class="modal fade" id="${id}" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${judul}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">${modalBody}</div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button ${(aksi)? `onclick="${aksi}"` : ''} class="btn btn-primary" id="${idBtn}">Konfirmasi</button>
                            <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>`;
        }
        function insertBody(data = '') {
            return `<div class="form-group">
                <div class="row mb-2">
                    ${(data.id)? `<input value="${data.id}" type="hidden" id="idTokoEcommerce">` : ''}
                    <div class="col-md-4">
                        <label for="idEcommerce">E-Commerce</label>
                        <select class="custom-select custom-select-sm" id="idEcommerce">
                            <option value="">Pilih</option>
                            <?php foreach($ecommerce as $e) : ?>
                                <option value="<?= $e['id'] ?>" ${(<?= $e['id'] ?> == data.id_ecommerce)? 'selected' : ''}><?= $e['nama_ecommerce'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="namaToko">Nama Toko</label>
                        <input value="${(data.nama_toko)? data.nama_toko : ''}" type="text" id="namaToko" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <label for="url">URL</label>
                        <textarea class="form-control" id="url" rows="2">${(data.url)? data.url : ''}</textarea>
                    </div>
                </div>
            </div>`;
        }
        function hapusBody(data) {
            return `<input type="hidden" id="idEcommerce" value="${data.id}">
            <p>Apakah anda yakin ingin menghapus toko ${data.nama_toko} dengan kode ${data.kode_toko}?</p>`;
        }
    </script>
</body>
</html>