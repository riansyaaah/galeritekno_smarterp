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
                                                        <th>Account</th>
                                                        <th>Deskription</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                        <th>#</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <span><b>Sum Of Debit <?php echo number_format($sumofdebit,0);?> </b><br><b>Sum Of Kredit <?php echo number_format($sumofkredit,0);?> </b></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <section>
                </div>
                <?php $this->load->view('layout/v_footer');?>
            </div>
<div class="modal fade" id="editOpeningbalance" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" class="form-control form-control-sm" id="status" required="">
                            <div class="form-group">
                                    <label for="useremail">ACCOUNT NO</label>
                                    <input type="text" class="form-control form-control-sm" id="accountno" required="">
                                    
                                </div>
                        <div class="form-group">
                                    <label for="useremail">ACCOUNT NAME</label>
                                    <input type="text" class="form-control form-control-sm" id="accountname" required="">
                                </div>
                        <div class="form-group">
                                    <label for="useremail">AMOUNT</label>
                                    <input type="text" class="form-control form-control-sm" id="amount" required="">
                                </div>
                        <div class="form-group mb-0 row">
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
                      <input type="radio" id="ra_debit" name="customRadio" class="custom-control-input">
                      <label class="custom-control-label" for="ra_debit">DEBIT</label>
                    </div>
                                                    <div class="custom-control custom-radio">
                      <input type="radio" id="ra_kredit" name="customRadio" class="custom-control-input">
                      <label class="custom-control-label" for="ra_kredit">KREDIT</label>
                    </div>
                                                </div>
                                            </div> <!--end row-->    
                        
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnItemEdit" onclick="return openingbalanceEdit()">
                                                            Update
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
                        url: '<?php echo base_url("finance/Openingbalance/getAccount") ?>',
                        dataSrc: 'data'
                    },
                    
                    columns: [
                        { 
                            "data": 'account',
                        },{ 
                            "data": 'description',
                        },
                        { 
                            "data": 'debit' 
                        },
                        { 
                            "data": 'credit' 
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

            function editOpeningbalance(code){
                
                dataPost = {
                    code : code
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/openingbalance/getOpeningbalancebyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                                
                            $('#accountno').val(data[0]['AccountNo']);
                            $('#accountname').val(data[0]['AccountName']);
                            if(parseInt(data[0]['SaldoDebet']) > parseInt(data[0]['SaldoKredit'])){
                                $('#amount').val(data[0]['SaldoDebet']);
                                radiobtn = document.getElementById("ra_debit");
                            }else{
                                $('#amount').val(data[0]['SaldoKredit']);
                                radiobtn = document.getElementById("ra_kredit");
                            }
                            
                            radiobtn.checked = true;
                            
                            dismisLoading();
                            $("#editOpeningbalance").modal();
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
             function cashbankEdit(){
                var btn = document.getElementById("btnItemEdit");
                var code_edit = $('#code_edit').val();
                var cashbank_edit = $('#cashbank_edit').val();
                var ac_edit = $('#acv').val();
                var currency_edit = $('#currency_edit').val();
                var account_edit = $('#itemAccountNo').val();
                var status = $('#status').val();
                 
                if(cashbank_edit == "" || cashbank_edit == null){
                    showSnackError("Harap isi");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        code : code_edit,
                        cashbank : cashbank_edit,
                        ac : ac_edit,
                        currency : currency_edit,
                        account : account_edit,
                        status : status,
                    }
                    $.ajax({
                        url: '<?php echo base_url("finance/masterdata/editCashbank") ?>',
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