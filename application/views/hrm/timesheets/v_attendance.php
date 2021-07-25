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
													<input type="hidden" id="staff_id" name="example-input2-group2" class="form-control form-control-sm col-md-12">
													<input type="text" id="first_name" name="example-input2-group2" class="form-control form-control-sm col-md-12" readonly>
													<span class="input-group-append">
														<a href="#" id="btn_cari_staff" class="edit_record btn btn-primary btn-sm" onclick="cariStaff()">...</a>
													</span>
												</div>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Last Name :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="last_name" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">email :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="email" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">phone :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="phone" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">address :</label>
											<div class="col-sm-9">
												<input class="form-control form-control-sm" id="address" type="text" readonly>
											</div>
										</div>

									</div>
									<div class="col-lg-5 formattendance">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Attendance Date:</label>
											<div class="col-sm-9">
												<input class="form-control" id="StatusAttendance" type="hidden">
												<input class="form-control" id="id" type="hidden">
												<input class="form-control form-control-sm datepicker" id="attendance_date" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Shift:</label>
											<div class="col-sm-9">
												<select class="form-control form-control-sm" id="shift_id" readonly>
													<?php foreach ($shifts as $shift) : ?>
														<option value="<?= $shift->shift ?>"><?= $shift->id; ?> | <?= $shift->day; ?></option>
													<?php endforeach; ?>
												</select>
											</div>
											<!-- <div class="col-sm-9">
												<select class="form-control form-control-sm" id="attendance_status" readonly>
													<option value="1">Half Day</option>
													<option value="2">Full Time</option>
												</select>
											</div> -->

											<label for="example-text-input" class="col-sm-3 col-form-label text-right" readonly>Clock In:</label>
											<div class="col-sm-9">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-clock"></i>
														</div>
													</div>
													<input type="time" class="form-control" id="arrived_at" readonly>
												</div>
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Clock Out:</label>
											<div class="col-sm-9">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-clock"></i>
														</div>
													</div>
													<input type="time" class="form-control" id="left_at" readonly>
												</div>
											</div>

										</div>

									</div>
									<div class="col-lg-2">
										<div class="form-group row">
											<button type="button" class="btn btn-primary btn-sm" id="btn_new_attendance" onclick="newAttendance()" disabled>New Attendance</button>
											<button type="button" class="btn btn-primary btn-sm" id="btn_save_attendance" onclick="AttendanceSave()" disabled>Save
												Attendance</button>
										</div>
									</div>

								</div>
								<div class="card-body">
									<div class="alert alert-success" role="alert">
										<b>Info</b><br>
										- Waktu toleransi adalah + 30 Menit dari tiap-tiap shift <br>
										- Total Jam kerja dikurang 1 jam (untuk istirahat) <br>
										- Uang Transaport + makan diperoleh setiap kehadiran <br>
									</div>
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="table-attendance" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Name</th>
													<th>Date</th>
													<th>Shift</th>
													<th>Arrived At</th>
													<th>Left At</th>
													<th>Late </th>
													<th>Early Leaving</th>
													<th>Overtime</th>
													<th>Working Hours</th>
													<th>Daily Paid</th>
													<th>Overtime Paid</th>
													<th>Transport Paid</th>
													<th style="min-width: 125px;">#</th>
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
			loadData();
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] =
				'<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});

		function loadData() {
			$("#table-attendance").dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url("hrm/timesheets/attendance/getAttendance") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'no',
					},
					{
						"data": 'first_name',
					},
					{
						"data": 'attendance_date',
					},
					{
						"data": 'shift'
					},
					{
						"data": 'arrived_at'
					},
					{
						"data": 'left_at'
					},
					{
						"data": 'late'
					},
					{
						"data": 'early_leaving'
					},
					{
						"data": 'overtime'
					},
					{
						"data": 'working_hours'
					},
					{
						"data": 'daily_paid'
					},
					{
						"data": 'overtime_paid'
					},
					{
						"data": 'transport_paid'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [13]
				}]
			});
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
				var last_name = $td.eq(2).text();
				var email = $td.eq(3).text();
				var phone = $td.eq(4).text();
				var address = $td.eq(5).text();

				document.getElementById("staff_id").value = staff_id;
				document.getElementById("first_name").value = first_name;
				document.getElementById("last_name").value = last_name;
				document.getElementById("email").value = email;
				document.getElementById("phone").value = phone;
				document.getElementById("address").value = address;
				document.getElementById("btn_new_attendance").disabled = false;

				$('#cariStaff').modal('hide');
			});
		}

		function AttendanceSave() {
			var btn = document.getElementById("btn_save_attendance");
			var id = $('#id').val();
			var staff_id = $('#staff_id').val();
			var attendance_date = $('#attendance_date').val();
			var attendance_status = $('#attendance_status').val();
			var shift_id = $('#shift_id').val();
			var arrived_at = $('#arrived_at').val();
			var left_at = $('#left_at').val();
			var late = $('#late').val();
			var early_leaving = $('#early_leaving').val();
			var overtime = $('#overtime').val();
			var StatusAttendance = $('#StatusAttendance').val();

			if (attendance_date == "" || attendance_date == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					id: id,
					staff_id: staff_id,
					attendance_date: attendance_date,
					attendance_status: attendance_status,
					shift_id: shift_id,
					arrived_at: arrived_at,
					left_at: left_at,
					late: late,
					early_leaving: early_leaving,
					overtime: overtime,
					StatusAttendance: StatusAttendance,
				}
				$.ajax({
					url: '<?= base_url("hrm/timesheets/attendance/saveAttendance") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							btn.value = 'Save Attendance';
							btn.innerHTML = 'Save Attendance';
							btn.disabled = false;
							// success(res.remarks)
							// HolidayCari();
							// $('#deleteModal').modal('hide');
							loadData();
							showSnackSuccess(res.remarks);
						} else {
							btn.value = 'Save Attendance';
							btn.innerHTML = 'Save Attendance';
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

		function newAttendance() {
			document.getElementById("StatusAttendance").value = 'Tambah';
			document.getElementById("btn_save_attendance").disabled = false;
			document.getElementById("attendance_date").readOnly = false;
			// document.getElementById("attendance_status").readOnly = false;
			document.getElementById("arrived_at").readOnly = false;
			document.getElementById("left_at").readOnly = false;
			document.getElementById("late").readOnly = false;
			document.getElementById("early_leaving").readOnly = false;
			document.getElementById("overtime").readOnly = false;
			document.getElementById("attendance_date").readOnly = "";
			document.getElementById("shift_id").readOnly = false;
			document.getElementById("shift_id").disabled = false;
			// document.getElementById("attendance_status").readOnly = "";
			document.getElementById("arrived_at").readOnly = "";
			document.getElementById("left_at").readOnly = "";
			document.getElementById("late").readOnly = "";
			document.getElementById("early_leaving").readOnly = "";
			document.getElementById("overtime").readOnly = "";
			document.getElementById("btn_new_attendance").disabled = true;
		}

		function editAttendance(id, StatusAttendance) {
			document.getElementById("StatusAttendance").value = 'Edit';
			document.getElementById("btn_new_attendance").disabled = true;
			document.getElementById("shift_id").disabled = false;
			document.getElementById("btn_save_attendance").disabled = false;
			document.getElementById("attendance_date").readOnly = false;
			// document.getElementById("attendance_status").readOnly = false;
			document.getElementById("arrived_at").readOnly = false;
			document.getElementById("shift_id").readOnly = false;
			document.getElementById("left_at").readOnly = false;
			dataPost = {
				id: id,
				StatusAttendance: StatusAttendance
			}
			showLoading();
			$.ajax({
				url: '<?= base_url("hrm/timesheets/attendance/getAttendancebyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#id').val(data[0]['id']);
						$('#attendance_date').val(data[0]['attendance_date']);
						$('#arrived_at').val(data[0]['arrived_at']);
						$('#shift_id').val(data[0]['shift_id']);
						$('#left_at').val(data[0]['left_at']);

						$('#staff_id').val(data[0]['staff_id']);
						$('#first_name').val(data[0]['first_name']);
						$('#last_name').val(data[0]['last_name']);
						$('#email').val(data[0]['email']);
						$('#phone').val(data[0]['phone']);
						$('#address').val(data[0]['address']);

						$('#StatusAttendance').val('Edit');
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
				url: '<?= base_url("hrm/timesheets/attendance/getAttendancebyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#code_hapus').val(data[0]['id']);

						document.getElementById("headermodalhapus").innerHTML = "Delete Manage Shift  ";
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
				url: '<?= base_url("hrm/timesheets/attendance/deleteAttendance") ?>',
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
