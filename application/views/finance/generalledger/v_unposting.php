<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?=$title;?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet"
		href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet"
		href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
</head>

<body>
	<div class="loader"></div>
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<section class="section">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4><?= $title;?></h4>
								</div>
								<div class="card-body row">
									<div class="col-lg-6">

										<div class="form-group row">
											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Mulai Tanggal:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="mulai_tanggal" type="date">
											</div>

											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Sampai Tanggal:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="sampai_tanggal"
													type="date">
                                                <button type="button" class="btn  btn-primary btn-sm" id="btn_Unposting" onclick="Unposting()">Unposting</button>
                                                <button type="button" class="btn  btn-primary btn-sm" id="btn_filter" onclick="Filter()">Filter</button>
											</div>
                                            
										</div>

									</div>
                                    <div class="col-lg-4">

										<div class="form-group">
											<div class="col-md-12">
												<label for="exampleInputPassword1">Transaction</label>
                                                <div class="custom-control custom-radio">
                      <input type="radio" id="idcashbank" name="idtable" class="custom-control-input" value="1" checked>
                      <label class="custom-control-label" for="idcashbank">Cash and Bank</label>
                    </div>
                                            </div>
										</div>

										
									</div>
								</div>
                                <div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped" id="table-detail-payment">
											<thead>
												<tr>
								<th class="text-center">Transaction No</th>
								<th class="text-center">Transaction Date</th>
								<th class="text-center">Transaction Type</th>
								<th class="text-center">Bank Code</th>
								<th class="text-center">Bank Name</th>
								<th class="text-center">Description</th>
								<th class="text-center">Amount</th>
								<th class="text-center">#</th>
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
			<!-- basic modal -->
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		</div>
		<div class="modal fade" id="voucherUnposting" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"  id='headerUnposting'></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="VoucherNo_hapus" class="form-control">
                        <div class="section-title" id='infoUnposting'></div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button class="btn btn-primary" type="button" id="btnUnposting" onclick="return UnpostingVoucher()"> Unposting </button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>  
		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script
			src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>">
		</script>
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
                var csfrData = {};
                csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
                $.ajaxSetup({
                    data: csfrData
                });
            });
            function Filter() {
			showLoading();
			mulai_tanggal = document.getElementById("mulai_tanggal").value;
			sampai_tanggal = document.getElementById("sampai_tanggal").value;
			dataPost = {
				mulai_tanggal: mulai_tanggal,
				sampai_tanggal: sampai_tanggal,
			}
			$("#table-detail-payment").dataTable({
							destroy: true,
							ajax: {
								url: '<?php echo base_url("finance/generalledger/Unposting/getDataUnposting") ?>',
								dataSrc: 'data',
								type: 'POST',
								dataType: 'json',
								data: dataPost,
							},
							columns: [{
						"data": 'VoucherNo',
					},
					{
						"data": 'VoucherDate',
					},
                    {
						"data": 'transactype',
					},                  
					{
						"data": 'BankCode'
					},
					{
						"data": 'BankName'
					},
					{
						"data": 'Description'
					},
                    {
						"data": 'Amount'
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
						dismisLoading();

		}
            function UnpostingItem(VoucherNo){
                dataPost = {
                    VoucherNo : VoucherNo
                }
                showLoading();
                $.ajax({
                    url: '<?php echo base_url("finance/generalledger/Unposting/getDatavoucher") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#VoucherNo_hapus').val(data[0]['VoucherNo']);
                            
                            document.getElementById("headerUnposting").innerHTML = "Unposting Voucher No : " + data[0]['VoucherNo'];
                            document.getElementById("infoUnposting").innerHTML = "Are you sure to Unposting this data : " + data[0]['VoucherNo'] + " ?";
                          
                            dismisLoading();
                            $("#voucherUnposting").modal();
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
         function UnpostingVoucher(){
                var btn = document.getElementById("btnUnposting");
                var VoucherNo_hapus = $('#VoucherNo_hapus').val();
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        VoucherNo : VoucherNo_hapus,
                    }
                    $.ajax({
                        url: '<?php echo base_url("finance/generalledger/Unposting/UnpostingVoucher") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            console.log(res)
                            if(res.status_json){
                                btn.value = 'Unposting';
							btn.innerHTML = 'Unposting';
							btn.disabled = false;
                                $('#voucherUnposting').modal('hide');
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

			function successUnposting(text) {
				Swal.fire({
					title: 'Info',
					html: text,
					type: "success",
					confirmButtonText: 'Ok',
					confirmButtonColor: "#46b654",
				}).then((result) => {
					Filter();
				})
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
