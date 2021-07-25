<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?=$title;?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
        <link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
        <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
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
                                        <h4><?=$title;?>
                                            <p>
                                            <button type="button" class="btn-sm btn-primary" onClick="add()"><i class="fa fa-plus"> Add</i></button>
                                        </h4>
                                        <hr>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-bordered table-hover" id="table-unit">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Unit</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <section>
                </div>
                <?php $this->load->view('layout/v_footer');?>
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="section-title" id="title_unit"></div>
                                    <input type="hidden" id="status" class="form-control">
                                    <input type="text" class="form-control" id="Unit" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button class="btn btn-primary" type="button" id="btnItemSave" onclick="return saveUnit()">
                            SAVE
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"  id='headermodalhapus'></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="code_hapus" class="form-control">
                            <div class="section-title" id='infohapus'></div>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button class="btn btn-primary" type="button" id="btnDelete" onclick="return itemHapus()"> Delete </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

        <script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/datatables.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
        <script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>

        <script>
            $(document).ready(function() {
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });

                $("#table-unit").dataTable({
                    ajax: {
                        url: '<?= base_url("finance/generalsetting/unit/getUnit") ?>',
                        dataSrc: 'data'
                    },
                    
                    columns: [
                        { 
                            "data": 'no',
                        },
                        { 
                            "data": 'Unit',
                        },
                        { 
                            "data": 'option'
                        }
                    ],
                    "columnDefs": [
                        { "sortable": false, "targets": [1, 2] }
                    ]
                });
            });

            function add(status)
            {
                dataPost = {
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("finance/generalsetting/Unit/getUnit") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                             $('#status').val('tambah');
                                document.getElementById("headermodaltambah").innerHTML = "ADD UNIT";
                                document.getElementById("title_unit").innerHTML = "UNIT";
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

            function saveUnit(){
                var btn = document.getElementById("btnItemSave");
                var Unit = $('#Unit').val();
                var status = $('#status').val();
                 
                if(Unit == "" || Unit == null){
                    showSnackError("Harap isi Unit");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        Unit : Unit,
                        status : status,
                    }
                    $.ajax({
                        url: '<?= base_url("finance/generalsetting/unit/saveUnit") ?>',
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

            function hapus(Unit){
                dataPost = {
                    Unit : Unit
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/generalsetting/unit/getUnitbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#code_hapus').val(data[0]['Unit']);
                            
                            document.getElementById("headermodalhapus").innerHTML = "Delete Unit  " + data[0]['Unit'];
                            document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data[0]['Unit'] + " ?";
                          
                            dismisLoading();
                            $("#hapusModal").modal();
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
                });
            }

            function itemHapus(){
                var btn = document.getElementById("btnDelete");
                var code_hapus = $('#code_hapus').val();
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        code_hapus : code_hapus,
                    }
                    $.ajax({
                        url: '<?php echo base_url("finance/generalsetting/unit/deleteUnit") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
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

            function showSnackError(text){
                iziToast.error({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function showSnackSuccess(text){
                iziToast.success({
                    title: 'Info',
                    message: text,
                    position: 'topRight'
                });
            }

            function success(text){
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