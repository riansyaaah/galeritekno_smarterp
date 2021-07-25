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
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/bootstrap-daterangepicker/daterangepicker.css'); ?>">
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
									<div class="col-lg-5">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">First Name :</label>
											<div class="col-sm-9">
												<div class="input-group">
													<input type="hidden" id="StaffNo" name="example-input2-group2" class="form-control form-control-sm col-md-12">
													<input type="text" id="FirstName" name="example-input2-group2" class="form-control form-control-sm col-md-12" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm" onclick="cariStaff()">...</a>
													</span>
												</div>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Last Name :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="LastName" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Email :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Email" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Phone :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Phone" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Address :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Address" type="text" readonly>
											</div>
										</div>

									</div>
									<div class="col-lg-5 formleave">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Leave Type :</label>
											<div class="col-sm-9">
												<input class="form-control" id="StatusLeave" type="hidden">
												<input class="form-control" id="id" type="hidden">
												<select class="form-control form-control-sm" id="LeaveType" readonly>
													<option value="1">Casual Leave</option>
													<option value="2">Sick Leave</option>
													<option value="3">Maternity Leave</option>
												</select>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Start Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm datepicker" id="StartDate" type="date" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">End Date:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm datepicker" id="EndDate" type="date" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Description:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Description" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Remarks:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="Remarks" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Status:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="status" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Halfday:</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="halfday" type="text" readonly>
											</div>
										</div>
									</div>
									<div class="col-lg-2">
										<div class="form-group row">
											<button type="button" class="btn btn-primary btn-sm" id="btn_new_leave" onclick="newLeave()" disabled>New Leave</button>
											<button type="button" class="btn btn-primary btn-sm" id="btn_save_leave" onclick="LeaveSave()" disabled>Save
												Leave</button>
										</div>
									</div>

								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="table-leave">
											<thead>
												<tr>
													<th>No</th>
													<th>First Name</th>
													<th>Last Name</th>
													<th>Email</th>
													<th>Phone</th>
													<th>Leave Type</th>
													<th>Start Date</th>
													<th>End Date</th>
													<th>Description</th>
													<th>Remarks</th>
													<th>Status</th>
													<th>Halfday</th>
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
		<div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
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
						<button class="btn btn-primary" type="button" id="btnDelete" onclick="return itemHapus()"> Delete </button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
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
									<th class="text-center">Email</th>
									<th class="text-center">Phone</th>
									<th class="text-center">Address</th>
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
	<script src="<?php echo base_url('assets/template/bundles/bootstrap-daterangepicker/daterangepicker.js'); ?>">
	</script>
	<script src="<?php echo base_url('assets/template/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'); ?>">
	</script>
	<script src="<?php echo base_url('assets/template/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js'); ?>">
	</script>

	<script>
		$(document).ready(function() {
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] =
				'<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});

			$("#table-leave").dataTable({
				ajax: {
					url: '<?= base_url("hrm/timesheets/leave/getLeave") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'no',
					},
					{
						"data": 'FirstName',
					},
					{
						"data": 'LastName',
					},
					{
						"data": 'Email',
					},
					{
						"data": 'Phone',
					},
					{
						"data": 'LeaveType',
					},
					{
						"data": 'StartDate'
					},
					{
						"data": 'EndDate'
					},
					{
						"data": 'Description'
					},
					{
						"data": 'Remarks'
					},
					{
						"data": 'status'
					},
					{
						"data": 'halfday'
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
		});

		function cariStaff() {

			showLoading();
			$("#table-staff").dataTable({
				ajax: {
					url: '<?= base_url("hrm/timesheets/leave/getStaffProfile") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'StaffNo',
					},
					{
						"data": 'FirstName',
					},
					{
						"data": 'LastName',
					},
					{
						"data": 'Email',
					},
					{
						"data": 'Phone',
					},
					{
						"data": 'Address',
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

				var StaffNo = $td.eq(0).text();
				var FirstName = $td.eq(1).text();
				var LastName = $td.eq(2).text();
				var Email = $td.eq(3).text();
				var Phone = $td.eq(4).text();
				var Address = $td.eq(5).text();

				document.getElementById("StaffNo").value = StaffNo;
				document.getElementById("FirstName").value = FirstName;
				document.getElementById("LastName").value = LastName;
				document.getElementById("Email").value = Email;
				document.getElementById("Phone").value = Phone;
				document.getElementById("Address").value = Address;
				document.getElementById("btn_new_leave").disabled = false;

				$('#cariStaff').modal('hide');
			});
		}

		function LeaveSave() {
			var btn = document.getElementById("btn_save_leave");
			var id = $('#id').val();
			var StaffNo = $('#StaffNo').val();
			var LeaveType = $('#LeaveType').val();
			var StartDate = $('#StartDate').val();
			var EndDate = $('#EndDate').val();
			var Description = $('#Description').val();
			var Remarks = $('#Remarks').val();
			var status = $('#status').val();
			var halfday = $('#halfday').val();
			var StatusLeave = $('#StatusLeave').val();

			if (LeaveType == "" || LeaveType == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					id: id,
					StaffNo: StaffNo,
					LeaveType: LeaveType,
					StartDate: StartDate,
					EndDate: EndDate,
					Description: Description,
					Remarks: Remarks,
					status: status,
					halfday: halfday,
					StatusLeave: StatusLeave,
				}
				$.ajax({
					url: '<?= base_url("hrm/timesheets/leave/saveLeave") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save Leave';
							btn.innerHTML = 'Save Leave';
							btn.disabled = false;
							success(res.remarks)
						} else {
							btn.value = 'Save Leave';
							btn.innerHTML = 'Save Leave';
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

		function newLeave() {
			document.getElementById("StatusLeave").value = 'Tambah';
			document.getElementById("btn_save_leave").disabled = false;
			document.getElementById("LeaveType").readOnly = false;
			document.getElementById("StartDate").readOnly = false;
			document.getElementById("EndDate").readOnly = false;
			document.getElementById("Description").readOnly = false;
			document.getElementById("Remarks").readOnly = false;
			document.getElementById("status").readOnly = false;
			document.getElementById("halfday").readOnly = false;
			document.getElementById("LeaveType").readOnly = "";
			document.getElementById("StartDate").readOnly = "";
			document.getElementById("EndDate").readOnly = "";
			document.getElementById("Description").readOnly = "";
			document.getElementById("Remarks").readOnly = "";
			document.getElementById("status").readOnly = "";
			document.getElementById("halfday").readOnly = "";
		}

		function editLeave(id, StatusLeave) {
			document.getElementById("StatusLeave").value = 'Edit';
			document.getElementById("btn_new_leave").disabled = false;
			document.getElementById("btn_save_leave").disabled = false;
			document.getElementById("LeaveType").readOnly = false;
			document.getElementById("StartDate").readOnly = false;
			document.getElementById("EndDate").readOnly = false;
			document.getElementById("Description").readOnly = false;
			document.getElementById("Remarks").readOnly = false;
			document.getElementById("status").readOnly = false;
			document.getElementById("halfday").readOnly = false;
			dataPost = {
				id: id,
				StatusLeave: StatusLeave
			}
			showLoading();
			$.ajax({
				url: '<?= base_url("hrm/timesheets/leave/getLeavebyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#id').val(data[0]['id']);
						$('#LeaveType').val(data[0]['LeaveType']);
						$('#StartDate').val(data[0]['StartDate']);
						$('#EndDate').val(data[0]['EndDate']);
						$('#Description').val(data[0]['Description']);
						$('#Remarks').val(data[0]['Remarks']);
						$('#status').val(data[0]['status']);
						$('#halfday').val(data[0]['halfday']);
						$('#StatusLeave').val('Edit');
						dismisLoading();
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

		function hapus(id) {
			dataPost = {
				id: id
			}
			showLoading();
			$.ajax({
				url: '<?= base_url("hrm/timesheets/leave/getLeavebyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#code_hapus').val(data[0]['id']);

						document.getElementById("headermodalhapus").innerHTML = "Delete Leave  ";
						document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : ";

						dismisLoading();
						$("#hapusModal").modal();
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
				url: '<?= base_url("hrm/timesheets/leave/deleteLeave") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						success(res.remarks)
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
