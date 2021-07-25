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
									<div class="col-lg-6">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Period :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<div class="input-group">
													<input type="text" id="period_id" name="example-input2-group2" class="form-control form-control-sm col-md-12" readonly>
													<span class="input-group-append">
														<a href="#" id="btn_cari_periode" class="edit_record btn btn-primary btn-sm" onclick="cariPeriode()"><i class="fas fa-list-ul"></i></a>
													</span>
												</div>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Month :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<input class="form-control form-control-sm" id="month" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Year :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<input class="form-control form-control-sm" id="year" type="text" readonly>
											</div>
										</div>
									</div>
								</div>

								<div class="card-body">
									<div class="loader" style="display:block"></div>
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="table-detail-salary" style="width: 100%;">
											<thead>
												<tr>
													<th width="">No</th>
													<th>Name</th>
													<th>ID</th>
													<th>Department</th>
													<th>Position</th>
													<th>Basic Salary</th>
													<th>Job Incentive</th>
													<th>Transport</th>
													<th>Overtime</th>
													<th>Official</th>
													<th>Total Salary</th>
													<th>Incentive</th>
													<th>BPJS Perusahaan</th>
													<th>Tunjangan</th>
													<th>Potongan</th>
													<th>BPJS TK</th>
													<th>BPJS Kesehatan</th>
													<th>Other Incomes</th>
													<th>THP</th>
													<!-- <th>#</th> -->
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

		<!-- Modal Cari Periode -->
		<div class="modal fade" id="cariPeriode" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Staff Periode</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered text-center table-hover" id="table-periode" style="width:100%;">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">ID Periode</th>
									<th class="text-center">Month</th>
									<th class="text-center">Year</th>
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
				loadData()
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			function loadData() {
				$("#table-detail-salary").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/payroll/Salaries/getSalary") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'staff_name',
						},
						{
							"data": 'staff_id',
						},
						{
							"data": 'department',
						},
						{
							"data": 'position',
						},
						{
							"data": 'basic_salary',
						},
						{
							"data": 'job_incentive'
						},
						{
							"data": 'transport'
						},
						{
							"data": 'overtime'
						},
						{
							"data": 'official'
						},
						{
							"data": 'total_salary'
						},
						{
							"data": 'incentive'
						},
						{
							"data": 'bpjs_perusahaan'
						},
						{
							"data": 'allowance'
						},
						{
							"data": 'cuts'
						},
						{
							"data": 'bpjs_tk'
						},
						{
							"data": 'bpjs_kes'
						},
						{
							"data": 'other_paid'
						},
						{
							"data": 'thp'
						},
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [4]
					}]
				});
			}

			function cariPeriode() {
				showLoading();
				$("#table-periode").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/payroll/Periods/salaryPeriod") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'id',
						},
						{
							"data": 'month',
						},
						{
							"data": 'year',
						},
						{
							"data": 'option',
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [4]
					}]
				});

				dismisLoading();
				$("#cariPeriode").modal();
				$('#table-periode tbody').on('click', 'tr', function() {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var period_id = $td.eq(1).text();
					var month = $td.eq(2).text();
					var year = $td.eq(3).text();

					document.getElementById("period_id").value = period_id;
					document.getElementById("month").value = month;
					document.getElementById("year").value = year;


					SalaryCari();
					$('#cariPeriode').modal('hide');
					// flash Table
					$('#table-detail-salary').DataTable().clear().draw();
					$('#table-detail-salary').DataTable().destroy();
				});
			}

			function SalaryCari() {
				showLoading();
				period_id = document.getElementById("period_id").value;
				dataPost = {
					period_id: period_id,
				}
				$("#table-detail-salary").dataTable({
					paging: false,
					ordering: false,
					info: false,
					searching: false,
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/payroll/Salaries/getSalaryByPeriodId") ?>',
						dataSrc: 'data',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'staff_name',
						},
						{
							"data": 'staff_id',
						},
						{
							"data": 'department',
						},
						{
							"data": 'position',
						},
						{
							"data": 'basic_salary',
						},
						{
							"data": 'job_incentive'
						},
						{
							"data": 'transport'
						},
						{
							"data": 'overtime'
						},
						{
							"data": 'official'
						},
						{
							"data": 'total_salary'
						},
						{
							"data": 'incentive'
						},
						{
							"data": 'bpjs_perusahaan'
						},
						{
							"data": 'allowance'
						},
						{
							"data": 'cuts'
						},
						{
							"data": 'bpjs_tk'
						},
						{
							"data": 'bpjs_kes'
						},
						{
							"data": 'other_paid'
						},
						{
							"data": 'thp'
						},
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [4]
					}]
				});

				dismisLoading();
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
