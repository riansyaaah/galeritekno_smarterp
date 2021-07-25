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
									<div class="col-sm-4">
										<button class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add Contract</button>
									</div>
								</div>

								<div class="card-body">
									<div class="loader" style="display:block"></div>
									<div class="table-responsive">
										<table class="table table-bordered table-hover" id="table-menu" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Duration</th>
													<th>Day(s)</th>
													<th>Description</th>
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

		<!-- Add Modal -->
		<div class="modal fade" id="tambahModal" role="dialog" aria-hidden="true">
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
							<div class="section-title" id="title_duration"></div>
							<input type="number" class="form-control form-control-sm" id="duration" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_days"></div>
							<input type="number" class="form-control form-control-sm" id="days" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_description"></div><textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return save()">
							<i class="fa fa-check"></i> SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
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
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
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

			$("#duration").change(function() {
				$("#duration").removeClass("is-invalid");
			});
			$("#days").change(function() {
				$("#days").removeClass("is-invalid");
			});
			$("#description").change(function() {
				$("#description").removeClass("is-invalid");
			});

			function loadData() {
				$("#table-menu").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/master/contracts/getContract") ?>',
						dataSrc: 'data'
					},
					columns: [{
						"data": 'no',
					}, {
						"data": 'duration',
					}, {
						"data": 'days'
					}, {
						"data": 'description'
					}, {
						"data": 'option'
					}],
					"columnDefs": [{
						"sortable": false,
						"targets": [4]
					}]
				});
			}


			function add(id, status) {
				dataPost = {
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/master/contracts/getContract") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#status').val('tambah');
							$('#code').val('id');
							document.getElementById('duration').value = ""
							document.getElementById('days').value = ""
							document.getElementById('description').value = ""
							$("#duration").removeClass("is-invalid");
							$("#days").removeClass("is-invalid");
							$("#description").removeClass("is-invalid");
							document.getElementById("headermodaltambah").innerHTML = "ADD DURATION ";
							document.getElementById("title_duration").innerHTML = "DURATION (Months)";
							document.getElementById("title_days").innerHTML = "DAYS";
							document.getElementById("title_description").innerHTML = "DESCRIPTION";

							document.getElementById("btnItemBaru").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnItemBaru").disabled = false;

							dismisLoading();
							$("#tambahModal").modal();
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
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/master/contracts/getContractbyid") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code').val(data['id']);
							$('#duration').val(data['duration']);
							$('#days').val(data['days']);
							$('#description').val(data['description']);
							$('#status').val('edit');

							$("#description").removeClass("is-invalid");
							$("#duration").removeClass("is-invalid");
							$("#days").removeClass("is-invalid");
							$("#description").removeClass("is-invalid");

							document.getElementById("headermodaltambah").innerHTML = "EDIT DURATION ";
							document.getElementById("title_duration").innerHTML = "DURATION (Months)";
							document.getElementById("title_days").innerHTML = "DAYS";
							document.getElementById("title_description").innerHTML = "DESCRIPTION";

							document.getElementById("btnItemBaru").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnItemBaru").disabled = false;

							dismisLoading();
							$("#tambahModal").modal();
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
				var duration = $('#duration').val();
				var days = $('#days').val();
				var description = $('#description').val();
				var status = $('#status').val();

				if (duration == "" || duration == null || days == "" || days == null || description == "" || description == null) {
					if (duration == "" || duration == null) {
						$("#duration").addClass("is-invalid");
					}
					if (days == "" || days == null) {
						$("#days").addClass("is-invalid");
					}
					if (description == "" || description == null) {
						$("#description").addClass("is-invalid");
					}
					showSnackError("The Field(s) is required");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code,
						duration: duration,
						days: days,
						description: description,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/master/contracts/saveContract") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								// success(res.remarks)
								loadData();
								$('#tambahModal').modal('hide');
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
					url: '<?php echo base_url("hrm/master/contracts/getContractbyid") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code_hapus').val(data['id']);

							document.getElementById("headermodalhapus").innerHTML = "Delete Contract : " + data['description'];
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data['description'] + " ?";

							dismisLoading();

							document.getElementById("btnDelete").innerHTML = '<i class="fa fa-trash"></i> Delete';
							document.getElementById("btnDelete").disabled = false;

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
					url: '<?php echo base_url("hrm/master/contracts/deleteContract") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							// success(res.remarks)
							loadData();
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
