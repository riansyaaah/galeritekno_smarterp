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
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Date :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<div class="input-group">
													<input type="hidden" id="holiday_id" name="example-input2-group2" class="form-control form-control-sm col-md-12">
													<input type="text" id="date" name="example-input2-group2" class="form-control form-control-sm col-md-12" readonly>
													<span class="input-group-append">
														<button href="#" id="btn_cari_holiday" class="edit_record btn btn-primary btn-sm" onclick="cariHoliday()"><i class="fas fa-list-ul"></i></button>
													</span>
												</div>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Day :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<input class="form-control form-control-sm" id="day" type="text" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Description :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<input class="form-control form-control-sm" id="holiday_description" type="text" readonly>
											</div>
										</div>

									</div>
								</div>

								<div class="card-body">
									<div class="loader" style="display:block"></div>
									<button type="button" class="btn  btn-primary btn-sm mb-2" id="btn_add_staff" onclick="add()" disabled><i class="fa fa-plus"></i> Add Staff</button>
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="table-holiday-shifting" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Staff Name</th>
													<th>ID</th>
													<th>Department</th>
													<th>Position</th>
													<th>Date</th>
													<th>Shift</th>
													<th width="150px">#</th>
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
			<?php $this->load->view('layout/v_footer'); ?>
		</div>

		<!-- Add Modal -->
		<div class="modal fade" id="AddModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headermodaltambah"></h5>
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
							<div class="section-title" id="title_shift"></div>
							<select class="form-control form-control-sm" id="shift_id">
								<?php foreach ($shifts as $shift) : ?>
									<option value="<?= $shift->shift ?>"><?= $shift->id; ?> | <?= $shift->day; ?></option>
								<?php endforeach; ?>
							</select>
						</div>

					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnAddStaff" onclick="return save()">
							<i class="fa fa-check"></i> SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Delete Modal -->
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
						<button class="btn btn-danger" type="button" id="btnDelete" onclick="return itemHapus()"> <i class="fa fa-trash"></i> Delete </button>
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Cari Holiday -->
		<div class="modal fade" id="cariHoliday" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Holiday</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-hover" id="table-holiday" style="width:100%;">
							<thead>
								<tr>
									<th width="50px">Holiday ID</th>
									<th class="text-center">Day</th>
									<th class="text-center">Date</th>
									<th class="text-center">Description</th>
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

				loadData()

				$("#description").change(function() {
					$("#description").removeClass("is-invalid");
				});
				$("#shift_id").change(function() {
					$("#shift_id").removeClass("is-invalid");
				});

				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			function loadData() {
				$("#table-holiday-shifting").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/Holiday_shifting/getHolidayShifting") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'staff_name'
						},
						{
							"data": 'staff_id'
						},
						{
							"data": 'department'
						},
						{
							"data": 'position'
						},
						{
							"data": 'date'
						},
						{
							"data": 'shift'
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [7]
					}]
				});
			}

			function add() {
				$('#status').val('tambah');
				document.getElementById("btnAddStaff").innerHTML = '<i class="fa fa-check"></i> SAVE';
				document.getElementById("btnAddStaff").disabled = false;
				document.getElementById('staff_id').value = ""
				document.getElementById('staff_name').value = ""
				document.getElementById('shift_id').value = ""
				document.getElementById('code').value = ""

				$("#staff_name").removeClass("is-invalid");
				$("#shift_id").removeClass("is-invalid");

				document.getElementById("headermodaltambah").innerHTML = "ADD STAFF";
				document.getElementById("title_staff_name").innerHTML = "Staff";
				document.getElementById("title_shift").innerHTML = "Shift";

				dismisLoading();
				$("#AddModal").modal();
			}

			function edit(id, status) {
				document.getElementById("headermodaltambah").innerHTML = "";
				dataPost = {
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/staffmanagement/holiday_shifting/getHolidayShiftingById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code').val(data['id']);
							$('#staff_name').val(data['staff_id']);
							$('#staff_id').val(data['staff_id']);
							$('#holiday_id').val(data['holiday_id']);

							$('#shift_id').val(data['shift_id']);
							$('#status').val('edit');

							$("#staff_name").removeClass("is-invalid");
							$("#shift_id").removeClass("is-invalid");

							document.getElementById("headermodaltambah").innerHTML = "EDIT STAFF";
							document.getElementById("btnAddStaff").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnAddStaff").disabled = false;
							document.getElementById("title_staff_name").innerHTML = "Staff";
							document.getElementById("title_shift").innerHTML = "Shift";
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
				var btn = document.getElementById("btnAddStaff");
				var code = $('#code').val();
				var staff_id = $('#staff_id').val();
				var shift_id = $('#shift_id').val();
				var holiday_id = $('#holiday_id').val();
				var status = $('#status').val();

				if (staff_id == "" || staff_id == null || shift_id == "" || shift_id == null) {
					if (staff_id == "" || staff_id == null) {
						$("#staff_name").addClass("is-invalid");
					}
					if (shift_id == "" || shift_id == null) {
						$("#shift_id").addClass("is-invalid");
					}
					showSnackError("The field(s) is required");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code,
						holiday_id: holiday_id,
						staff_id: staff_id,
						shift_id: shift_id,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/staffmanagement/holiday_shifting/saveHolidayShifting") ?>',
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
							showSnackError("Periode Sudah ada!");
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
					url: '<?php echo base_url("hrm/staffmanagement/holiday_shifting/getHolidayShiftingById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							document.getElementById("btnDelete").innerHTML = '<i class="fa fa-trash"></i> DELETE';
							document.getElementById("btnDelete").disabled = false;
							$('#code_hapus').val(data['id']);

							document.getElementById("headermodalhapus").innerHTML = "Delete HolidayShifting ";
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data['id'] +
								"? ";

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
					url: '<?php echo base_url("hrm/staffmanagement/holiday_shifting/deleteHolidayShifting") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							// HolidayShiftingCari();
							loadData()
							$('#hapusModal').modal('hide');
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

			function cariHoliday() {
				showLoading();
				$("#table-holiday").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/timesheets/Holidays/getHolidays") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'id',
						},
						{
							"data": 'date',
						},
						{
							"data": 'day',
						},
						{
							"data": 'description',
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [0]
					}]
				});

				dismisLoading();
				$("#cariHoliday").modal();

				$('#table-holiday tbody').on('click', 'tr', function() {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var holiday_id = $td.eq(0).text();
					var date = $td.eq(1).text();
					var day = $td.eq(2).text();
					var holiday_description = $td.eq(3).text();

					document.getElementById("holiday_id").value = holiday_id;
					document.getElementById("date").value = date;
					document.getElementById("day").value = day;
					document.getElementById("holiday_description").value = holiday_description;

					document.getElementById("btn_add_staff").disabled = false;
					$('#cariHoliday').modal('hide');
					HolidayShiftingCari();
				});
			}

			function HolidayShiftingCari() {
				showLoading();
				holiday_id = document.getElementById("holiday_id").value;
				dataPost = {
					holiday_id: holiday_id,
				}
				$("#table-holiday-shifting").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/staffmanagement/holiday_shifting/getHolidayShiftByHolidayId") ?>',
						dataSrc: 'data',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'staff_name'
						},
						{
							"data": 'staff_id'
						},
						{
							"data": 'department'
						},
						{
							"data": 'position'
						},
						{
							"data": 'date'
						},
						{
							"data": 'shift'
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [7]
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
