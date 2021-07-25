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

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-striped" id="table-menu">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Client Name</th>
                                                        <th>Address</th>
                                                        <th>Fax</th>
                                                        <th>Email</th>
                                                        <th>HP</th>
                                                        <th>Tanggal NPWP</th>
                                                        <th>NPWP</th>
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
                <div class="modal fade" id="tambahDetail" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="headermodaldetail"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body row">
                                <input type="hidden" id="client_id" class="form-control"> 
                                <div class="col-md-4">   
                                    <div class="form-group">
                                        <div class="section-title" id="title_client_name"></div>
                                        <input type="text" class="form-control" id="client_name" readonly>
                                    </div>
                                </div>	
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_address"></div>
                                        <input type="text" class="form-control" id="address" readonly>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_phone"></div>
                                        <input type="text" class="form-control" id="phone" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_email"></div>
                                        <input type="text" class="form-control" id="email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_fax"></div>
                                        <input type="text" class="form-control" id="fax" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_cp"></div>
                                        <input type="text" class="form-control" id="cp" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_hp"></div>
                                        <input type="text" class="form-control" id="hp" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_tgl_npwp"></div>
                                        <input type="text" class="form-control" id="tgl_npwp" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_npwp"></div>
                                        <input type="text" class="form-control" id="npwp" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="section-title" id="title_address_npwp"></div>
                                        <input type="text" class="form-control" id="address_npwp" readonly>
                                    </div>
                                </div>
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
                        url: '<?php echo base_url("eklinik/mcu/datacorporate/getCorporate") ?>',
                        dataSrc: 'data'
                    },
                    columns: [
                        { 
                            "data": 'no',
                        },
                        { 
                            "data": 'client_name' 
                        },
                        { 
                            "data": 'address' 
                        },
                        { 
                            "data": 'fax' 
                        },
                        { 
                            "data": 'email' 
                        },
                        { 
                            "data": 'hp' 
                        },
                        { 
                            "data": 'tgl_npwp' 
                        },
                        { 
                            "data": 'npwp' 
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

            function detail(client_id)
            {
                document.getElementById("headermodaldetail").innerHTML = "";
                dataPost = {
                    client_id : client_id
                }
                showLoading();
                $.ajax({
                    url: '<?= base_url("eklinik/mcu/datacorporate/getCorporatebyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#client_id').val(data[0]['ClientID']);
                            $('#client_name').val(data[0]['ClientName']);
                            $('#address').val(data[0]['Address']);
                            $('#phone').val(data[0]['Phone']);
                            $('#email').val(data[0]['EMail']);
                            $('#fax').val(data[0]['Fax']);
                            $('#cp').val(data[0]['CP']);
                            $('#hp').val(data[0]['HP']);
                            $('#tgl_npwp').val(data[0]['Tgl_NPWP']);
                            $('#npwp').val(data[0]['NPWP']);
                            $('#address_npwp').val(data[0]['Address_NPWP']);
                                document.getElementById("headermodaldetail").innerHTML = "DETAIL MASTER DATA PERAWAT";
                                document.getElementById("title_client_name").innerHTML = "Client Name";
                                document.getElementById("title_address").innerHTML = "Address";
                                document.getElementById("title_phone").innerHTML = "Phone";
                                document.getElementById("title_email").innerHTML = "Email";
                                document.getElementById("title_fax").innerHTML = "Fax";
                                document.getElementById("title_cp").innerHTML = "CP";
                                document.getElementById("title_hp").innerHTML = "HP";
                                document.getElementById("title_tgl_npwp").innerHTML = "Tanggal NPWP";
                                document.getElementById("title_npwp").innerHTML = "NPWP";
                                document.getElementById("title_address_npwp").innerHTML = "Address NPWP";
                             dismisLoading();
                             $("#tambahDetail").modal();
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
