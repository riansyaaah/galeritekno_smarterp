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
                                        <h4>
                                            <?=$title;?>
                                            <p>
                                            <button class="btn-sm btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add</button>
                                        </h4>
                                        <hr>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-striped" id="table-menu">
                                                <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Poli</th>
                                                <th>Dokter</th>
                                                <th>Keterangan</th>
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
                                <input type="hidden" id="id" class="form-control">
                                <input type="hidden" id="status" class="form-control">
                                <div class="col-md-6">   
                                    <div class="form-group">
                                        <div class="section-title" id="title_nama"></div>
                                        <input type="text" class="form-control" id="nama" required="">
                                    </div>
                                </div>	
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="section-title" id="title_dokter"></div>
                                        <select id="dokter_id" class="form-control">
                                            <?php foreach ($list_dokter as $data) { ?>
                                                <option value="<?= $data['id'];?>"><?= $data['nama'];?></option>
                                            <?php } ?>    
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="section-title" id="title_keterangan"></div>
                                        <input type="text" class="form-control" id="keterangan" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button class="btn btn-primary" type="button" id="btnItemSave" onclick="return saveitem()">
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
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?php echo base_url("eklinik/masterdata/getPoliklinik") ?>',
                        dataSrc: 'data'
                    },
                    columns: [
                        { 
                            "data": 'no',
                        },
                        { 
                            "data": 'nama' 
                        },
                        { 
                            "data": 'dokter_id' 
                        },
                        { 
                            "data": 'keterangan' 
                        },
                        { 
                            "data": 'option' 
                        }
                    ],
                    "columnDefs": [
                        { "sortable": false, "targets": [2, 3] }
                    ]
                });
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
            });

            function add(status){
                dataPost = {
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/masterdata/getPoliklinik") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                             $('#status').val('tambah');
                                document.getElementById("headermodaltambah").innerHTML = "ADD MASTER DATA POLIKLINIK";
                                document.getElementById("title_nama").innerHTML = "Nama Poli";
                                document.getElementById("title_dokter").innerHTML = "Dokter";
                                document.getElementById("title_keterangan").innerHTML = "Keterangan";
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

            function saveitem()
            {
                var btn = document.getElementById("btnItemSave");
                var id = $('#id').val();
                var nama = $('#nama').val();
                var dokter_id = $('#dokter_id').val();
                var keterangan = $('#keterangan').val();
                var status = $('#status').val();
                if(nama == "" || nama == null){
                    showSnackError("Harap isi Nama");
				}else if(dokter_id == "" || dokter_id == null){
                    showSnackError("Harap isi Dokter");	
				}else if(keterangan == "" || keterangan == null){
                    showSnackError("Harap isi Keterangan"); 		
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        id : id,
                        nama : nama,
                        dokter_id : dokter_id,
                        keterangan : keterangan,
                        status : status,
                    }
                    $.ajax({
                        url: '<?= base_url("eklinik/masterdata/savePoliklinik") ?>',
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

            function edit(id,status)
            {
                document.getElementById("headermodaltambah").innerHTML = "";
                dataPost = {
                    id : id,
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/masterdata/getPoliklinikbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#id').val(data[0]['id']);
                            $('#nama').val(data[0]['nama']);
                            $('#dokter_id').val(data[0]['dokter_id']);
                            $('#keterangan').val(data[0]['keterangan']);
                            $('#status').val('edit');
                                document.getElementById("headermodaltambah").innerHTML = "EDIT MASTER DATA POLIKLINIK";
                                document.getElementById("title_nama").innerHTML = "Nama Poli";
                                document.getElementById("title_dokter").innerHTML = "Dokter";
                                document.getElementById("title_keterangan").innerHTML = "Keterangan";
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

            function hapus(id)
            {
                dataPost = {
                    id : id
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/masterdata/getPoliklinikbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#code_hapus').val(data[0]['id']);
                            
                            document.getElementById("headermodalhapus").innerHTML = "Delete Poliklinik  ";
                            document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : ";
                          
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

            function itemHapus()
            {
                var btn = document.getElementById("btnDelete");
                var code_hapus = $('#code_hapus').val();
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        code_hapus : code_hapus,
                    }
                    $.ajax({
                        url: '<?= base_url("eklinik/masterdata/deletePoliklinik") ?>',
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