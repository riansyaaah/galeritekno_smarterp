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
                                        <div class="col-sm-6">
                                            <div class="section-title">Choose Department</div>
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <select id="Kode_Dep" class="form-control select2" style="width:75%"></select>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-info" type="button" id="btnShowAkses" onclick="showAkses()">
                                                            PILIH
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                        <div class="loader" style="display:block"></div>
                                            <table class="table table-striped" id="table-menu">
                                                <thead>
                                                    <tr>
                                                        <th style="width:250px; text-align:center;" id="kode_person">Code</th>
                                                        <th id="nama_person">Person Name</th>
                                                        <th id="inisial">Inisial</th>
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
                });
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
                
                $("#Kode_Dep").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("finance/master/person/getDepartement") ?>',
                        dataType: 'json',
                        type: "GET",
                        delay: 250,
                        data: function (params) {
                            return {
                                search: params.term
                            };
                        },
                        processResults: function (res, params) {
                            var result = res.data.map(function (item) {
                                return {id: item.Kode_Dep, text: item.Nama_Dep };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            } );
            var table;

            function showAkses(){
                var Kode_Dep = $('#Kode_Dep').val();
                if(Kode_Dep == "" || Kode_Dep == null){
                    showSnackError("Harap Pilih Department");
                }else{
                    showLoading();
                    $.ajax({
                        url: '<?php echo base_url("finance/master/person/getPersonAccess?Kode_Dep=") ?>'+Kode_Dep,
                        type: 'GET',
                        dataType: 'json',
                        success: function(res){
                            table = $('#table-menu').DataTable();
                            console.log(res)
                            if(res.status_json){
                                table.clear();
                                data = res.data;
                                counts = res.data.length;
                                for (var i = 0; i < counts; i++) {
                                    table.row.add([ 
                                        data[i].Kode_Person,
                                        data[i].Nama_Person,
                                        data[i].Inisial,
                                        
                                    ]);
                                }
                                table.draw();
                                dismisLoading();
                            }else{
                                showSnackError(res.remarks);
                                dismisLoading();
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown){
                            showSnackError("Error Sistem");
                            dismisLoading();
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