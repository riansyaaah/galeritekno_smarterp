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
                                            <a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahReservasi()">Reservasi Baru</a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-striped" id="table-menu">
                                                <thead>
                                                    <tr>
                                                        <th style="width:100px">No. Invoice</th>
                                                        <th>Waktu Kunjungan</th>
                                                        <th style="width:100px">Homecare<br>Corporate</th>
                                                        <th>Customer</th>
                                                        <th style="width:150px">Paket Pemeriksaan</th>
                                                        <th style="width:100px">Total Harga</th>
                                                        <th style="width:100px">Status Proses</th>
                                                        <th style="width:100px">Status Transaksi</th>
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
        <div class="modal fade" id="tambahReservasi" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Input Data Reservasi Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control form-control-sm" id="nama" required="">
                            </div>
                            <div class="form-group">
                                <label for="nomorhp">No. HP</label>
                                <input type="text" class="form-control form-control-sm" id="nomorhp" required="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control form-control-sm" id="email" required="">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control form-control-sm" id="alamat" required="">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalkunjungan">Tanggal Kunjungan</label>
                                        <input type="date" class="form-control form-control-sm" id="tanggalkunjungan" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jamkunjungan">Jam Kunjungan</label>
                                        <input type="time" class="form-control form-control-sm" id="jamkunjungan" required="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tipe">Client Type</label>
                                <select class="form-control form-control-sm" id="tipe">
                                    <option value="General">General</option>
                                    <option value="Corporate">Corporate</option>
                                </select>
                            </div>
                            <label for="tipe">List Paket Pemeriksaan</label>
                            <div class="repeater-default">
                                <div data-repeater-list="car">
                                    <div data-repeater-item="">
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col-sm-5">
                                                <label class="control-label">Paket </label>
                                                <select id="paket[]" class="form-control">
                                                    <?php foreach($list_paket as $app){?>
                                                    <option value="<?=$app['id'];?>"><?=$app['namapaket'];?></option>
                                                    <?php } ?>
                                                </select>
                                            </div><!--end col-->
                                            
                                            <div class="col-sm-5">
                                                <label class="control-label">Jumlah</label>
                                                <input type="text" id="jumlah[]" value="10" class="form-control" onkeypress='validate(event)'>
                                            </div><!--end col-->
                                
                                            <div class="col-sm-1">
                                                <span data-repeater-delete="" class="btn btn-danger btn-sm">
                                                    <span class="far fa-trash-alt mr-1"></span> Delete
                                                </span>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div><!--end /div-->
                                </div>
                                <div class="form-group mb-0 row">
                                    <div class="col-sm-12">
                                        <span data-repeater-create="" class="btn btn-primary btn-sm">
                                            <span class="fas fa-plus"></span> Add
                                        </span>
                                    </div>
                                </div>                                      
                            </div>    
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return itemBaru()"> SIMPAN </button>
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
                    
        <script src="<?php echo base_url('assets/template/js/jquery.repeater.min.js');?>"></script>
        <script src="<?php echo base_url('assets/template/js/jquery.form-repeater.js');?>"></script>

        <script>
            $(document).ready(function() {
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?php echo base_url("eklinik/frontoffice/homecare/getHomecare") ?>',
                        dataSrc: 'data'
                    },
                    
                    columns: [
                        { 
                            "data": 'noinvoice',
                        },
                        { 
                            "data": 'waktukunjungan' 
                        },
                        { 
                            "data": 'corporate' 
                        },
                        { 
                            "data": 'detailcustomer' 
                        },
                        { 
                            "data": 'paket' 
                        },
                        { 
                            "data": 'totalharga' 
                        },
                        { 
                            "data": 'statusproses' 
                        },
                        { 
                            "data": 'statustransaksi' 
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

            function tambahReservasi(){
                dataPost = {
                    id_paren : '1'
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("eklinik/frontoffice/homecare/getPaketperiksa") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            dismisLoading();
                            $("#tambahReservasi").modal();
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

            function itemBaru(){
                var tipe = $('#tipe').val();
                var nama = $('#nama').val();
                var nomorhp = $('#nomorhp').val();
                var email = $('#email').val();
                var alamat = $('#alamat').val();
                var tanggalkunjungan = $('#tanggalkunjungan').val();
                var jamkunjungan = $('#jamkunjungan').val();

                var paket = $('select[id="paket[]"]').map(function(){ return this.value; }).get();
                var jumlah = $('input[id="jumlah[]"]').map(function(){ return this.value; }).get();

                if(tipe == "" || tipe == null){
                    showSnackError("Harap Pilih Client Type");
                }else if(nama == "" || nama == null){
                    showSnackError("Harap isi Nama");
                }else if(email == "" || email == null){
                    showSnackError("Harap isi Email");
                }else if(alamat == "" || alamat == null){
                    showSnackError("Harap isi Alamat");
                }else if(tanggalkunjungan == "" || tanggalkunjungan == null){
                    showSnackError("Harap isi Tanggal Kunjungan");
                }else if(jamkunjungan == "" || jamkunjungan == null){
                    showSnackError("Harap isi Jam Kunjungan");
                }else if(paket.length == 0){
                    showSnackError("Harap isi List Pemeriksaan");
                }else{
                    var btn = document.getElementById("btnItemBaru");
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;

                    dataPost = {
                        tipe : tipe,
                        nama : nama,
                        nomorhp : nomorhp,
                        email : email,
                        alamat : alamat,
                        tanggalkunjungan : tanggalkunjungan,
                        jamkunjungan : jamkunjungan,
                        paket : paket,
                        jumlah : jumlah
                    }
                    $.ajax({
                        url: '<?php echo base_url("eklinik/frontoffice/homecare/itemBaru") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                data = res.data;
                                $("#tambahReservasi").modal("hide");
                                btn.value = 'SIMPAN';
                                btn.innerHTML = 'SIMPAN';
                                success(res.remarks)
                            }else{
                                showSnackError(res.remarks);
                                btn.value = 'Error, Coba lagi!';
                                btn.innerHTML = 'Error, Coba lagi!';
                            }
                            btn.disabled = false;
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            showSnackError(XMLHttpRequest);
                            btn.value = 'Error, Coba lagi!';
                            btn.innerHTML = 'Error, Coba lagi!';
                            btn.disabled = false;
                        },
                        timeout: 60000 
                    });
                }
            }

            function validate(evt) {
                var theEvent = evt || window.event;
                if (theEvent.type === 'paste') {
                    key = event.clipboardData.getData('text/plain');
                } else {
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode(key);
                }
                var regex = /[0-9]|\./;
                if( !regex.test(key) ) {
                    theEvent.returnValue = false;
                    if(theEvent.preventDefault) theEvent.preventDefault();
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