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
										<button class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add Department</button>
									</div>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
										<table class="table table-striped" id="table-menu">
											<thead>
												<tr>
													<th>No</th>
													<th>Initial</th>
													<th>Department</th>
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
							<div class="section-title" id="title_initial"></div>
							<input type="text" class="form-control form-control-sm" id="initial" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_department"></div>
							<input type="text" class="form-control form-control-sm" id="department" required="">
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
						<button class="btn btn-primary" type="button" id="btnDelete" onclick="return itemHapus()"> <i class="fa fa-trash"></i> Delete </button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
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
				$("#table-menu").dataTable({
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/managedepartement/getManageDepartment") ?>',
						dataSrc: 'data'
					},
					columns: [{
						"data": 'no',
					}, {
						"data": 'initial',
					}, {
						"data": 'department'
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
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});


			function add(id, status) {
				dataPost = {
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/staffmanagement/managedepartement/getManageDepartment") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#status').val('tambah');
							$('#code').val('id');
							document.getElementById('initial').value = ""
							document.getElementById('department').value = ""
							document.getElementById('description').value = ""
							$("#department").removeClass("is-invalid");
							document.getElementById("headermodaltambah").innerHTML = "ADD DEPARTMENT";
							document.getElementById("title_initial").innerHTML = "INITIAL";
							document.getElementById("title_department").innerHTML = "DEPARTMENT";
							document.getElementById("title_description").innerHTML = "DESCRIPTION";
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
					url: '<?php echo base_url("hrm/staffmanagement/managedepartement/getManageDepartmentbyid") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code').val(data[0]['id']);
							$('#initial').val(data[0]['initial']);
							$('#department').val(data[0]['department']);
							$('#description').val(data[0]['description']);
							$('#status').val('edit');
							$("#department").removeClass("is-invalid");
							document.getElementById("headermodaltambah").innerHTML = "EDIT DEPARTMENT";
							document.getElementById("title_initial").innerHTML = "INITIAL";
							document.getElementById("title_department").innerHTML = "DEPARTMENT";
							document.getElementById("title_description").innerHTML = "DESCRIPTION";
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
				var initial = $('#initial').val();
				var department = $('#department').val();
				var description = $('#description').val();
				var status = $('#status').val();

				if (department == "" || department == null) {
					showSnackError("Harap isi Code");
					$("#department").addClass("is-invalid");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code,
						initial: initial,
						department: department,
						description: description,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/staffmanagement/managedepartement/saveManageDepartement") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								success(res.remarks)
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
					url: '<?php echo base_url("hrm/staffmanagement/managedepartement/getManageDepartmentbyid") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code_hapus').val(data[0]['id']);

							document.getElementById("headermodalhapus").innerHTML = "Delete Department  " + data[0]['department'];
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data[0]['department'] + " ?";

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
					url: '<?php echo base_url("hrm/staffmanagement/managedepartement/deleteManageDepartement") ?>',
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

			$(document).on('click', '#btn-detail', function() {
				const id = $(this).data('id');
				alert(id)
			})
		</script>
</body>

</html>
