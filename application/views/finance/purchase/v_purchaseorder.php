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
									<h4><?= $title; ?></h4>
								</div>
								<div class="card-body row">
									<div class="col-lg-3">

										<div class="form-group row">
											<div class="col-md-12">
												<label for="exampleInputPassword1">Supplier</label>
												<div class="input-group mb-2">
													<input type="text" id="supplier_id" name="example-input2-group2" class="form-control form-control-sm col-md-6" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm" onclick="cariSupplier()">...</a>
													</span>
												</div>
												<input type="text" class="form-control form-control-sm" id="supplier_name" readonly>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label for="exampleInputPassword1">Project</label>
												<div class="input-group mb-2">
													<input type="text" id="project_id" name="example-input2-group2" class="form-control form-control-sm col-md-6" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm" onclick="cariProject()">...</a>
													</span>
												</div>
												<input type="text" class="mb-2 form-control form-control-sm" id="project_name" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Cust.:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="customer_name" type="text" readonly>
											</div>
										</div>



									</div>
									<!--end col-->
									<div class="col-lg-4">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">PO No:</label>
											<div class="col-sm-9 mb-2">
												<div class="input-group">
													<input class="form-control form-control-sm" id="PurchaseOrderNo" type="text" readonly>
													<input class="form-control form-control-sm" id="StatusPO" type="hidden" readonly>
													<span class="input-group-append">
														<button type="button" class="btn  btn-primary btn-sm" id="btncariPOSupplier" onclick="cariPOSupplier()" disabled>...</button>
													</span>
												</div>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">PO Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="PurchaseOrderDate" type="date" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Term of Payment:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="PurchaseOrderTMP" readonly type="text">
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Currency:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Valuta" type="text" readonly>
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Delivery Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="DeliverDate" readonly type="date">
											</div>

										</div>

									</div>
									<div class="col-lg-5">

										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Ship To:</label>
											<div class="col-sm-9 mb-1">
												<textarea class="form-control form-control-sm" id="DeliverTo" readonly></textarea>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Remarks:</label>
											<div class="col-sm-9 mb-1">
												<textarea class="form-control form-control-sm" id="Remarks" readonly></textarea>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Sub Total:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="SubTotal" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Discount:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="Discount" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">PPn 10%:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="PPn" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Other Cost:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="OtherCost" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Grand Total:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="GrandTotal" type="text" readonly>
											</div>

										</div>
										<div class="form-group row">
											<button type="button" class="btn  btn-primary btn-sm" id="btn_new_po" onclick="newPO()" disabled>New PO</button>
											<button type="button" class="btn  btn-primary btn-sm" id="btn_edit_po" onclick="editPO()" disabled>Edit PO</button>
											<button type="button" class="btn  btn-primary btn-sm" id="btn_delete_po" disabled>Delete PO</button>
											<button type="button" class="btn  btn-primary btn-sm" id="btn_save_po" onclick="return POBaru()" disabled>Save PO</button>
											<button type="button" class="btn  btn-primary btn-sm" id="btn_print_po" disabled>Print PO</button>
										</div>
									</div>

								</div>
								<div class="card-body">
									<div class="table-responsive">
										<button type="button" class="btn  btn-primary btn-sm" id="btn_add_item" onclick="addItem()" disabled>Add Items</button>
										<button type="button" class="btn  btn-primary btn-sm" disabled>Imports Excel</button>

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
	<div class="modal fade" id="cariPOSupplier" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Supplier</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-posupplier" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">PO NO</th>
								<th class="text-center">PO Date</th>
								<th class="text-center">Supplier ID</th>
								<th class="text-center">Supplier Name</th>
								<th class="text-center">Term of Payment</th>
								<th class="text-center">Ship To</th>
								<th class="text-center">Deliver Date</th>
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
	<div class="modal fade" id="cariSupplier" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Supplier</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Supplier ID</th>
								<th class="text-center">Supplier Name</th>
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
					<h5 class="modal-title">Input Item PO</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

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
					<div class="form-group">
						<label for="useremail">Price</label>
						<input type="text" class="form-control form-control-sm" id="itemPrice" required="">
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
	<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>">
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

		function cariPOSupplier() {

			showLoading();
			$("#table-posupplier").dataTable({
				ajax: {
					url: '<?php echo base_url("finance/purchase/purchaseorder/getPOSupplier") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'PurchaseOrderNo',
					}, {
						"data": 'PurchaseOrderDate',
					},
					{
						"data": 'supplier_id'
					},
					{
						"data": 'supplier_name'
					},
					{
						"data": 'PurchaseOrderTMP'
					},
					{
						"data": 'ShipTo'
					},
					{
						"data": 'DeliverDate'
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
			$("#cariPOSupplier").modal();

			$('#table-posupplier tbody').on('click', 'tr', function() {
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');

				var PurchaseOrderNo = $td.eq(0).text();
				var supplier_id = $td.eq(2).text();
				var supplier_name = $td.eq(3).text();

				document.getElementById("PurchaseOrderNo").value = PurchaseOrderNo;
				document.getElementById("supplier_id").value = supplier_id;
				document.getElementById("supplier_name").value = supplier_name;
				PurchaseOrderCari();


				$('#cariPOSupplier').modal('hide');
			});

		}

		function PurchaseOrderCari() {
			showLoading();
			PurchaseOrderNo = document.getElementById("PurchaseOrderNo").value;
			dataPost = {
				PurchaseOrderNo: PurchaseOrderNo,
			}
			$.ajax({
				url: '<?php echo base_url("finance/purchase/purchaseorder/getPurchaseOrderbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#PurchaseOrderNo').val(data[0]['PurchaseOrderNo']);
						document.getElementById("PurchaseOrderDate").value = data[0]['PurchaseOrderDate'];
						document.getElementById("DeliverDate").value = data[0]['DeliverDate'];
						$('#DeliverTo').val(data[0]['DeliverTo']);
						$('#PurchaseOrderTMP').val(data[0]['PurchaseOrderTMP']);
						$('#Valuta').val(data[0]['Valuta']);
						$('#Remarks').val(data[0]['Remarks']);
						$('#Discount').val(data[0]['Discount']);
						$('#PPn').val(data[0]['PPn']);
						$('#OtherCost').val(data[0]['OtherCost']);
						$('#SubTotal').val(data[0]['SubTotal']);
						$('#GrandTotal').val(data[0]['GrandTotal']);

						$("#table-detail").dataTable({
							destroy: true,
							ajax: {
								url: '<?php echo base_url("finance/purchase/purchaseorder/getPurchaseorderdetail") ?>',
								dataSrc: 'data',
								type: 'POST',
								dataType: 'json',
								data: dataPost,
							},
							columns: [{
									"data": 'no',
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
									"data": 'Price'
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
						document.getElementById("btn_add_item").disabled = false;
						document.getElementById("btn_edit_po").disabled = false;
						document.getElementById("btn_delete_po").disabled = false;
						document.getElementById("PurchaseOrderNo").readOnly = true;
						document.getElementById("PurchaseOrderDate").readOnly = true;
						document.getElementById("DeliverDate").readOnly = true;
						document.getElementById("DeliverTo").readOnly = true;
						document.getElementById("PurchaseOrderTMP").readOnly = true;
						document.getElementById("Valuta").readOnly = true;
						document.getElementById("Remarks").readOnly = true;
						document.getElementById("Discount").readOnly = true;
						document.getElementById("PPn").readOnly = true;
						document.getElementById("OtherCost").readOnly = true;
					} else {
						showSnackError(res.remarks);
						dismisLoading();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					showSnackError(XMLHttpRequest);
					dismisLoading();
				},
				timeout: 60000
			});


		}

		function cariSupplier() {

			showLoading();
			$("#table-menu").dataTable({
				ajax: {
					url: '<?php echo base_url("finance/purchase/purchaseorder/getSupplier") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'no',
					}, {
						"data": 'Kode_Spl',
					},
					{
						"data": 'Nama_Spl'
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
			$("#cariSupplier").modal();

			$('#table-menu tbody').on('click', 'tr', function() {
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');

				var Kode_Spl = $td.eq(1).text();
				var Nama_Spl = $td.eq(2).text();

				document.getElementById("supplier_id").value = Kode_Spl;
				document.getElementById("supplier_name").value = Nama_Spl;
				document.getElementById("btn_new_po").disabled = false;
				document.getElementById("btncariPOSupplier").disabled = false;
				$('#cariSupplier').modal('hide');
			});

		}

		function newPO() {
			document.getElementById("StatusPO").value = 'New';
			document.getElementById("btn_save_po").disabled = false;
			document.getElementById("PurchaseOrderNo").readOnly = false;
			document.getElementById("PurchaseOrderDate").readOnly = false;
			document.getElementById("DeliverDate").readOnly = false;
			document.getElementById("DeliverTo").readOnly = false;
			document.getElementById("PurchaseOrderTMP").readOnly = false;
			document.getElementById("Valuta").readOnly = false;
			document.getElementById("Remarks").readOnly = false;
			document.getElementById("Discount").readOnly = false;
			document.getElementById("PPn").readOnly = false;
			document.getElementById("OtherCost").readOnly = false;
			document.getElementById("PurchaseOrderNo").value = "";
			document.getElementById("PurchaseOrderDate").value = "";
			document.getElementById("DeliverDate").value = "";
			document.getElementById("DeliverTo").value = "";
			document.getElementById("PurchaseOrderTMP").value = "";
			document.getElementById("Valuta").value = "";
			document.getElementById("Remarks").value = "";
			document.getElementById("Discount").value = "";
			document.getElementById("PPn").value = "";
			document.getElementById("OtherCost").value = "";

		}

		function editPO() {
			document.getElementById("StatusPO").value = 'Edit';
			document.getElementById("btn_save_po").disabled = false;
			document.getElementById("PurchaseOrderNo").readOnly = true;
			document.getElementById("PurchaseOrderDate").readOnly = false;
			document.getElementById("DeliverDate").readOnly = false;
			document.getElementById("DeliverTo").readOnly = false;
			document.getElementById("PurchaseOrderTMP").readOnly = false;
			document.getElementById("Valuta").readOnly = false;
			document.getElementById("Remarks").readOnly = false;
			document.getElementById("Discount").readOnly = false;
			document.getElementById("PPn").readOnly = false;
			document.getElementById("OtherCost").readOnly = false;

		}

		function POBaru() {
			var btn = document.getElementById("btn_save_po");
			var StatusPO = $('#StatusPO').val();
			var PurchaseOrderNo = $('#PurchaseOrderNo').val();
			var PurchaseOrderDate = $('#PurchaseOrderDate').val();
			var DeliverDate = $('#DeliverDate').val();
			var DeliverTo = $('#DeliverTo').val();
			var PurchaseOrderTMP = $('#PurchaseOrderTMP').val();
			var Valuta = $('#Valuta').val();
			var Remarks = $('#Remarks').val();
			var Discount = $('#Discount').val();
			var PPn = $('#PPn').val();
			var OtherCost = $('#OtherCost').val();
			var SubTotal = $('#SubTotal').val();
			var GrandTotal = $('#GrandTotal').val();
			var supplier_id = $('#supplier_id').val();
			var project_id = $('#project_id').val();

			if (PurchaseOrderNo == "" || PurchaseOrderNo == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					StatusPO: StatusPO,
					PurchaseOrderNo: PurchaseOrderNo,
					PurchaseOrderDate: PurchaseOrderDate,
					DeliverDate: DeliverDate,
					DeliverTo: DeliverTo,
					PurchaseOrderTMP: PurchaseOrderTMP,
					Valuta: Valuta,
					Remarks: Remarks,
					Discount: Discount,
					PPn: PPn,
					OtherCost: OtherCost,
					SubTotal: SubTotal,
					GrandTotal: GrandTotal,
					supplier_id: supplier_id,
					project_id: project_id,
				}
				$.ajax({
					url: '<?php echo base_url("finance/purchase/purchaseorder/addPO") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save PO';
							btn.innerHTML = 'Save PO';
							btn.disabled = false;
							successpo(res.remarks)
						} else {
							btn.value = 'Save PO';
							btn.innerHTML = 'Save PO';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
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
			var PurchaseOrderNo = $('#PurchaseOrderNo').val();
			var itemDescription = $('#itemDescription').val();
			var itemUnit = $('#itemUnit').val();
			var itemQty = $('#itemQty').val();
			var itemPrice = $('#itemPrice').val();

			if (itemDescription == "" || itemDescription == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					PurchaseOrderNo: PurchaseOrderNo,
					itemDescription: itemDescription,
					itemUnit: itemUnit,
					itemQty: itemQty,
					itemPrice: itemPrice,
				}
				$.ajax({
					url: '<?php echo base_url("finance/purchase/purchaseorder/addItem") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {

							document.getElementById("itemDescription").value = "";
							document.getElementById("itemUnit").value = "";
							document.getElementById("itemQty").value = "";
							document.getElementById("itemPrice").value = "";


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
					error: function(XMLHttpRequest, textStatus, errorThrown) {
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
				PurchaseOrderCari();
			})
		}

		function successpo(text) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				PurchaseOrderCari();
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