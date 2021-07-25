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
                                            <div class="col-md-12">
												<label for="exampleInputPassword1">Client</label>
												<div class="input-group">
													<input type="text" id="client_id" name="example-input2-group2"
														class="form-control form-control-sm col-md-6" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm"
															onclick="cariClient()">...</a>
													</span>
												</div>
                                                <input type="text" class="form-control form-control-sm" id="client_name" readonly>
                                                </div>
										</div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
												<label for="exampleInputPassword1">Contract No</label>
												<div class="input-group">
													<input type="text" id="ContractNo" name="example-input2-group2"
														class="form-control form-control-sm col-md-6" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm"
															onclick="cariContract()">...</a>
													</span>
												</div>
                                                </div>
										</div>
                                        <div class="form-group row">
											<button type="button" class="btn  btn-primary btn-sm" id="btn_new_do"
												 onclick="newDO()" disabled>New DO</button>
											<button type="button" class="btn  btn-primary btn-sm" id="btn_edit_do"
												 onclick="editDO()" disabled>Edit DO</button>
											<button type="button" class="btn  btn-primary btn-sm"
												id="btn_delete_do" disabled>Delete DO</button>
											<button type="button" class="btn  btn-primary btn-sm" id="btn_save_do"
												onclick="return DOBaru()" disabled>Save DO</button>
                                            <button type="button" class="btn  btn-primary btn-sm" id="btn_print_do" disabled>Print DO</button>
										</div>
									</div>
									<!--end col-->
									<div class="col-lg-6">

										<div class="form-group row">
											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">DO No:</label>
											<div class="col-sm-9">
                                                <div class="input-group">
													<input class="form-control form-control-sm" id="DeliveryOrderNo" type="text" readonly>
                                                    <input class="form-control form-control-sm" id="StatusDO" type="hidden" readonly>
													<span class="input-group-append">
														<button type="button" class="btn  btn-primary btn-sm"id="btncariDOClient"
															onclick="cariDOClient()" disabled>...</button>
													</span>
												</div>
												
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">DO Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="DeliveryOrderDate" type="date" readonly>
											</div>
                                            <label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Ship To:</label>
											<div class="col-sm-9">
												<textarea class="form-control form-control-sm" id="ShipTo" readonly></textarea>
											</div>

											<label for="example-text-input"
												class="col-sm-3 col-form-label text-right">Delivered By:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="DeliveredBy" type="text" readonly>
											</div>
										</div>

									</div>
									
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<button type="button" class="btn  btn-primary btn-sm" id="btn_add_item" onclick="addItem()" disabled>Add Items</button>
                                                
                                        <table class="table table-striped" id="table-detail">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>DESCRIPTION</th>
                                                    <th>UNIT</th>
                                                    <th>QTY</th>
                                                    <th>UNIT PRICE</th>
                                                    <th>AMOUNT</th>
                                                    <th>#</th>
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
		<div class="modal fade" id="cariClient" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Client</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Client ID</th>
									<th class="text-center">Client Name</th>
									<th class="text-center">#</th>
								</tr>
							</thead>
						</table>

					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
        <div class="modal fade" id="addItem" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Input Item DO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label for="useremail">P/N</label>
							<input type="text" class="form-control form-control-sm" id="itemPN" required="">
						</div>
                        <div class="form-group">
							<label for="useremail">S/N</label>
							<input type="text" class="form-control form-control-sm" id="itemSN" required="">
						</div>
                        <div class="form-group">
							<label for="useremail">Description</label>
							<input type="text" class="form-control form-control-sm" id="itemDescription" required="">
						</div>
						<div class="form-group">
							<label for="useremail">Unit</label>
							<input type="text" class="form-control form-control-sm" id="itemUnit" required="">
						</div>
                        <div class="form-group">
							<label for="useremail">Qty</label>
							<input type="text" class="form-control form-control-sm" id="itemQty" required="">
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
        <div class="modal fade" id="cariDOClient" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Client</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-doclient" style="width:100%;">
							<thead>
								<tr>
									<th class="text-center">DO NO</th>
									<th class="text-center">DO Date</th>
									<th class="text-center">Client ID</th>
									<th class="text-center">Client Name</th>
									<th class="text-center">Ship To</th>
									<th class="text-center">Delivered By</th>
									<th class="text-center">#</th>
								</tr>
							</thead>
						</table>

					</div>
					<div class="modal-footer bg-whitesmoke br">
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
            function DeliveryOrderCari() {
                showLoading();
				DeliveryOrderNo = document.getElementById("DeliveryOrderNo").value;
				dataPost = {
                        DeliveryOrderNo : DeliveryOrderNo,
                    }
                $.ajax({
                    url: '<?php echo base_url("finance/Sales/DeliveryOrder/getDeliveryOrderbyid") ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: dataPost,
                    success: function(res){
                        console.log(res)
                        if(res.status_json){
                            data = res.data;
                            $('#DeliveryOrderNo').val(data[0]['DeliveryOrderNo']);
                            $('#DeliveryOrderDate').val(data[0]['DeliveryOrderDate']);
                            $('#ContractNo').val(data[0]['ContractNo']);
                            $('#ShipTo').val(data[0]['ShipTo']);
                            $('#client_id').val(data[0]['client_id']);
                            $('#DeliveredBy').val(data[0]['DeliveredBy']);
                            
                            $("#table-detail").dataTable({
                    destroy: true,
                    ajax: {
                        url: '<?php echo base_url("finance/sales/deliveryorder/getDeliveryOrderdetail") ?>',
                        dataSrc: 'data',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                    },
                    columns: [{
                            "data": 'no',
                        },
                        {
                            "data": 'PN'
                        },
                        {
                            "data": 'SN'
                        },
                        {
                            "data": 'Description'
                        },
                        {
                            "data": 'Unit'
                        },
                        {
                            "data": 'Qty'
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
                            document.getElementById("btn_add_item").disabled = false;
                            document.getElementById("btn_edit_do").disabled = false;
                            document.getElementById("btn_delete_do").disabled = false;
				document.getElementById("DeliveryOrderNo").readOnly = true;
				document.getElementById("DeliveryOrderDate").readOnly = true;
				document.getElementById("ContractNo").readOnly = true;
				document.getElementById("ShipTo").readOnly = true;
				document.getElementById("client_id").readOnly = true;
				document.getElementById("DeliveredBy").readOnly = true;
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
            function cariDOClient() {

				showLoading();
				$("#table-doclient").dataTable({
					ajax: {
						url: '<?php echo base_url("finance/sales/deliveryorder/getDOClient") ?>',
						dataSrc: 'data'
					},
					columns: [
                        {
							"data": 'DeliveryOrderNo',
						},{
							"data": 'DeliveryOrderDate',
						},
						{
							"data": 'client_id'
						},
						{
							"data": 'client_name'
						},
						{
							"data": 'ShipTo'
						},
						{
							"data": 'DeliveredBy'
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
				$("#cariDOClient").modal();

				$('#table-doclient tbody').on('click', 'tr', function () {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var DeliveryOrderNo = $td.eq(0).text();
					var client_id = $td.eq(2).text();
					var client_name = $td.eq(3).text();

					document.getElementById("DeliveryOrderNo").value = DeliveryOrderNo;
					document.getElementById("client_id").value = client_id;
					document.getElementById("client_name").value = client_name;
                    DeliveryOrderCari();
                    
                    
					$('#cariDOClient').modal('hide');
				});

			}
            function cariClient() {

				showLoading();
				$("#table-menu").dataTable({
					ajax: {
						url: '<?php echo base_url("finance/sales/deliveryorder/getClient") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						},{
							"data": 'ClientID',
						},
						{
							"data": 'ClientName'
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
				$("#cariClient").modal();

				$('#table-menu tbody').on('click', 'tr', function () {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var ClientID = $td.eq(1).text();
					var ClientName = $td.eq(2).text();

					document.getElementById("client_id").value = ClientID;
					document.getElementById("client_name").value = ClientName;
                    document.getElementById("btn_new_do").disabled = false;
                    document.getElementById("btncariDOClient").disabled = false;
					$('#cariClient').modal('hide');
				});

			}
            function newDO() {
                document.getElementById("StatusDO").value = 'New';
				document.getElementById("btn_save_do").disabled = false;
				document.getElementById("DeliveryOrderNo").readOnly = false;
				document.getElementById("DeliveryOrderDate").readOnly = false;
				document.getElementById("ShipTo").readOnly = false;
				document.getElementById("DeliveredBy").readOnly = false;
                document.getElementById("DeliveryOrderNo").value = '';
				document.getElementById("DeliveryOrderDate").value = '';
				document.getElementById("ShipTo").value = '';
				document.getElementById("DeliveredBy").value = '';
			}
            
            function editDO() {
                document.getElementById("StatusDO").value = 'Edit';
				document.getElementById("btn_save_do").disabled = false;
				document.getElementById("DeliveryOrderDate").readOnly = false;
				document.getElementById("ShipTo").readOnly = false;
				document.getElementById("DeliveredBy").readOnly = false;
				
			}
            function DOBaru(){
                var StatusDO = $('#StatusDO').val();
                var btn = document.getElementById("btn_save_do");
                var DeliveryOrderNo = $('#DeliveryOrderNo').val();
                var DeliveryOrderDate = $('#DeliveryOrderDate').val();
                var ContractNo = $('#ContractNo').val();
                var ShipTo = $('#ShipTo').val();
                var client_id = $('#client_id').val();
                var DeliveredBy = $('#DeliveredBy').val();
                 
                if(DeliveryOrderNo == "" || DeliveryOrderNo == null){
                    showSnackError("Harap isi");
                }else{
                    btn.value = 'Loading...';
                    btn.innerHTML = 'Loading...';
                    btn.disabled = true;
                    dataPost = {
                        DeliveryOrderNo : DeliveryOrderNo,
                        DeliveryOrderDate : DeliveryOrderDate,
                        ShipTo : ShipTo,
                        ContractNo : ContractNo,
                        DeliveredBy : DeliveredBy,
                        client_id : client_id,
                        StatusDO : StatusDO,
                    }
                    $.ajax({
                        url: '<?php echo base_url("finance/sales/deliveryorder/addDO") ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: dataPost,
                        success: function(res){
                            if(res.status_json){
                                btn.value = 'Save DO';
							btn.innerHTML = 'Save DO';
							btn.disabled = false;
                                successdo(res.remarks)
                            }else{
                                btn.value = 'Save DO';
							btn.innerHTML = 'Save DO';
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
            
            function addItem() {

				showLoading();
				dismisLoading();
				$("#addItem").modal();
			}

			function itemBaru() {
				var btn = document.getElementById("btnItemBaru");
				var DeliveryOrderNo = $('#DeliveryOrderNo').val();
				var itemDescription = $('#itemDescription').val();
				var itemUnit = $('#itemUnit').val();
				var itemQty = $('#itemQty').val();
				var itemPN = $('#itemPN').val();
				var itemSN = $('#itemSN').val();

				if (itemDescription == "" || itemDescription == null) {
					showSnackError("Harap isi");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						DeliveryOrderNo: DeliveryOrderNo,
						itemDescription: itemDescription,
						itemUnit: itemUnit,
						itemQty: itemQty,
						itemPN: itemPN,
						itemSN: itemSN,
					}
					$.ajax({
						url: '<?php echo base_url("finance/sales/deliveryorder/addItem") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function (res) {
							console.log(res)
							if (res.status_json) {
                            
							document.getElementById("itemDescription").value = "";
							document.getElementById("itemUnit").value = "";
							document.getElementById("itemQty").value = "";
							document.getElementById("itemPN").value = "";
							document.getElementById("itemSN").value = "";
                            
                            
							var btn = document.getElementById("btnItemBaru");
							btn.value = 'SIMPAN';
							btn.innerHTML = 'SIMPAN';
							btn.disabled = false;
							$('#addItem').modal('hide');
								successitem(res.remarks)
							} else {
								btn.value = 'SIMPAN';
								btn.innerHTML = 'SIMPAN';
								btn.disabled = false;
								showSnackError(res.remarks);
							}
						},
						error: function (XMLHttpRequest, textStatus, errorThrown) {
							btn.value = 'Gagal, Coba lagi';
							btn.innerHTML = 'Gagal, Coba lagi';
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}
            
            function successitem(text) {
				Swal.fire({
					title: 'Info',
					html: text,
					type: "success",
					confirmButtonText: 'Ok',
					confirmButtonColor: "#46b654",
				}).then((result) => {
                    DeliveryOrderCari();
				})
			}
            
            function successdo(text) {
				Swal.fire({
					title: 'Info',
					html: text,
					type: "success",
					confirmButtonText: 'Ok',
					confirmButtonColor: "#46b654",
				}).then((result) => {
					DeliveryOrderCari();
				})
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

		</script>
        
</body>

</html>
