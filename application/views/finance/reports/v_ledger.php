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
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
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
								<div class="card-body " id="demo">
									<div class="row">
										<div class="col-sm-4">
											<div class="section-title">Year</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<select id="year" class="form-control select2" style="width:100%">
															<?php foreach($tahun as $t): ?>
																<option value="<?= $t; ?>"><?= $t; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="section-title">From Month</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<select id="from_month" class="form-control select2" style="width:100%">
															<?php foreach($bulan as $b): ?>
																<option value="<?= $b[0]; ?>"><?= $b[1]; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="section-title">To Month</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<select id="to_month" class="form-control select2" style="width:100%">
															<?php foreach($bulan as $b): ?>
																<option value="<?= $b[0]; ?>"><?= $b[1]; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="container">
											<div class="form-check row">
												<div class="col-md-2">
													<div class="custom-control custom-radio">
														<input type="radio" id="all" name="searchBased" class="custom-control-input" value="all">
														<label class="custom-control-label" for="all">All</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="custom-control custom-radio mt-2">
														<input type="radio" id="account" name="searchBased" class="custom-control-input" value="account" checked>
														<label class="custom-control-label" for="account">Account</label>
													</div>
												</div>

											</div>
										</div>
									</div>

									<!-- Select Account -->
									<div class="row" id="accountBased">
										<div class="col-md-6">
											<?php $this->load->view('finance/reports/part_ledger/modal_selectaccount', ['ket' => 'From']); ?>
										</div>
										<div class="col-md-6">
											<?php $this->load->view('finance/reports/part_ledger/modal_selectaccount', ['ket' => 'To']); ?>
										</div>
									</div>
									<!-- End Select Account -->

									<div class="row mt-3">
										<div class="col-sm-8">
											<div class="buttons">
												<button type="button" class="btn btn-sm btn-primary" id="btn_preview"><i class="fa fa-search"></i> Preview</button>
												<button type="button" class="btn btn-sm btn-danger" id="btn_cetak"><i class="fa fa-print"></i> Cetak</button>
												<div id="print"></div>
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
		<?php $this->load->view('finance/reports/part_ledger/modal_preview'); ?>
		<?php $this->load->view('finance/reports/part_ledger/modal_cariaccount', ['ket' => 'From']); ?>
		<?php $this->load->view('finance/reports/part_ledger/modal_cariaccount', ['ket' => 'To']); ?>
		<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/toastr.js'); ?>"></script>
		<script>
			document.querySelector('#btn_preview').addEventListener('click', e => {
				const data = {
					from: document.querySelector('#from_month').value,
					to: document.querySelector('#to_month').value,
					year: document.querySelector('#year').value
				};
				if($("#account").is(':checked')) {
					data.from_account = document.querySelector('#BankCodeFrom').value;
					data.to_account = document.querySelector('#BankCodeTo').value;
					(!data.from_account || !data.to_account)? showSnackError('Data belum diisi') : preview(data);
				} else if($("#all").is(':checked')) {
					data.from_account = 'all';
					data.to_account = 'all';
					preview(data);
				}
				
			});
			function preview(dataPost) {
				showLoading();
				$('#table_preview').dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url('finance/reports/ledger/getData'); ?>',
						dataSrc: 'data',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
					},
					"paging": false,
					"ordering": false,
					"info": false,
					"filter": false,
					columns: [
						{
							"data": 'date',
						},
						{
							"data": 'reffno',
						},
						{
							"data": 'description'
						},
						{
							"data": 'source'
						},
						{
							"data": 'debit'
						},
						{
							"data": 'credit'
						},
						{
							"data": 'balance'
						}
					]
				});
				dismisLoading();
				$("#Preview").modal();
			}
			document.querySelector('#btn_cetak').addEventListener('click', e => {
				const date = {
					from: document.querySelector('#from_month').value,
					to: document.querySelector('#to_month').value,
					year: document.querySelector('#year').value
				};
				if($("#account").is(':checked')) {
					date.from_account = document.querySelector('#BankCodeFrom').value;
					date.to_account = document.querySelector('#BankCodeTo').value;
					(!date.from_account || !date.to_account)? showSnackError('Data belum diisi') : btn_cetak(date);
				} else if($("#all").is(':checked')) {
					date.from_account = 'all';
					date.to_account = 'all';
					btn_cetak(date);
				}
			});
			function btn_cetak(date) {
				document.querySelector('#print').innerHTML = `<a id="btn_print" href="<?= base_url('finance/reports/ledger/print'); ?>?from=${date.from}&to=${date.to}&year=${date.year}&from_account=${date.from_account}&to_account=${date.to_account}" target="_blank"></a>`;
				document.querySelector('#btn_print').click();
			}
			document.querySelector('#btn_cariAccountFrom').addEventListener('click', e => {
				cariAccount('From');
			});
			document.querySelector('#btn_cariAccountTo').addEventListener('click', e => {
				cariAccount('To');
			});
			function cariAccount(ket) {
				showLoading();
				$(`#table-menu${ket}`).dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("finance/reports/ledger/getcashbank") ?>',
						dataSrc: 'data'
					},
					columns: [
						{
							"data": 'BankCode',
						},
						{
							"data": 'BankName'
						},
						{
							"data": 'BankAccount'
						},
						{
							"data": 'AccountNo'
						},
						{
							"data": 'Valuta'
						},
						{
							"data": 'Saldo'
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [
						{
							"sortable": false,
							"targets": [6]
						}
					]
				});
				dismisLoading();
				$(`#cariAccount${ket}`).modal();
				$(`#cariAccount${ket} tbody`).on('click', 'tr', function(event) {
					event.preventDefault();
					const td = $(this).closest('tr').children('td');
					const bankCode = document.querySelector(`#BankCode${ket}`);
					const bankName = document.querySelector(`#BankName${ket}`);
					bankCode.value = td.eq(0).text();
					bankName.value = td.eq(1).text();
					$(`#cariAccount${ket}`).modal('hide');
				});
			}
			$(document).ready(function() {
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
				$("input[name=searchBased]").change(function() {
					if ($("#account").is(':checked')) {
						$("#accountBased").show();
					} else if ($("#all").is(':checked')) {
						document.querySelector('#BankCodeFrom').value = '';
						document.querySelector('#BankNameFrom').value = '';
						document.querySelector('#BankCodeTo').value = '';
						document.querySelector('#BankNameTo').value = '';
						$("#accountBased").hide();
					}
				});
			});

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