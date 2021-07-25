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

								<div class="card-body">
									<div class="table-responsive">
										<div class="loader" style="display:block"></div>
										<div class="table-responsive">
											<table class="table table-hover table-bordered" id="table-bpjs" style="width: 100%;">
												<thead>
													<tr>
														<th>BPJS TK</th>
														<th>BPJS Perusahaan</th>
														<th>BPJS TK %</th>
														<th>BPJS KES %</th>
														<th>Updated At</th>
														<th class="text-center" width="150px">Perbarui</th>
													</tr>
												</thead>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>

		<!-- Modal Add -->
		<div class="modal fade" id="addModal" role="dialog" aria-hidden="true">
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
							<div class="section-title" id="title_bpjs_tk"></div>
							<input type="number" class="form-control form-control-sm" id="bpjs_tk" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_bpjs_perusahaan"></div>
							<input type="number" class="form-control form-control-sm" id="bpjs_perusahaan" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_bpjs_tk_percent"></div>
							<input input type="number" step="any" class="form-control form-control-sm" id="bpjs_tk_percent" required="">
						</div>
						<div class="form-group">
							<div class="section-title" id="title_bpjs_kes_percent"></div>
							<input type="number" step="any" class="form-control form-control-sm" id="bpjs_kes_percent" required="">
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnSubmit" onclick="return save()">
							<i class="fa fa-check"></i> SAVE
						</button>
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
				loadData();

				$("#bpjs_tk").change(function() {
					$("#bpjs_tk").removeClass("is-invalid");
				});
				$("#bpjs_perusahaan").change(function() {
					$("#bpjs_perusahaan").removeClass("is-invalid");
				});
				$("#bpjs_tk_percent").change(function() {
					$("#bpjs_tk_percent").removeClass("is-invalid");
				});
				$("#bpjs_kes_percent").change(function() {
					$("#bpjs_kes_percent").removeClass("is-invalid");
				});

				var csfrData = {};
				csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
				$.ajaxSetup({
					data: csfrData
				});
			});

			function loadData() {
				$("#table-bpjs").dataTable({
					paging: false,
					ordering: false,
					info: false,
					searching: false,
					destroy: true,
					ajax: {
						url: '<?php echo base_url("hrm/master/bpjs/getBpjs") ?>',
						dataSrc: 'data'
					},
					columns: [{
							"data": 'bpjs_tk',
						},
						{
							"data": 'bpjs_perusahaan',
						},
						{
							"data": 'bpjs_tk_percent',
						},
						{
							"data": 'bpjs_kes_percent',
						},
						{
							"data": 'updated_at',
						},
						{
							"data": 'option'
						}
					],
					"columnDefs": [{
						"sortable": false,
						"targets": [0, 1, 2, 3, 4, 5]
					}]
				});
			}


			function edit(id, status) {
				document.getElementById("headerModal").innerHTML = "";
				dataPost = {
					code: id,
					status: status
				}
				showLoading();
				$.ajax({
					url: '<?php echo base_url("hrm/master/bpjs/getBpjsById") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							data = res.data;
							$('#code').val(data['id']);
							$('#bpjs_tk').val(data['bpjs_tk']);
							$('#bpjs_perusahaan').val(data['bpjs_perusahaan']);
							$('#bpjs_tk_percent').val(data['bpjs_tk_percent']);
							$('#bpjs_kes_percent').val(data['bpjs_kes_percent']);
							$('#status').val('edit');

							$("#bpjs_tk").removeClass("is-invalid");
							$("#bpjs_perusahaan").removeClass("is-invalid");
							$("#bpjs_tk_percent").removeClass("is-invalid");
							$("#bpjs_kes_percent").removeClass("is-invalid");

							document.getElementById("headerModal").innerHTML = "EDIT DATA BPJS";
							document.getElementById("title_bpjs_tk").innerHTML = "BPJS Ketenagakerjaan";
							document.getElementById("title_bpjs_perusahaan").innerHTML = "BPJS Perusanaan";
							document.getElementById("title_bpjs_tk_percent").innerHTML = "BPJS TK Percent %";
							document.getElementById("title_bpjs_kes_percent").innerHTML = "BPJS Kesehatan Percent %";

							document.getElementById("btnSubmit").innerHTML = '<i class="fa fa-check"></i> SAVE';
							document.getElementById("btnSubmit").disabled = false;
							dismisLoading();
							$("#addModal").modal();
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
				var btn = document.getElementById("btnSubmit");
				var code = $('#code').val();
				var bpjs_tk = $('#bpjs_tk').val();
				var bpjs_perusahaan = $('#bpjs_perusahaan').val();
				var bpjs_tk_percent = $('#bpjs_tk_percent').val();
				var bpjs_kes_percent = $('#bpjs_kes_percent').val();
				var status = $('#status').val();

				if (bpjs_tk == "" || bpjs_tk == null || bpjs_perusahaan == "" || bpjs_perusahaan == null || bpjs_tk_percent == "" || bpjs_tk_percent == null || bpjs_kes_percent == "" || bpjs_kes_percent == null) {
					if (bpjs_tk == "" || bpjs_tk == null) {
						$("#bpjs_tk").addClass("is-invalid");
					}
					if (bpjs_perusahaan == "" || bpjs_perusahaan == null) {
						$("#bpjs_perusahaan").addClass("is-invalid");
					}
					if (bpjs_tk_percent == "" || bpjs_tk_percent == null) {
						$("#bpjs_tk_percent").addClass("is-invalid");
					}
					if (bpjs_kes_percent == "" || bpjs_kes_percent == null) {
						$("#bpjs_kes_percent").addClass("is-invalid");
					}
					showSnackError("Harap isi");
				} else {
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code,
						bpjs_tk: bpjs_tk,
						bpjs_perusahaan: bpjs_perusahaan,
						bpjs_tk_percent: bpjs_tk_percent,
						bpjs_kes_percent: bpjs_kes_percent,
						status: status,
					}
					$.ajax({
						url: '<?php echo base_url("hrm/master/bpjs/saveBpjs") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								loadData();
								$('#addModal').modal('hide');
								showSnackSuccess(res.remarks);
							} else {
								btn.value = 'SAVE';
								btn.innerHTML = 'SAVE';
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
