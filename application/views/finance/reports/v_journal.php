<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?= base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
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
								</div>
								<div class="card-body " id="demo">
									<div class="row" style="margin-top:-20px">
										<div class="col-md">
											<div class="section-title">From Date</div>
											<div class="form-group">
												<div class="input-group row">
													<div class="col-md-12">
														<input type="date" name="from_date" id="from_date" class="form-control form-control-sm" placeholder="Date" required>
													</div>
												</div>
											</div>
										</div>
										<div class=" col-md">
											<div class="section-title">To Date</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-md-12">
														<input type="date" name="to_date" id="to_date" class="form-control form-control-sm" placeholder="Date" required>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md">
											<div class="section-title">Journal</div>
											<div class="form-check">
												<input id="idcash" class="form-check-input" type="radio" name="typeJournal" value="CASH" checked>
												<label class="form-check-label" for="idcash">CASH</label>
											</div>
											<div class="form-check">
												<input id="idbank" class="form-check-input" type="radio" name="typeJournal" value="BANK">
												<label class="form-check-label" for="idbank">BANK</label>
											</div>
											<div class="form-check">
												<input id="idcashbank" class="form-check-input" type="radio" name="typeJournal" value="CASH & BANK">
												<label class="form-check-label" for="idcashbank">CASH & BANK</label>
											</div>
										</div>
									</div>
									<div class="col-md-6 mt-2">
										<div class="row">
											<button type="button" class="btn  btn-primary btn-sm" id="btn_preview" onclick="Preview()"><i class="fa fa-search"></i> Preview</button> &nbsp;&nbsp;
											<input type="hidden" id="printSumAmount" name="printSumAmount">
											<button type="submit" class="btn btn-danger btn-sm mx-1" id="btn_cetak"><i class="fa fa-print"></i> Cetak</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<section>
		</div>
		<?php $this->load->view('layout/v_footer'); ?>
	</div>

	<!-- Modal Preview -->
	<div class="modal fade" id="Preview" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Preview</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<section class="section">
						<div class="section-body">
							<div class="invoice">
								<div class="invoice-print">
									<div class="row">
										<div class="col-lg-12">
											<div class="invoice-title">
												<h5 style="text-align:center;">PT. SPEEDLAB INDONESIA </h5>
												<h2 style="text-align:center;">JOURNAL REPORT</h2>
												<h5 style="text-align:center;" id="headerreport"></h5>
											</div>
										</div>
									</div>
									<div class="row mt-4">
										<div class="62">
											<div class="table-responsive">
												<table class="table table-bordered table-striped table-hover table-md" id="table_preview" width="100%">
													<thead>
														<tr>
															<th data-width="80px">Date</th>
															<th>Ref. No</th>
															<th class="text-center">Account</th>
															<th class="text-center">Description </th>
															<th class="text-center">Debet</th>
															<th class="text-right">Credit</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>

				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal Preview -->

	<script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
	<script>
		$(document).ready(function() {
			$("#from_date").change(function() {
				$("#from_date").removeClass("is-invalid");
			});
			$("#to_date").change(function() {
				$("#to_date").removeClass("is-invalid");
			});

			var csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});
		document.querySelector('#btn_cetak').addEventListener('click', e => {
			let form = {
				from_date: document.querySelector('#from_date').value,
				to_date: document.querySelector('#to_date').value,
				typeJournal: document.querySelector('input[name=typeJournal]:checked').value
			};
			form = getParam(form);
			window.open(`<?= base_url('finance/reports/journal/print') ?>?${form}`);
		});
		function getParam(data) {
			return new URLSearchParams(data).toString();
		}
		function Preview() {
			var from_date = document.getElementById("from_date").value;
			var to_date = document.getElementById("to_date").value;

			if (document.getElementById('idcash').checked) {
				idtable = document.getElementById('idcash').value;
				document.getElementById("headerreport").innerHTML = 'CASH';
			}
			if (document.getElementById('idbank').checked) {
				idtable = document.getElementById('idbank').value;
				document.getElementById("headerreport").innerHTML = 'BANK';
			}

			if (document.getElementById('idcashbank').checked) {
				idtable = document.getElementById('idcashbank').value;
				document.getElementById("headerreport").innerHTML = 'CASH & BANK';
			}

			if (from_date == "" || from_date == null || to_date == "" || to_date == null) {
				if (from_date == "" || from_date == null) {
					$("#from_date").addClass("is-invalid");
					showSnackError("Harap isi");
				} else if (to_date == "" || to_date == null) {
					$("#to_date").addClass("is-invalid");
					showSnackError("Harap isi");
				}
			} else {
				dataPost = {
					from_date: from_date,
					to_date: to_date,
					idtable: idtable,
				}

				$("#table_preview").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("finance/reports/journal/getDataPreview") ?>',
						dataSrc: 'data',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
					},
					"paging": false,
					"ordering": false,
					"info": false,
					"filter": false,
					columns: [{
							"data": 'Date',
						},
						{
							"data": 'ReffNo',
						},
						{
							"data": 'Account'
						},
						{
							"data": 'Description'
						},
						{
							"data": 'Debit'
						},
						{
							"data": 'Credit'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [2, 3]
					}]
				});

				dismisLoading();
				document.getElementById("btn_cetak").disabled = false;
				$("#Preview").modal();
			}

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
