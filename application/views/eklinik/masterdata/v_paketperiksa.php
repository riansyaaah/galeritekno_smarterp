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
                                        <h4><?=$title;?></h4>
                                        <hr>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-sm-4">
                                            <a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahPaket()">Paket Baru</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-striped" id="table-menu">
                                                <thead>
                                            <tr>
                                                <th>Nama Paket</th>
                                                <th>Keterangan</th>
                                                <th>Harga Umum</th>
                                                <th>Harga Corporate</th>
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
<div class="modal fade" id="tambahPaket" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Paket Pemeriksaan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                                    <label for="useremail">Nama</label>
                                    <input type="text" class="form-control form-control-sm" id="namapaket" required="">
                                </div>
                        <div class="form-group">
                                    <label for="useremail">Keterangan</label>
                                    <input type="text" class="form-control form-control-sm" id="keterangan" required="">
                                </div>
                        <div class="form-group">
                                    <label for="useremail">Harga Umum</label>
                                    <input type="number" class="form-control form-control-sm" id="hargaumum" required="">
                                </div>
                        <div class="form-group">
                                    <label for="useremail">Harga Corporate</label>
                                    <input type="number" class="form-control form-control-sm" id="hargacorporate" required="">
                                </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return itemBaru()">
                                                            SIMPAN
                                                        </button>
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
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?php echo base_url("eklinik/masterdata/getPaketperiksa") ?>',
                        dataSrc: 'data'
                    },
                    columns: [
                        { 
                            "data": 'namapaket',
                        },
                        { 
                            "data": 'keterangan' 
                        },
                        { 
                            "data": 'hargaumum' 
                        },
                        { 
                            "data": 'hargacorporate' 
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

            function tambahPaket(){
                dismisLoading();
                            $("#tambahPaket").modal();
            }
            
            function itemBaru(){
                var btn = document.getElementById("btnItemBaru");
                var namapaket = $('#namapaket').val();
                var keterangan = $('#keterangan').val();
                var hargaumum = $('#hargaumum').val();
                var hargacorporate = $('#hargacorporate').val();
                 
                if(namapaket == "" || hargaumum == null){
                    showSnackError("Harap isi");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        namapaket : namapaket,
                        keterangan : keterangan,
                        hargaumum : hargaumum,
                        hargacorporate : hargacorporate,
                    }
                    $.ajax({
                        url: '<?php echo base_url("eklinik/masterdata/addPaketperiksa") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                success(res.remarks)
                            }else{
                                btn.value = 'SIMPAN';
                                btn.innerHTML = 'SIMPAN';
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