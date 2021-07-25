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
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                    <h4><?= $title; ?></h4>
                                    <hr>
                                </div>
                                <div class="card-body row">
                                    <div class="col-sm-4 col-lg-2">
                                        <button class="btn btn-primary" id="btn_add"><i class="fa fa-plus"></i> Add</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-menu" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%">No</th>
                                                    <th style="width: 35%">Kategori</th>
                                                    <th style="width: 35%">Sub Kategori</th>
                                                    <th style="width: 10%"></th>
                                                    <th style="width: 10%"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('layout/v_footer'); ?>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="addSubKategori">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulAdd"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select id="idKategori" class="form-control" style="width:100%">
                            <?php foreach($allKategori as $ak) : ?>
                                <option value="<?= $ak['id']; ?>"><?= $ak['kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <input type="hidden" id="idSubKategori">
                    <div class="form-group">
                        <label for="subKategori">Sub Kategori</label>
                        <input type="text" class="form-control" id="subKategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn_save">SAVE</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="headerModalHapus"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idHapus" class="form-control">
                    <div class="section-title" id='infoHapus'></div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-primary" type="button" id="btnDelete" onclick="return itemHapus()"> Hapus </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function itemHapus(){
            const btn = document.querySelector('#btnDelete');
            const idHapus = document.querySelector('#idHapus').value;
            btn.value = 'Loading...';
            btn.innerHTML = 'Loading...';
            btn.disabled = true;
            dataPost = {
                idHapus : idHapus
            }
            $.ajax({
                url: '<?= base_url('inventory/masterdata/subkategoriitem/hapus') ?>',
                type: 'POST',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    console.log(res)
                    if(res.status_json) {
                        success(res.remarks)
                    } else {
                        btn.value = 'Gagal, Coba lagi';
                        btn.innerHTML = 'Gagal, Coba lagi';
                        btn.disabled = false;
                        showSnackError(res.remarks);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    btn.value = 'Gagal, Coba lagi';
                    btn.innerHTML = 'Gagal, Coba lagi';
                    btn.disabled = false;
                },
                timeout: 60000 
            });
        }
        function hapusModal(id) {
            fetch(`<?= base_url('inventory/masterdata/subkategoriitem/getsubkategoribyid?id=') ?>${id}`)
                .then(response => response.json())
                .then(response => {
                    document.querySelector('#headerModalHapus').innerHTML = `Delete ${response.data.subkategori}`;
                    document.querySelector('#idHapus').value = response.data.id;
                    document.querySelector('#infoHapus').innerHTML = `Are you sure want to delete category ${response.data.subkategori}?`;
                    $('#hapusModal').modal();
                });
        }
        document.querySelector('#btn_add').addEventListener('click', e => {
            addEdit('Add');
        });
        function addEdit(judul, idKategori=null, idSubKategori=null, subKategori=null) {
            document.querySelector('#judulAdd').innerHTML = judul;
            document.querySelector('#idSubKategori').value = idSubKategori;
            document.querySelector('#subKategori').value = subKategori;
            if(idKategori) document.querySelector('#idKategori').value = idKategori;
            showLoading();
            dismisLoading();
            $('#addSubKategori').modal();
        }
        document.querySelector('#btn_save').addEventListener('click', e => {
            const judul = document.querySelector('#judulAdd').innerHTML;
            const idSubKategori = document.querySelector('#idSubKategori').value;
            const subKategori = document.querySelector('#subKategori').value;
            const idKategori = document.querySelector('#idKategori').value;
            if(judul == 'Add') {
                (!subKategori)? showSnackError('Harap diisi') : postData(judul, subKategori, idKategori);
            } else {
                (!subKategori && !id)? showSnackError('Harap diisi') : postData(judul, subKategori, idKategori, idSubKategori);
            }
        });
        function postData(judul, subKategori, idKategori, idSubKategori=null) {
            const btn = document.querySelector('#btn_save');
            dataPost = {
                judul: judul,
                subKategori: subKategori,
                idKategori: idKategori,
                idSubKategori: idSubKategori
            }
            showLoading();
            $.ajax({
                url: '<?= base_url('inventory/masterdata/subkategoriitem/simpan') ?>',
                type: 'post',
                dataType: 'json',
                data: dataPost,
                success: function(res) {
                    if(res.status_json) {
                        success(res.remarks);
                        dismisLoading();
                    } else {
                        btn.value = 'SAVE';
                        btn.innerHTML = 'SAVE';
                        btn.disabled = false;
                        showSnackError(res.remarks);
                        dismisLoading();
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    showSnackError(textStatus);
                    btn.value = 'Gagal, Coba lagi';
                    btn.innerHTML = 'Gagal, Coba lagi';
                    btn.disabled = false;
                    dismisLoading();
                },
                timeout: 60000
            })
        }
        $(document).ready(function() {
            $('#table-menu').dataTable({
                destroy: true,
                ajax: {
                    url: '<?= base_url('inventory/masterdata/subkategoriitem/getallsubkategori') ?>',
                    dataSrc: 'data'
                },
                columns: [
                    {"data": 'no'},
                    {"data": 'kategori'},
                    {"data": 'subkategori'},
                    {"data": 'edit'},
                    {"data": 'hapus'}
                ],
                "columnDefs": [
                    {
                        "sortable": false,
                        "targets": [3, 4]
                    }
                ]
            });
            var csfrData = {};
            csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
            $.ajaxSetup({
                data: csfrData
            });
        });

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
            }).then((result) => {
                location.reload(true);
            })
        }
    </script>
</body>
</html>