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
										<button class="btn btn-primary" onclick="add()"><i class="fa fa-plus"></i> Add Allowance</button>
									</div>
								</div>

								<div class="card-body">
									<div class="loader" style="display:block"></div>
									<div class="table-responsive">
										<table class="table table-bordered table-hover " id="table-menu" style="width: 100%;">
											<thead>
												<tr>
													<th>No</th>
													<th>Allowance</th>
													<th>Amount (Rp)</th>
													<th>Set Date</th>
													<th>Type</th>
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
							<div class="section-title" id="title_allowance_name"></div>
							<input type="text" class="form-control form-control-sm" id="allowance_name" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_amount"></div>
							<input type="number" class="form-control form-control-sm" id="amount" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_type"></div>
							<select name="type" id="type" class="form-control">
								<option value="">Pilih Type</option>
								<option value="daily">Daily</option>
								<option value="monthly">Monthly</option>
								<option value="yearly">Yearly</option>
								<option value="one_time">One Time</option>
							</select>
						</div>
						<div class="form-group">
							<div class="section-title" id="title_set_date"></div>
							<input type="date" class="form-control form-control-sm" id="set_date" required="">
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
		<div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
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
				loadData();
				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			$("#allowance_name").change(function() {
				$("#allowance_name").removeClass("is-invalid");
			});
			$("#type").change(function() {
				$("#type").removeClass("is-invalid");
			});
			$("#amount").change(function() {
				$("#amount").removeClass("is-invalid");
			});
			$("#set_date").change(function() {
				$("#set_date").removeClass("is-invalid");
			});
			$("#description").change(function() {
				$("#description").removeClass("is-invalid");
			});

			function loadData() {
				$("#table-menu").dataTable({
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/master/Allowances/getAllowance") ?>',
						dataSrc: 'data'
					},
					columns: [{
						"data": 'no',
					}, {
						"data": 'allowance_name',
					}, {
						"data": 'amount'
					}, {
						"data": 'set_date'
					}, {
						"data": "allowance_type"
					}, {
						"data": 'description'
					}, {
						"data": 'option'
					}],
					"columnDefs": [{
						"sortable": false,
						"targets": [6]
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
					url: '<?php echo base_url("hrm/master/Allowances/getAllowance") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#status').val('tambah');
							$('#code').val('id');
							document.getElementById('allowance_name').value = ""
							document.getElementById('amount').value = ""
							document.getElementById('set_date').value = ""
							document.getElementById('type').value = ""
							document.getElementById('description').value = ""
							$("#allowance_name").removeClass("is-invalid");
							$("#amount").removeClass("is-invalid");
							$("#type").removeClass("is-invalid");
							$("#set_date").removeClass("is-invalid");
							$("#description").removeClass("is-invalid");
							document.getElementById("headerModal").innerHTML = "ADD ALLOWANCE ";
							document.getElementById("title_allowance_name").innerHTML = "NAME";
							document.getElementById("title_amount").innerHTML = "AMOUNT";
							document.getElementById("title_type").innerHTML = "TYPE";
							document.getElementById("title_set_date").innerHTML = "SET DATE";
							document.getElementById("title_description").innerHTML = "DESCRIPTION";

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

			function edit(id, status) {
				document.getElementById("headerModal").innerHTML = "";
				dataPost = {
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/master/Allowances/getAllowanceById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code').val(data['id']);
							$('#allowance_name').val(data['allowance_name']);
							$('#amount').val(data['amount']);
							$('#type').val(data['allowance_type']);
							$('#set_date').val(data['set_date']);
							$('#description').val(data['description']);
							$('#status').val('edit');

							$("#allowance_name").removeClass("is-invalid");
							$("#amount").removeClass("is-invalid");
							$("#set_date").removeClass("is-invalid");
							$("#description").removeClass("is-invalid");
							$("#type").removeClass("is-invalid");
							document.getElementById("headerModal").innerHTML = "EDIT DURATION ";
							document.getElementById("title_allowance_name").innerHTML = "ALLOWANCE NAME";
							document.getElementById("title_amount").innerHTML = "AMOUNT (Rp)";
							document.getElementById("title_set_date").innerHTML = "SET DATE";
							document.getElementById("title_description").innerHTML = "DESCRIPTION";
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
				var allowance_name = $('#allowance_name').val();
				var amount = $('#amount').val();
				var set_date = $('#set_date').val();
				var description = $('#description').val();
				var type = $('#type').val();
				var status = $('#status').val();

				if (allowance_name == "" || allowance_name == null || amount == "" || amount == null || type == "" || type == null || set_date == "" || set_date == null || description == "" || description == null) {
					if (allowance_name == "" || allowance_name == null) {
						$("#allowance_name").addClass("is-invalid");
					}
					if (amount == "" || amount == null) {
						$("#amount").addClass("is-invalid");
					}
					if (set_date == "" || set_date == null) {
						$("#set_date").addClass("is-invalid");
					}
					if (type == "" || type == null) {
						$("#type").addClass("is-invalid");
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
						allowance_name: allowance_name,
						amount: amount,
						type: type,
						set_date: set_date,
						description: description,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/master/Allowances/saveAllowance") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								// success(res.remarks)
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
					url: '<?php echo base_url("hrm/master/Allowances/getAllowanceById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code_hapus').val(data['id']);

							document.getElementById("headerModalDelete").innerHTML = "Delete Allowance : " + data['allowance_name'];
							document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data['allowance_name'] + " ?";

							dismisLoading();

							document.getElementById("btnDelete").innerHTML = '<i class="fa fa-trash"></i> SAVE';
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
					url: '<?php echo base_url("hrm/master/Allowances/deleteAllowance") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
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
