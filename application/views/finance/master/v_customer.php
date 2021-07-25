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
                                                    <th>Code</th>
                                                    <th>Customer Name</th>
                                                    <th>Inisial Name</th>
                                                    <th>Address</th>
                                                    <th>Phone</th>
                                                    <th></th>
                                                    <th></th>
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
                        <input type="hidden" id="status" class="form-control">
                    <div class="col-sm-6">
                        <div class="section-title" id="title_code"></div>
                        <div class="form-group">
                            <input type="text" class="form-control " id="code" required="">
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_clientname"></div>
                            <input type="text" class="form-control " id="clientname" required="">
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_inisial"></div>
                            <input type="text" class="form-control " id="inisial" required="">
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_address"></div>
                            <input type="text" class="form-control " id="address" required="">
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_phone"></div>
                            <input type="text" class="form-control " id="phone" required="">
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_fax"></div>
                            <input type="text" class="form-control " id="fax" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_email"></div>
                            <input type="email" class="form-control " id="EMail" >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <div class="section-title" id="title_cp"></div>
                            <input type="text" class="form-control " id="cp" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_hp"></div>
                            <input type="text" class="form-control " id="hp" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_npwp"></div>
                            <input type="text" class="form-control " id="npwp" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_tgl_npwp"></div>
                            <input type="text" class="form-control " id="tgl_npwp" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_address_npwp"></div>
                            <input type="text" class="form-control " id="address_npwp" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_accountno"></div>
                            <input type="text" class="form-control " id="accountno" >
                        </div>
                        <div class="form-group">
                        <div class="section-title" id="title_kode_bis"></div>
                             <select id="kode_bis"  class="form-control select2" style="width:100%"></select>
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
            $(document).ready(function() {
                $("#table-menu").dataTable({
                    ajax: {
                        url: '<?= base_url("finance/master/customer/getCustomer") ?>',
                        dataSrc: 'data'
                    },
                    columns: [{
                            "data": 'code',
                        },
                        {
                            "data": 'clientname'
                        },
                        {
                            "data": 'inisial'
                        },
                        {
                            "data": 'address'
                        },
                        {
                            "data": 'phone'
                        },
                        {
                            "data": 'edit'
                        },
                        {
                            "data": 'delete'
                        }
                    ],
                    "columnDefs": [
                        {
                            "sortable": false,
                            "targets": [2, 3]
                        }
                    ]
                });
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
          

              $("#kode_bis").select2({
                    language: {
                        searching: function() {
                            return "Mohon tunggu ...";
                        }
                    },
                    ajax: {
                        url: '<?php echo base_url("finance/master/customer/getBusinessLine") ?>',
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
                                return {id: item.Kode_Bis, text: item.Nama_Bis };
                            });
                            return {
                                results: result
                            };
                        }
                    },
                });
            } );
            var table;

             
            function add(status){
                dataPost = {
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/master/customer/getCustomer") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                             $('#status').val('tambah');
                                document.getElementById("headermodaltambah").innerHTML = "ADD CUSTOMER";
                                document.getElementById("title_code").innerHTML = "Client ID";
                                document.getElementById("title_clientname").innerHTML = "Client Name";
                                document.getElementById("title_address").innerHTML = "Address";
                                document.getElementById("title_phone").innerHTML = "Phone";
                                document.getElementById("title_fax").innerHTML = "Fax";
                                document.getElementById("title_email").innerHTML = "EMail";
                                document.getElementById("title_cp").innerHTML = "CP";
                                document.getElementById("title_hp").innerHTML = "HP";
                                document.getElementById("title_npwp").innerHTML = "NPWP";
                                document.getElementById("title_tgl_npwp").innerHTML = "Tgl NPWP";
                                document.getElementById("title_address_npwp").innerHTML = "Address NPWP";
                                document.getElementById("title_accountno").innerHTML = "AccountNo";
                                document.getElementById("title_inisial").innerHTML = "Inisial";
                                document.getElementById("title_kode_bis").innerHTML = "Businessline";
                                $("#kode_bis").empty()
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

             function edit(ClientID,status){
                document.getElementById("headermodaltambah").innerHTML = "";
                dataPost = {
                    code : ClientID,
                    status : status
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/master/customer/getCustomerbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                             $('#code').val(data[0]['ClientID']);
                             $('#clientname').val(data[0]['ClientName']);
                             $('#inisial').val(data[0]['Inisial']);
                             $('#address').val(data[0]['Address']);
                             $('#phone').val(data[0]['Phone']);
                             $('#address').val(data[0]['Address']);
                             $('#fax').val(data[0]['Fax']);
                             $('#EMail').val(data[0]['EMail']);
                             $('#cp').val(data[0]['CP']);
                             $('#hp').val(data[0]['HP']);
                             $('#npwp').val(data[0]['NPWP']);
                             $('#tgl_npwp').val(data[0]['Tgl_NPWP']);
                             $('#address_npwp').val(data[0]['Address_NPWP']);
                             $('#accountno').val(data[0]['AccountNo']);
                             var $Kode_Bis = $("<option selected></option>").val(data[0]['Kode_Bis']).text(data[0]['Nama_Bis']);
                            $('#kode_bis').append($Kode_Bis).trigger('change');
 
                             $('#status').val('edit');
                                document.getElementById("headermodaltambah").innerHTML = "EDIT CUSTOMER";
                                document.getElementById("title_code").innerHTML = "Client ID";
                                document.getElementById("title_clientname").innerHTML = "Client Name";
                                document.getElementById("title_address").innerHTML = "Address";
                                document.getElementById("title_phone").innerHTML = "Phone";
                                document.getElementById("title_fax").innerHTML = "Fax";
                                document.getElementById("title_email").innerHTML = "EMail";
                                document.getElementById("title_cp").innerHTML = "CP";
                                document.getElementById("title_hp").innerHTML = "HP";
                                document.getElementById("title_npwp").innerHTML = "NPWP";
                                document.getElementById("title_tgl_npwp").innerHTML = "Tgl NPWP";
                                document.getElementById("title_address_npwp").innerHTML = "Address NPWP";
                                document.getElementById("title_accountno").innerHTML = "AccountNo";
                                document.getElementById("title_inisial").innerHTML = "Inisial";
                                document.getElementById("title_kode_bis").innerHTML = "Businessline";
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
                var clientname = $('#clientname').val();
                var address = $('#address').val();
                var inisial = $('#inisial').val();
                var phone = $('#phone').val();
                var fax = $('#fax').val();
                var EMail = $('#EMail').val();
                var cp = $('#cp').val();
                var hp = $('#hp').val();
                var npwp = $('#npwp').val();
                var tgl_npwp = $('#tgl_npwp').val();
                var address_npwp = $('#address_npwp').val();
                var accountno = $('#accountno').val();
                var kode_bis = $('#kode_bis').val();
                var status = $('#status').val();
                 
                if(code == "" || code == null){
                    showSnackError("Harap isi Code");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        code : code,
                        clientname : clientname,
                        address    : address,
                        inisial : inisial,
                        phone : phone,
                        fax : fax,
                        EMail : EMail,
                        cp : cp,
                        hp : hp,
                        npwp : npwp,
                        tgl_npwp : tgl_npwp,
                        address_npwp : address_npwp,
                        accountno : accountno,
                        kode_bis : kode_bis,
                        status : status,
                    }
                    console.log(dataPost);
                    $.ajax({
                        url: '<?php echo base_url("finance/master/customer/saveCustomer") ?>',
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

            function hapus(code){
                dataPost = {
                    code : code
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/master/customer/getCustomerbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#code_hapus').val(data[0]['ClientID']);
                            
                            document.getElementById("headermodalhapus").innerHTML = "Delete Customer  " + data[0]['ClientName'];
                            document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data[0]['ClientName'] + " ?";
                          
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
                        url: '<?php echo base_url("finance/master/customer/deleteCustomer") ?>',
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

            $(document).on('click', '#btn-detail', function() {
                const id = $(this).data('id');
                alert(id)
            })
        </script>
</body>

</html>