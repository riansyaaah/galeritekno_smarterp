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
									<button type="button" class="btn  btn-primary btn-sm mb-2" id="btn_add_picket" onclick="add()"><i class="fa fa-plus"></i> Add Picket</button>
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="table-detail-picket" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Staff</th>
													<th>ID</th>
													<th>Department</th>
													<th>Position</th>
													<th>Date</th>
													<th>Description</th>
													<th width="145px">Action</th>
													<th width="170px">#</th>
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

		<!-- Add Modal -->
		<div class="modal fade" id="AddModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headerModal"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="status" class="form-control">
						<input type="hidden" id="code" class="form-control">
						<div class="section-title" id="title_code"></div>

						<div class="form-group">
							<div class="section-title" id="title_staff_name"></div>
							<div class="input-group">
								<input type="hidden" id="staff_id" name="example-input2-group2" class="form-control form-control-sm col-md-12">
								<input type="text" id="staff_name" name="example-input2-group2" class="form-control form-control-sm col-md-12" readonly>
								<span class="input-group-append">
									<button href="#" id="btn_cari_staff" class="edit_record btn btn-primary btn-sm" onclick="cariStaff()"><i class="fas fa-list-ul"></i></button>
								</span>
							</div>
						</div>

						<div class="form-group">
							<div class="section-title" id="title_date"></div>
							<input type="date" class="form-control form-control-sm" id="date" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_description"></div><textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return save()">
							<i class="fa fa-check"></i> SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Delete Modal -->
		<div class="modal fade" id="deleteModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headerModalDelete'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="code_hapus" class="form-control">
						<div class="section-title" id='infohapus'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-danger" type="button" id="btnDelete" onclick="return itemHapus()"> <i class="fa fa-trash"></i> Delete </button>
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Approve Modal -->
		<div class="modal fade" id="approveModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headerModalApprove'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="code_approve" class="form-control">
						<div class="section-title" id='infoapprove'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-success" type="button" id="btnApprove" onclick="return itemApprove()"> <i class="fa fa-check"></i> Approve </button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Abort Modal -->
		<div class="modal fade" id="abortModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headerModalAbort'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="code_abort" class="form-control">
						<div class="section-title" id='infoabort'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-warning" type="button" id="btnAbort" onclick="return itemAbort()"> <i class="fa fa-check"></i> Abort </button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
					</div>
				</div>
			</div>
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

		<!-- Modal Cari Staff -->
		<div class="modal fade" id="cariStaff" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Staff Profile</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-staff" style="width:100%;">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">First Name</th>
									<th class="text-center">Last Name</th>
									<th class="text-center">email</th>
									<th class="text-center">phone</th>
									<th class="text-center">address</th>
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

				$("#date").change(function() {
					$("#date").removeClass("is-invalid");
				});
				$("#description").change(function() {
					$("#description").removeClass("is-invalid");
				});
				loadData();
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			function loadData() {
				$("#table-detail-picket").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/form/Pickets/getPickets") ?>',
						dataSrc: 'data'
					},
					columns: [{
						"data": 'no',
					}, {
						"data": 'staff_name',
					}, {
						"data": 'staff_id',
					}, {
						"data": 'department',
					}, {
						"data": 'position',
					}, {
						"data": 'date',
					}, {
						"data": 'description'
					}, {
						"data": 'action'
					}, {
						"data": 'option'
					}],
					"columnDefs": [{
						"sortable": false,
						"targets": [7, 8]
					}]
				});
			}

			function cariPeriode() {
				showLoading();
				$("#table-periode").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/payroll/Periods/selectPeriod") ?>',
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

					document.getElementById("btn_add_picket").disabled = false;

					PicketCari();
					$('#cariPeriode').modal('hide');
					// flash Table
					$('#table-detail-picket').DataTable().clear().draw();
					$('#table-detail-picket').DataTable().destroy();
				});
			}


			function add() {
				showLoading();
				$('#status').val('tambah');
				document.getElementById("btnItemBaru").innerHTML = '<i class="fa fa-check"></i> SAVE';
				document.getElementById("btnItemBaru").disabled = false;
				document.getElementById('description').value = ""
				document.getElementById('date').value = ""
				document.getElementById('staff_name').value = ""
				document.getElementById('code').value = ""

				$("#description").removeClass("is-invalid");
				$("#date").removeClass("is-invalid");
				$("#staff_name").removeClass("is-invalid");

				document.getElementById("headerModal").innerHTML = "ADD PICKET";
				document.getElementById("title_description").innerHTML = "Description";
				document.getElementById("title_date").innerHTML = "Date";
				document.getElementById("title_staff_name").innerHTML = "Staff";

				dismisLoading();
				$("#AddModal").modal();
			}

			function edit(id, status) {
				dataPost = {
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/getPicketById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code').val(data['id']);
							$('#date').val(data['date']);
							$('#staff_name').val(data['staff_id']);
							$('#description').val(data['description']);
							$('#status').val('edit');

							$("#date").removeClass("is-invalid");
							$("#description").removeClass("is-invalid");
							document.getElementById("headerModal").innerHTML = "EDIT PICKET";
							document.getElementById("title_date").innerHTML = "Date";
							document.getElementById("title_staff_name").innerHTML = "Staff Name";
							document.getElementById("title_description").innerHTML = "Description";
							document.getElementById("btnItemBaru").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnItemBaru").disabled = false;
							dismisLoading();
							$("#AddModal").modal();
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
				})
			}

			function save() {
				var btn = document.getElementById("btnItemBaru");
				var code = $('#code').val();
				var period_id = $('#period_id').val();
				var date = $('#date').val();
				var staff_id = $('#staff_id').val();
				var staff_name = $('#staff_name').val();
				var description = $('#description').val();
				var status = $('#status').val();

				if (date == "" || date == null || staff_name == "" || staff_name == null || description == "" || description == null) {
					if (date == "" || date == null) {
						$("#date").addClass("is-invalid");
					}
					if (staff_name == "" || staff_name == null) {
						$("#staff_name").addClass("is-invalid");
					}
					if (description == "" || description == null) {
						$("#description").addClass("is-invalid");
					}
					showSnackError("Harap isi");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code,
						period_id: period_id,
						staff_id: staff_id,
						date: date,
						description: description,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/form/Pickets/savePicket") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								loadData();
								$('#AddModal').modal('hide');
								showSnackSuccess(res.remarks);
							} else {
								btn.value = '<i class="fa fa-check"></i> SAVE';
								btn.innerHTML = '<i class="fa fa-check"></i> SAVE';
								btn.disabled = false;
								showSnackError(res.remarks);
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							btn.value = '<i class="fa fa-times"></i> Gagal, Coba lagi';
							btn.innerHTML = '<i class="fa fa-times"></i> Gagal, Coba lagi';
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}

			function hapus(code) {
				dataPost = {
					code: code
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/getPicketById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;

							var btn = document.getElementById("btnDelete");
							btn.disabled = false;
							btn.innerHTML = '<i class="fa fa-trash"></i> Delete';

							$('#code_hapus').val(data['id']);
							document.getElementById("headerModalDelete").innerHTML = "Delete Picket ";
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data['description'] + " ?";

							dismisLoading();
							$("#deleteModal").modal();
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

			function itemHapus() {
				var btn = document.getElementById("btnDelete");
				var code_hapus = $('#code_hapus').val();
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					code_hapus: code_hapus,
				}
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/deletePicket") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							loadData();
							$('#deleteModal').modal('hide');
							showSnackSuccess(res.remarks);
						} else {
							btn.value = 'Gagal, Coba lagi';
							btn.innerHTML = 'Gagal, Coba lagi';
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

			function approve(code) {
				dataPost = {
					code: code
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/getPicketById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;

							var btn = document.getElementById("btnApprove");
							btn.disabled = false;
							btn.innerHTML = '<i class="fa fa-check"></i> Approve';

							$('#code_approve').val(data['id']);
							document.getElementById("headerModalApprove").innerHTML = "APPROVE PICKET ";
							document.getElementById("infoapprove").innerHTML = "Are you sure to apporove this data : " + data['description'] + " ?";

							dismisLoading();
							$("#approveModal").modal();
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

			function itemApprove() {
				var btn = document.getElementById("btnApprove");
				var code_approve = $('#code_approve').val();
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					code_approve: code_approve,
				}
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/approvePicket") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							loadData();
							$('#approveModal').modal('hide');
							showSnackSuccess(res.remarks);
						} else {
							btn.value = 'Gagal, Coba lagi';
							btn.innerHTML = 'Gagal, Coba lagi';
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

			function abort(code) {
				dataPost = {
					code: code
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/getPicketById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;

							var btn = document.getElementById("btnAbort");
							btn.disabled = false;
							btn.innerHTML = '<i class="fa fa-check"></i> Abort';

							$('#code_abort').val(data['id']);
							document.getElementById("headerModalAbort").innerHTML = "ABORT PICKET ";
							document.getElementById("infoabort").innerHTML = "Are you sure to abort this data : " + data['description'] + " ?";

							dismisLoading();
							$("#abortModal").modal();
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

			function itemAbort() {
				var btn = document.getElementById("btnAbort");
				var code_abort = $('#code_abort').val();
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					code_abort: code_abort,
				}
				$.ajax({
					url: '<?php echo base_url("hrm/form/Pickets/abortPicket") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							loadData();
							$('#abortModal').modal('hide');
							showSnackSuccess(res.remarks);
						} else {
							btn.value = 'Gagal, Coba lagi';
							btn.innerHTML = 'Gagal, Coba lagi';
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

			function PicketCari() {
				showLoading();
				period_id = document.getElementById("period_id").value;
				dataPost = {
					period_id: period_id,
				}
				$("#table-detail-picket").dataTable({
					paging: true,
					ordering: true,
					info: true,
					searching: true,
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/form/pickets/getPicketByPeriodId") ?>',
						dataSrc: 'data',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
					},
					columns: [{
						"data": 'no',
					}, {
						"data": 'staff',
					}, {
						"data": 'personel_id',
					}, {
						"data": 'position',
					}, {
						"data": 'date',
					}, {
						"data": 'description'
					}, {
						"data": 'action'
					}, {
						"data": 'option'
					}],
					"columnDefs": [{
						"sortable": false,
						"targets": [4]
					}],
				});

				dismisLoading();
			}

			function cariStaff() {

				showLoading();
				$("#table-staff").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/timesheets/attendance/getStaffProfile") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'id',
						},
						{
							"data": 'first_name',
						},
						{
							"data": 'last_name',
						},
						{
							"data": 'email',
						},
						{
							"data": 'phone',
						},
						{
							"data": 'address',
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [1, 3]
					}]
				});

				dismisLoading();
				$("#cariStaff").modal();

				$('#table-staff tbody').on('click', 'tr', function() {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var staff_id = $td.eq(0).text();
					var first_name = $td.eq(1).text();
					document.getElementById("staff_id").value = staff_id;
					document.getElementById("staff_name").value = first_name;

					$('#cariStaff').modal('hide');
				});
				$("#staff_name").removeClass("is-invalid");
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
