<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
    <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <style>

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
                                    <h4><?= $title; ?></h4>
                                    <hr>
                                </div>

                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                        <table class="table table-striped" id="table-menu">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Valuta</th>
                                                    <th>Desc</th>
                                                    <th>Rate</th>
                                                    <th>Active Periode</th>
                                                    <th>Instansi</th>
                                                    <th>Branch</th>
                                                    <th>#</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <section>
            </div>
            <?php $this->load->view('layout/v_footer'); ?>
        </div>
        <div class="modal fade" id="tambahModal" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="headermodaltambah"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                        <div class="modal-body row">
                            <input type="hidden" id="code" class="form-control">
                            <input type="hidden" id="activeperiode" class="form-control">
                            <input type="hidden" id="status" class="form-control">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="section-title" >Valuta</div>
                                    <input type="text" class="form-control" id="valuta" required="">
                                </div>
                                <div class="form-group">
                                    <div class="section-title" >Description</div>
                                    <input type="text" class="form-control" id="description" required="">
                                </div>
                                <div class="form-group">
                                    <div class="section-title" >Rate</div>
                                    <input type="text" class="form-control" id="rate" required="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="section-title" >Instansi</div>
                                       <select id="instansi_id" onchange="onChangeInstansi()"  class="form-control select2" style="width:100%"></select>
                                    </div>
                                <div class="form-group">
                                    <div class="section-title" >Branch</div>
                                       <select id="branch_id"  class="form-control select2" style="width:100%"></select>
                                    </div>
                                </div>
                            </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return save()">
                            SAVE
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            
        <script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js'); ?>"></script>

        <script>
            const rupiah = document.querySelector('#rate');
            rupiah.addEventListener('keyup', function(e){
                rupiah.value = formatRupiah(this.value);
            });
            function formatRupiah(angka){
                let number_string = angka.replace(/[^,\d]/g, '').toString(),
                split           = number_string.split(','),
                sisa            = split[0].length % 3,
                rupiah          = split[0].substr(0, sisa),
                ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
                if(ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return rupiah;
            }
            $(document).ready(function() {
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?php echo base_url("finance/generalsetting/currency/getCurrency") ?>',
                        dataSrc: 'data'
                    },
                    columns: [{
                            "data": 'no',
                        }, 
                        {
                            "data": 'valuta',
                        },
                        {
                            "data": 'description'
                        },
                        {
                            "data": 'rate'
                        },
                        {
                            "data": 'activeperiode'
                        },
                        {
                            "data": 'instansi_id'
                        },
                        {
                            "data": 'branch_id'
                        },
                        {
                            "data": 'option'
                        }
                    ],
                    "columnDefs": [{
                        "sortable": false,
                        "targets": [2, 3]
                    }]
                });
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });

                $("#instansi_id").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("finance/generalsetting/currency/getInstansi") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                            }; 
                        },
                        processResults: function (res, params) {
                            var result = res.data.map(function (item) {
                                return {id: item.instansi_id, text: item.nama_instansi };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });

                $("#branch_id").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("finance/generalsetting/currency/getBranch") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term,
                                 instansi_id : $('#instansi_id').val()
                            }; 
                        },
                        processResults: function (res, params) {
                            var result = res.data.map(function (item) {
                                return {id: item.branch_id, text: item.nama_branch };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            });

            function onChangeInstansi(){
                $("#branch_id").empty().trigger('change')
            }

             
           function add(){
                document.getElementById('status').value = "tambah"
                document.getElementById('code').value = ""
                document.getElementById('valuta').value = ""
                document.getElementById('description').value = ""
                document.getElementById('activeperiode').value = ""
                document.getElementById("headermodaltambah").innerHTML = 'ADD CURRENCY';
                $("#instansi_id").empty().trigger('change')
                $("#branch_id").empty().trigger('change')
                $("#tambahModal").modal();
            }

            

            function edit(id){
                document.getElementById("headermodaltambah").innerHTML = "EDIT CURRENCY";
                dataPost = {
                    id : id
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/generalsetting/currency/getCurrencybyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#code').val(data[0]['id']);
                             $('#valuta').val(data[0]['Valuta']);
                             $('#description').val(data[0]['Desc']);
                             $('#rate').val(data[0]['Rate']);
                             
                             var $Instansi_id = $("<option selected></option>").val(data[0]['instansi_id']).text(data[0]['nama_instansi']);
                            $('#instansi_id').append($Instansi_id).trigger('change');
                            var $Branch_id = $("<option selected></option>").val(data[0]['branch_id']).text(data[0]['nama_branch']);
                            $('#branch_id').append($Branch_id).trigger('change');
                            $('#status').val('edit');
                             dismisLoading();
                             $("#tambahModal").modal();
                        }else{
                            showSnackError(res.remarks);
                            dismisLoading();
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown){
                        showSnackError(XMLHttpRequest);
                        dismisLoading();
                    },
                    timeout: 60000 
                })
            } 

            
            function save(){
                var btn = document.getElementById("btnItemBaru");
                var code = $('#code').val();
                var description = $('#description').val();
                var valuta = $('#valuta').val();
                var rate = $('#rate').val();
                var instansi_id = $('#instansi_id').val();
                var branch_id = $('#branch_id').val();
                var status = $('#status').val();
                 
                if(valuta == "" || valuta == null){
                    showSnackError("Harap isi Valuta");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        code : code,
                        description : description,
                        valuta : valuta,
                        rate : rate,
                        instansi_id : instansi_id,
                        branch_id : branch_id,
                        status : status,
                    }
                    console.log(dataPost);
                   
                    $.ajax({
                        url: '<?= base_url("finance/generalsetting/currency/saveCurrency") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'SAVE';
                                btn.innerHTML = 'SAVE';
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
            }


        

            function showSnackError(text){
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

            $(document).on('click', '#btn-detail', function() {
                const id = $(this).data('id');
                alert(id)
            })
        </script>
</body>

</html>