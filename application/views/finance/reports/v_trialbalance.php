<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?=$title;?></title>
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/app.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/datatables/datatables.min.css');?>">
	<link rel="stylesheet"
		href="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css');?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico');?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css');?>">
	<link rel="stylesheet"
		href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css');?>">
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
									<h4><?=$title;?></h4> <i class="fa fa-angle-down" id="angle"></i>
									<hr>
								</div>
								<div class="card-body " id="demo">
									<div class="row">
										<div class="col-sm-3">
											<div class="section-title">Year</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<select id="year" class="form-control select2"
															style="width:100%">
															<?php foreach($tahun as $t) : ?>
																<option value="<?= $t; ?>"><?= $t; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<div class="section-title">Month</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<select id="month" class="form-control select2"
															style="width:100%">
															<?php foreach($bulan as $b) : ?>
																<option value="<?= $b[0]; ?>"><?= $b[1]; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-1">
											<button type="button" class="btn  btn-primary btn-sm" id="btn_preview" onclick="Preview()">Preview</button>
										</div>
										<div class="col-sm-1">
											<button type="button" class="btn btn-danger btn-sm" id="btn_cetak">Cetak</button>
											<div id="print"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<section>
			</div>
			<?php $this->load->view('layout/v_footer');?>
		</div>
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
													<h5 style="text-align:center;">PT SPEEDLAB INDONESIA </h5>
													<h2 style="text-align:center;">TRIAL BALANCE REPORT</h2>
												</div>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-md-12">
												<div class="table-responsive">
													<table class="table table-striped table-hover table-md"
														id="table_preview" width="100%">
														<thead>
															<tr>
																<th rowspan="2" class="text-center">Description </th>
																<th colspan="2" class="text-center">Opening Balance
																</th>
																<th colspan="2" class="text-center">Mutation</th>
																<th colspan="2" class="text-right">Close Balance</th>
															</tr>
															<tr>
																<th>Debit</th>
																<th>Credit</th>
																<th>Debit</th>
																<th>Credit</th>
																<th>Debit</th>
																<th>Credit</th>
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
		<script src="<?php echo base_url('assets/template/js/app.min.js');?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js');?>"></script>
		<script
			src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js');?>">
		</script>
		<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js');?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/datatables.js');?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js');?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js');?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js');?>"></script>
		<script src="<?php echo base_url('assets/template/js/scripts.js');?>"></script>
		<script src="<?php echo base_url('assets/template/js/custom.js');?>"></script>
		<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js');?>"></script>
		<script src="<?php echo base_url('assets/template/js/page/toastr.js');?>"></script>
		<script>
			document.querySelector('#btn_cetak').addEventListener('click', e => {
				const year = document.querySelector('#year').value;
				const month = document.querySelector('#month').value;
				document.querySelector('#print').innerHTML = `<a target="_blank" hidden href="<?= base_url('finance/reports/trialbalance/cetak') ?>?year=${year}&month=${month}" id="siapPrint"></a>`;
				document.querySelector('#siapPrint').click();
			});
			$(document).ready(function () {
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] =
					'<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			function Preview() {
				var month = $('#month').val();
				var year = $('#year').val();

				if (year == "" || year == null || month == "" || month == null) {
					showSnackError("Harap isi");
				} else {
					dataPost = {
						year: year,
						month: month,
					}

					showLoading();
					$("#table_preview").dataTable({
						destroy: true,
						ajax: {
							url: '<?php echo base_url("finance/reports/trialbalance/getData") ?>',
							dataSrc: 'data',
							type: 'POST',
							dataType: 'json',
							data: dataPost,
						},
						"paging": false,
						"ordering": false,
						"info": false,
						columns: [{
								"data": 'description'
							},
							{
								"data": 'Odebet'
							},
							{
								"data": 'Ocredit'
							},
							{
								"data": 'Mdebet'
							},
							{
								"data": 'Mcredit'
							},
							{
								"data": 'Cdebet'
							},
							{
								"data": 'Ccredit'
							}
						]
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

			$(document).on('click', '#btn-detail', function () {
				const id = $(this).data('id');
				alert(id)
			})
		</script>

</body>

</html>
