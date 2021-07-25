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
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Duration (minutes) :</label>
											<div class="col-sm-9" style="margin-top: 3px;">
												<div class="input-group">
													<input type="text" id="duration" class="form-control form-control-sm col-md-12" readonly>
													<span class="input-group-append">
														<button href="#" id="btn_cari_holiday" class="edit_record btn btn-primary btn-sm" onclick="cariDuration()"><i class="fas fa-list-ul"></i></button>
													</span>
												</div>
											</div>

										</div>

									</div>
								</div>

								<div class="card-body">
									<div class="loader" style="display:block"></div>
									<button type="button" class="btn  btn-primary btn-sm mb-2" id="btn_add_position" onclick="addPosition()" disabled><i class="fa fa-plus"></i> Add Position</button>
									<div class="table-responsive">
										<table class="table table-hover table-bordered" id="table-late-position" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Position</th>
													<th>Department</th>
													<th>Duration (minutes)</th>
													<th>Amount</th>
													<th>Last Update</th>
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

		<!-- Modal Cari Lateness -->
		<div class="modal fade" id="cariDuration" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Data Lateness</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<button type="button" class="btn  btn-primary btn-sm mb-2" id="btn_add_duration" onclick="addDuration()"><i class="fa fa-plus"></i> Add Duration</button>
						<table class="table table-bordered table-hover" id="table-late-duration" style="width:100%;">
							<thead>
								<tr>
									<th width="30px">No</th>
									<th class="text-center">Duration (Minutes)</th>
									<th class="text-center">Pilih</th>
									<th width="150px" class="text-center">Aksi</th>
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

		<!-- Add Modal Duration -->
		<div class="modal fade" id="AddDurationModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="AddDurationModalHeader"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="status" class="form-control">
						<div class="form-group">
							<div class="section-title" id="title_duration"></div>
							<div class="input-group">
								<input type="number" id="form_duration" class="form-control form-control-sm col-md-12">
							</div>
						</div>
						<div class="form-group" id="new_duration">
							<div class="section-title" id="title_new_duration"></div>
							<div class="input-group">
								<input type="number" id="form_new_duration" class="form-control form-control-sm col-md-12">
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnAddDuration" onclick="return saveDuration()">
							<i class="fa fa-check"></i> SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Delete Modal Duration -->
		<div class="modal fade" id="DeleteDurationModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headermodalhapus'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="kode_hapus_duration" class="form-control">
						<div class="section-title" id='infohapus'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-danger" type="button" id="btnDeleteDuration" onclick="return itemHapus()"> <i class="fa fa-trash"></i> Delete </button>
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>


		<!-- Add Modal Position -->
		<div class="modal fade" id="AddPositionModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="AddPositionModalHeader"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="status_position" class="form-control">
						<input type="hidden" id="id_position" class="form-control">
						<div class="form-group">
							<div class="section-title mt-3" id="title_duration_id"></div>
							<div class="input-group">
								<input type="number" id="duration_id" class="form-control form-control-sm col-md-12" readonly>
							</div>
							<br>
							<div class="section-title" id="title_position"></div>
							<div class="input-group">
								<select name="position" class="form-control" id="position">
									<option value="">Pilih Posisi:</option>
									<option value="999">Untuk Semua Posisi</option>
									<?php foreach ($positios as $position) : ?>
										<option value="<?= $position['id']; ?>"><?= $position['position']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="section-title mt-3 mb-2" id="title_type"></div>
							<input type="hidden" id="type_penalty" class="form-control">
							<div class="input-group">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="type_penalty" id="type-percent">
									<label class="form-check-label" for="type-percent">
										Persen
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="type_penalty" id="type-nominal">
									<label class="form-check-label" for="type-nominal">
										Nominal
									</label>
								</div>
							</div>
							<div class="section-title mt-3" id="title_amount"></div>
							<div class="input-group">
								<input type="number" step="any" id="amount" class="form-control form-control-sm col-md-12">
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnAddPosition" onclick="return savePosition()">
							<i class="fa fa-check"></i> SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Delete Modal Position -->
		<div class="modal fade" id="DeletePositionModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='HeaderModalPositionHapus'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="kode_hapus_position" class="form-control">
						<div class="section-title" id='infoPositionHapus'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-danger" type="button" id="btnDeletePosition" onclick="return positionHapus()"> <i class="fa fa-trash"></i> Delete </button>
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
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
				$('#AddDurationModal').on('shown.bs.modal', function() {
					$('#form_duration').trigger('focus');
				});

				$('#AddDurationModal').on('shown.bs.modal', function() {
					$('#form_new_duration').trigger('focus');
				});

				loadData()

				$("#description").change(function() {
					$("#description").removeClass("is-invalid");
				});
				$("#shift_id").change(function() {
					$("#shift_id").removeClass("is-invalid");
				});


				$("#type-percent").click(function() {
					if ($(this).is(':checked')) {
						document.getElementById("title_amount").innerHTML = "Percent (%)";
						$('#type_penalty').val('1');
					}
				});

				$("#type-nominal").click(function() {
					if ($(this).is(':checked')) {
						document.getElementById("title_amount").innerHTML = "Nominal (Rp.)";
						$('#type_penalty').val('2');
					}
				});

				$("#position").change(function() {
					$("#position").removeClass("is-invalid");
				});
				$("#amount").change(function() {
					$("#amount").removeClass("is-invalid");
				});

				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			function loadData() {
				$("#table-late-duration-shifting").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/lateness/getLatenessByDurationId") ?>',
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

			function addDuration() {
				$('#status').val('tambah');
				document.getElementById("btnAddDuration").innerHTML = '<i class="fa fa-check"></i> SAVE';
				document.getElementById("btnAddDuration").disabled = false;
				document.getElementById("form_duration").readOnly = false;
				document.getElementById('form_duration').value = ""
				document.getElementById('form_new_duration').value = "0" //trik

				$("#form_duration").removeClass("is-invalid");
				$('#new_duration').hide();
				document.getElementById("AddDurationModalHeader").innerHTML = "ADD DURATION";
				document.getElementById("title_duration").innerHTML = "Duration in minute(s)";


				dismisLoading();
				$("#AddDurationModal").modal();
				document.getElementById('form_duration').autofocus = true
			}

			function editDuration(duration, new_duration, status) {
				document.getElementById("AddDurationModalHeader").innerHTML = "";
				dataPost = {
					duration: duration,
					new_duration: new_duration,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/timesheets/lateness/getLateDurationById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#form_duration').val(data['duration']);
							$('#status').val('edit');
							$('#new_duration').show();

							$("#form_duration").removeClass("is-invalid");
							$("#form_new_duration").removeClass("is-invalid");

							document.getElementById("AddDurationModalHeader").innerHTML = "EDIT DURATION";
							document.getElementById("btnAddDuration").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnAddDuration").disabled = false;

							document.getElementById("form_duration").readOnly = true;
							document.getElementById("title_duration").innerHTML = "Duration in minute(s)";

							document.getElementById("title_new_duration").innerHTML = "New Duration in minute(s)";
							document.getElementById('form_new_duration').value = ""
							dismisLoading();
							$("#AddDurationModal").modal();
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

			function saveDuration() {
				var btn = document.getElementById("btnAddDuration");
				var duration = $('#form_duration').val();
				var new_duration = $('#form_new_duration').val();
				var status = $('#status').val();

				if (duration == "" || duration == null || new_duration == "" || new_duration == null) {
					if (duration == "" || duration == null) {
						$("#form_duration").addClass("is-invalid");
					}
					if (new_duration == "" || new_duration == null) {
						$("#form_new_duration").addClass("is-invalid");
					}
					showSnackError("The Fiel(s) is required");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						duration: duration,
						new_duration: new_duration,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/timesheets/lateness/saveLateDuration") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								loadDurasi();
								$('#AddDurationModal').modal('hide');
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
							showSnackError("Durasi Sudah Ada!");
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}

			function hapusDuration(duration) {
				dataPost = {
					duration: duration
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/timesheets/lateness/getLateDurationById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							document.getElementById("btnDeleteDuration").innerHTML = '<i class="fa fa-trash"></i> DELETE';
							document.getElementById("btnDeleteDuration").disabled = false;
							$('#kode_hapus_duration').val(data['duration']);

							document.getElementById("headermodalhapus").innerHTML = "Delete Late Duration ";
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data['duration'] +
								"? ";

							dismisLoading();
							$("#DeleteDurationModal").modal();
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
				var btn = document.getElementById("btnDeleteDuration");
				var kode_hapus_duration = $('#kode_hapus_duration').val();
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					kode_hapus_duration: kode_hapus_duration,
				}
				$.ajax({
					url: '<?php echo base_url("hrm/timesheets/lateness/deleteLateDuration") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							// HolidayShiftingCari();
							loadDurasi()
							$('#DeleteDurationModal').modal('hide');
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

			function cariDuration() {
				showLoading();
				loadDurasi();

				dismisLoading();
				$("#cariDuration").modal();

				$('#table-late-duration tbody').on('click', 'a', function() {
					event.preventDefault();
					var $td = $(this).closest('tr').children('td');

					var duration = $td.eq(1).text();

					document.getElementById("duration").value = duration;
					document.getElementById('duration_id').value = duration;

					document.getElementById("btn_add_position").disabled = false;
					$('#cariDuration').modal('hide');
					findPosition()
				});
			}

			function loadDurasi() {
				$("#table-late-duration").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/timesheets/lateness/getLateDurations") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'duration',
						},
						{
							"data": 'chose',
						},
						{
							"data": 'option',
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [2]
					}]
				});
			}

			function findPosition() {
				duration = document.getElementById("duration").value;
				dataPost = {
					duration: duration,
				}
				$("#table-late-position").dataTable({
					destroy: true,
					ajax: {
						url: '<?= base_url("hrm/timesheets/lateness/getPositionByDurationId") ?>',
						dataSrc: 'data',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
					},
					columns: [{
							"data": 'no',
						},
						{
							"data": 'position'
						},
						{
							"data": 'department'
						},
						{
							"data": 'duration'
						},
						{
							"data": 'amount'
						},
						{
							"data": 'last_update'
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [6]
					}]
				});
			}

			function addPosition() {
				$('#status_position').val('tambah');
				var duration = $('#duration').val();
				document.getElementById('duration_id').value = duration;
				document.getElementById("btnAddPosition").innerHTML = '<i class="fa fa-check"></i> SAVE';
				document.getElementById("btnAddPosition").disabled = false;
				document.getElementById('id_position').value = "";
				document.getElementById('position').value = "";
				$('#position').attr("disabled", false);
				document.getElementById('amount').value = "";

				$("#position").removeClass("is-invalid");
				$("#amount").removeClass("is-invalid");

				document.getElementById("AddPositionModalHeader").innerHTML = "ADD POSITION PENALTY";
				document.getElementById("title_duration_id").innerHTML = "Duration in minutes";
				document.getElementById("title_position").innerHTML = "Position";
				document.getElementById("title_type").innerHTML = "Type Amount";
				document.getElementById("title_amount").innerHTML = "Percent (%)";


				dismisLoading();
				$("#AddPositionModal").modal();
			}

			function editPosition(id, status) {
				document.getElementById("AddPositionModalHeader").innerHTML = "";
				dataPost = {
					id: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/timesheets/lateness/getLatePositionById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#status_position').val('edit');
							$('#id_position').val(data['id']);
							$("#duration").val(data['duration_id']);
							$("#duration_id").val(data['duration_id']);
							$("#position").val(data['position_id']);
							$('#position').attr("disabled", true);
							var type = data['type'];

							if (type == 1) {
								$("#type-percent").prop("checked", true);
								$('#type_penalty').val('1');
								$("#amount").val(data['percent']);
								document.getElementById("title_amount").innerHTML = "Percent (%)";
							} else {
								$("#type-nominal").prop("checked", true);
								$('#type_penalty').val('2');
								$("#amount").val(data['amount']);
								document.getElementById("title_amount").innerHTML = "Nominal (Rp.)";
							}

							$("#position").removeClass("is-invalid");
							$("#amount").removeClass("is-invalid");

							document.getElementById("AddPositionModalHeader").innerHTML = "EDIT POSITION PENALTY";
							document.getElementById("title_duration_id").innerHTML = "Duration in minutes";
							document.getElementById("title_position").innerHTML = "Position";
							document.getElementById("title_type").innerHTML = "Type Amount";

							document.getElementById("btnAddPosition").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnAddPosition").disabled = false;
							dismisLoading();
							$("#AddPositionModal").modal();
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

			function savePosition() {
				var btn = document.getElementById("btnAddPosition");
				var duration = $('#duration').val();
				var id = $('#id_position').val();
				var position = $('#position').val();
				var type_penalty = $('#type_penalty').val();
				var amount = $('#amount').val();
				var status = $('#status_position').val();
				if (position == "" || position == null || amount == "" || amount == null) {
					if (position == "" || position == null) {
						$("#position").addClass("is-invalid");
					}
					if (amount == "" || amount == null) {
						$("#amount").addClass("is-invalid");
					}
					showSnackError("The Fiel(s) is required");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						id: id,
						duration: duration,
						position: position,
						type_penalty: type_penalty,
						amount: amount,
						status: status,
					}

					$.ajax({
						url: '<?php echo base_url("hrm/timesheets/lateness/saveLatePosition") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								findPosition();
								$('#AddPositionModal').modal('hide');
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
							showSnackError("Durasi Sudah Ada!");
							btn.disabled = false;
						},
						timeout: 60000
					});
				}
			}

			function hapusPosition(id) {
				dataPost = {
					id: id
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/timesheets/lateness/getLatePositionById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							document.getElementById("btnDeletePosition").innerHTML = '<i class="fa fa-trash"></i> DELETE';
							document.getElementById("btnDeletePosition").disabled = false;
							$('#kode_hapus_position').val(data['id']);

							document.getElementById("HeaderModalPositionHapus").innerHTML = "Delete Late Position ";
							document.getElementById("infoPositionHapus").innerHTML = "Are you sure to delete this data : " + data['duration_id'] +
								"? ";

							dismisLoading();
							$("#DeletePositionModal").modal();
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

			function positionHapus() {
				var btn = document.getElementById("btnDeletePosition");
				var kode_hapus_position = $('#kode_hapus_position').val();
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					kode_hapus_position: kode_hapus_position,
				}
				$.ajax({
					url: '<?php echo base_url("hrm/timesheets/lateness/deleteLatePosition") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							findPosition()
							$('#DeletePositionModal').modal('hide');
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
