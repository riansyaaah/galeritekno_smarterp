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
									<button type="button" class="btn-sm btn-primary ml-auto">Tambah</button>
								</div>
								<div class="card-body">
									<div class="col-md-12">
										<div class="row">
											<div class="col-sm-4 ml-auto">
												<div class="input-group mb-2">
													<input type="text" class="form-control" name="ClientID" id="ClientID">
													<div class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm"
															onclick="cariCustomer()">...</a>
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="input-group mb-2">
													<input type="text" class="form-control" name="ClientName" id="ClientName">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="table-responsive">
												<table class="table table-bordered" id="table-data-project" width="100%">
													<thead>
														<tr>
															<th>No</th>
															<th>Project Name</th>
															<th>Initial</th>
															<th>#</th>
														</tr>
													</thead>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<section>
			</div>
			<!-- basic modal -->
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		<div class="modal fade" id="cariCustomer" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Data Project</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
							<thead>
								<tr>
									<th>Code</th>
									<th>Project Name</th>
									<th>Initial</th>
									<th>#</th>
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
			$(document).ready(function () {
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] =
					'<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});

				$("#table-data-project").dataTable({
					ajax: {
						url: '<?= base_url("finance/project/dataproject/getDataproject") ?>',
						dataSrc: 'data'
					},
					columns: [
						{
							"data": 'no',
						},
						{
							"data": 'Nama_Project'
						},
						{
							"data": 'Inisial_Project'
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

				$('#table-1 tbody').on('click', 'tr', function () {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var ClientId = $td.eq(0).text();
					var Nama_Project = $td.eq(1).text();
					var Inisial_Project = $td.eq(2).text();
				});
			});

			function cariCustomer() 
			{
				showLoading();
				$("#table-menu").dataTable({
					ajax: {
						url: '<?= base_url("finance/project/dataproject/getCustomer") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'ClientID',
						},
						{
							"data": 'ClientName'
						},
						{
							"data": 'Inisial'
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
				$("#cariCustomer").modal();

				$('#table-menu tbody').on('click', 'tr', function () {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var ClientID = $td.eq(0).text();
					var ClientName = $td.eq(1).text();
					var Inisial = $td.eq(2).text();

					document.getElementById("ClientID").value = ClientID;
					document.getElementById("ClientName").value = ClientName;
					$('#cariCustomer').modal('hide');
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
		</script>
</body>

</html>
