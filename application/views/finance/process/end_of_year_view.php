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

</head>

<body>
	<div class="loader"></div>
	<div id="snackbar_custom"></div>

	<!-- Application -->
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
										<a href="#" class="edit_record btn btn-warning btn-sm" onclick="addNewOrders()">
											<i class="fa fa-plus"></i> Add New Orders</a>
									</div>
								</div>

								<!-- Table -->
								<div class="col-md-12">
									<div class="card-body">
										<div class="table table-responsive">
											<div class="loader" style="display:block"></div>
											<table class="table table-bordered table-hover" id="table-menu">
												<thead>
													<tr>
														<th>No</th>
														<th>Company_Id</th>
														<th>NoRef</th>
														<th>Tgl</th>
														<th>Uraian</th>
														<th>KdTrans</th>
														<th>AccountNo</th>
														<th class="text-center">Action</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
								<!-- End Table -->

							</div>
						</div>
					</div>
					<section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>

		<!-- Modal Add -->
		<div class="modal fade" id="addNewOrders" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Add New Orders</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="form-group col-md-4">
								<label for="useremail">ClientID </label>
								<input type="text" class="form-control form-control-sm" id="code" required="">
							</div>
							<div class="form-group col-md-4">
								<label for="useremail">ClientName</label>
								<input type="text" class="form-control form-control-sm" id="description" required="">
							</div>
							<div class="form-group col-md-4">
								<label for="useremail">Address_NPWP</label>
								<input type="text" class="form-control form-control-sm" id="Address_NPWP" required="">
							</div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnAddRecord" onclick="return departementBaru()">
							<i class="fa fa-check"></i> Save
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Add -->

		<!-- Modal Edit -->
		<div class="modal fade" id="editDepartement" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Edit Data Departement</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<div class="form-group">
							<label for="useremail">Code</label>
							<input type="text" class="form-control form-control-sm" id="code_edit" required="" readonly>
						</div>
						<div class="form-group">
							<label for="useremail">Description</label>
							<input type="text" class="form-control form-control-sm" id="description_edit" required="">
						</div>

					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemEdit" onclick="return departementEdit()">
							Update
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Edit -->

		<!-- Modal Delete -->
		<div class="modal fade" id="hapusDepartement" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headermodalhapusdepartement'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="code_hapus" class="form-control">
						<div class="section-title" id='infohapusdepartement'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnDeleteDepartement" onclick="return departementHapus()"> Hapus </button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
		<!-- End Modal Delete -->

	</div>

	<!-- Script -->
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
		// Load Data
		$(document).ready(function() {
			$("#table-menu").dataTable({
				ajax: {
					url: '<?php echo base_url("finance/process/eoyp/get_data") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'no',
					}, {
						"data": 'Company_Id',
					},
					{
						"data": 'NoRef'
					},
					{
						"data": 'Tgl'
					},
					{
						"data": 'Uraian'
					},
					{
						"data": 'KdTrans'
					},
					{
						"data": 'AccountNo'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [5]
				}],
			});
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});

		// Add Data Orders
		function addNewOrders() {
			showLoading();
			dismisLoading();
			$("#addNewOrders").modal();
		}

		// Proses Add Data Orders
		function departementBaru() {
			var btn = document.getElementById("btnAddRecord");
			var code = $('#code').val();
			var description = $('#description').val();

			if (code == "" || code == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					code: code,
					description: description,
				}
				$.ajax({
					url: '<?php echo base_url("finance/masterdata/addDepartement") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							success(res.remarks)
						} else {
							btn.value = 'SIMPAN';
							btn.innerHTML = 'SIMPAN';
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

		// Edit Data Orders
		function editDepartement(code) {
			dataPost = {
				code: code
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/masterdata/getDepartementbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#code_edit').val(data[0]['Kode_Dep']);
						$('#description_edit').val(data[0]['Nama_Dep']);

						dismisLoading();
						$("#editDepartement").modal();
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

		// Proses Edit Data Orders
		function departementEdit() {
			var btn = document.getElementById("btnItemEdit");
			var code_edit = $('#code_edit').val();
			var description_edit = $('#description_edit').val();

			if (description_edit == "" || description_edit == null) {
				showSnackError("Harap isi");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					code: code_edit,
					description: description_edit,
				}
				$.ajax({
					url: '<?php echo base_url("finance/masterdata/editDepartement") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							success(res.remarks)
						} else {
							btn.value = 'SIMPAN';
							btn.innerHTML = 'SIMPAN';
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

		// Delete Data Orders
		function hapusDepartement(code) {
			dataPost = {
				code: code
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/masterdata/getDepartementbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#code_hapus').val(data[0]['Kode_Dep']);

						document.getElementById("headermodalhapusdepartement").innerHTML = "Hapus Departement " + data[0]['Nama_Dep'];
						document.getElementById("infohapusdepartement").innerHTML = "Anda Yakin Untuk Menghapus Data Ini : " + data[0]['Nama_Dep'] + " ?";

						dismisLoading();
						$("#hapusDepartement").modal();
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

		// Proses Delete Orders
		function departementHapus() {
			var btn = document.getElementById("btnDeleteDepartement");
			var code_hapus = $('#code_hapus').val();
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			dataPost = {
				code_hapus: code_hapus,
			}
			$.ajax({
				url: '<?php echo base_url("finance/masterdata/hapusDepartement") ?>',
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

		// SWEETALER 
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
	<!-- End Scrips -->
</body>

</html>