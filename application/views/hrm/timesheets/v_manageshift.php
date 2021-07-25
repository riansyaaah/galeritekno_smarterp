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
									<h4><?= $title; ?>
										<p>
											<button type="button" class="btn-sm btn-primary mt-3" onClick="add()"><i class="fa fa-plus"> Add Shift</i></button>
										</p>
									</h4>
									<hr>
								</div>
								<div class="card-body">
									<div class="loader" style="display:block"></div>
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="table-manage-shift" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Shift</th>
													<th>Day</th>
													<th>Start Time</th>
													<th>End Time</th>
													<th width="150px">#</th>
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
		<div class="modal fade" id="AddModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headermodaltambah"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">
						<input type="hidden" id="id" class="form-control">
						<input type="hidden" id="status" class="form-control">
						<div class="col-sm-6">
							<div class="form-group">
								<div class="section-title" id="title_shift"></div>
								<input type="text" class="form-control" id="shift" required="">
							</div>

							<div class="form-group">
								<div class="section-title" id="title_starttime"></div>
								<input type="time" class="form-control" id="starttime" required="">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="section-title" id="title_day"></div>
								<input type="text" class="form-control" id="day" required="">
							</div>
							<div class="form-group">
								<div class="section-title" id="title_endtime"></div>
								<input type="time" class="form-control" id="endtime" required="">
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnSave" onclick="return saveitem()">
							SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="deleteModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headermodalhapus'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="code_hapus" class="form-control">
						<div class="section-title" id='infohapus'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-danger" type="button" id="btnDelete" onclick="return itemHapus()"> Delete </button>
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});

				loadData()
				$("#shift").change(function() {
					$("#shift").removeClass("is-invalid");
				});
				$("#day").change(function() {
					$("#day").removeClass("is-invalid");
				});
				$("#starttime").change(function() {
					$("#starttime").removeClass("is-invalid");
				});
				$("#endtime").change(function() {
					$("#endtime").removeClass("is-invalid");
				});
			});

			function loadData() {
				$("#table-manage-shift").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/timesheets/manageshift/getManageShift") ?>',
						dataSrc: 'data'
					},

					columns: [{
							"data": 'no',
						},
						{
							"data": 'shift',
						},
						{
							"data": 'day',
						},
						{
							"data": 'starttime',
						},
						{
							"data": 'endtime',
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [5]
					}]
				});
			}

			function add(status) {
				dataPost = {
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?= base_url("hrm/timesheets/manageshift/getManageShift") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#status').val('tambah');
							document.getElementById("headermodaltambah").innerHTML = "ADD SHIFT";
							document.getElementById("title_shift").innerHTML = "Shift";
							document.getElementById("title_day").innerHTML = "Day";
							document.getElementById("title_starttime").innerHTML = "Starttime";
							document.getElementById("title_endtime").innerHTML = "Endtime";

							$("#shift").removeClass("is-invalid");
							$("#day").removeClass("is-invalid");
							$("#starttime").removeClass("is-invalid");
							$("#endtime").removeClass("is-invalid");

							document.getElementById('shift').value = ""
							document.getElementById('day').value = ""
							document.getElementById('starttime').value = ""
							document.getElementById('endtime').value = ""

							document.getElementById("btnSave").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnSave").disabled = false;

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

			function edit(id, status) {
				document.getElementById("headermodaltambah").innerHTML = "";
				dataPost = {
					id: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?= base_url("hrm/timesheets/manageshift/getManageShiftbyid") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#id').val(data[0]['id']);
							$('#shift').val(data[0]['shift']);
							$('#day').val(data[0]['day']);
							$('#starttime').val(data[0]['start_time']);
							$('#endtime').val(data[0]['end_time']);
							$('#status').val('edit');

							$("#shift").removeClass("is-invalid");
							$("#day").removeClass("is-invalid");
							$("#starttime").removeClass("is-invalid");
							$("#endtime").removeClass("is-invalid");

							document.getElementById("headermodaltambah").innerHTML = "EDIT SHIFT";
							document.getElementById("title_shift").innerHTML = "Shift";
							document.getElementById("title_day").innerHTML = "Day";
							document.getElementById("title_starttime").innerHTML = "Starttime";
							document.getElementById("title_endtime").innerHTML = "Endtime";
							document.getElementById("btnSave").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnSave").disabled = false;
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

			function saveitem() {
				var btn = document.getElementById("btnSave");
				var id = $('#id').val();
				var shift = $('#shift').val();
				var day = $('#day').val();
				var starttime = $('#starttime').val();
				var endtime = $('#endtime').val();
				var status = $('#status').val();

				if (shift == "" || shift == null || day == "" || day == null || starttime == "" || starttime == null || endtime == "" || endtime == null) {
					if (shift == "" || shift == null) {
						$("#shift").addClass("is-invalid");
					}
					if (day == "" || day == null) {
						$("#day").addClass("is-invalid");
					}
					if (starttime == "" || starttime == null) {
						$("#starttime").addClass("is-invalid");
					}
					if (endtime == "" || endtime == null) {
						$("#endtime").addClass("is-invalid");
					}
					showSnackError("The field(s) is required");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						id: id,
						shift: shift,
						day: day,
						starttime: starttime,
						endtime: endtime,
						status: status,
					}
					$.ajax({
						url: '<?= base_url("hrm/timesheets/manageshift/saveManageShift") ?>',
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
								btn.value = 'SAVE';
								btn.innerHTML = 'SAVE';
								btn.disabled = false;
								showSnackError(res.remarks);
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							btn.value = 'Failed, try again';
							btn.innerHTML = 'Failed, try again';
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}

			function hapus(id) {
				dataPost = {
					id: id
				}
				showLoading();
				$.ajax({
					url: '<?= base_url("hrm/timesheets/manageshift/getManageShiftbyid") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code_hapus').val(data[0]['id']);

							document.getElementById("headermodalhapus").innerHTML = "Delete Shift ";
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : shift " + data[0]['shift'] + " ?";

							dismisLoading();
							document.getElementById("btnDelete").innerHTML = '<i class="fa fa-trash"></i> SAVE';
							document.getElementById("btnDelete").disabled = false;


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
					url: '<?= base_url("hrm/timesheets/manageshift/deleteManageShift") ?>',
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
							btn.value = 'Failed, try again';
							btn.innerHTML = 'Failed, try again';
							btn.disabled = false;
							showSnackError(res.remarks);
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						btn.value = 'Failed, try again';
						btn.innerHTML = 'Failed, try again';
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
		</script>
</body>

</html>
