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
					<div class="section-body">
						<div class="row">
							<div class="col-12 col-sm-12 col-lg-12">
								<div class="card" id="divTable">
									<div class="card-header">
										<h4><?= $title; ?></h4>
									</div>
									<div class="card-body">
										<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item">
												<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Basic Profile</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Emergency Contacts</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="qualifications-tab" data-toggle="tab" href="#qualifications" role="tab" aria-controls="qualifications" aria-selected="false">Qualifications</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="work-tab" data-toggle="tab" href="#work" role="tab" aria-controls="work" aria-selected="false">Work Experience</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" id="bank-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="bank" aria-selected="false">Bank Account</a>
											</li>

										</ul>
										<div class="tab-content" id="myTabContent">
											<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
												Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
												proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
											</div>
											<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
												Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis
												quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus.
												Etiam ac vehicula eros, pharetra consectetur dui. Aliquam convallis neque eget tellus efficitur,
												eget maximus massa imperdiet. Morbi a mattis velit. Donec hendrerit venenatis justo, eget
												scelerisque tellus pharetra a.
											</div>
											<div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
												Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa,
												gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum
												molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non
												ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices.
												Proin bibendum bibendum augue ut luctus.
											</div>
											<div class="tab-pane fade" id="qualifications" role="tabpanel" aria-labelledby="qualifications-tab">
												Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa,
												gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum
												molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non
												ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices.
												Proin bibendum bibendum augue ut luctus.
											</div>
											<div class="tab-pane fade" id="work" role="tabpanel" aria-labelledby="work-tab">
												Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa,
												gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum
												molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non
												ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices.
												Proin bibendum bibendum augue ut luctus.
											</div>
											<div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
												Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula massa,
												gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum, sem interdum
												molestie finibus, nulla diam varius leo, nec varius lectus elit id dolor. Nam malesuada orci non
												ornare vulputate. Ut ut sollicitudin magna. Vestibulum eget ligula ut ipsum venenatis ultrices.
												Proin bibendum bibendum augue ut luctus.
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
		<div class="modal fade" id="tambahModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headermodaltambah"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">
						<input type="hidden" id="statusdata" class="form-control">
						<input type="hidden" id="code" class="form-control">
						<div class="col-sm-6">
							<div class="form-group">
								<div class="section-title">First Name</div>
								<input type="text" class="form-control" id="firstname">
							</div>
							<div class="form-group">
								<div class="section-title">Last Name</div>
								<input type="text" class="form-control" id="lastname">
							</div>
							<div class="form-group">
								<div class="section-title">Email </div>
								<input type="email" class="form-control" id="email">
							</div>
							<div class="form-group">
								<div class="section-title">Phone</div>
								<input type="text" class="form-control" id="phone">
							</div>
							<div class="form-group">
								<div class="section-title">Address</div>
								<input type="text" class="form-control" id="address">
							</div>
							<div class="form-group">
								<div class="section-title">Province</div>
								<select id="prov_id" onchange="onChangeProvinces()" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">City</div>
								<select id="kab_id" class="form-control select2" onchange="onChangeRegencies()" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">District</div>
								<select id="kec_id" class="form-control select2" onchange="onChangeDisctricts()" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Village </div>
								<select id="desa_id" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Postal Code</div>
								<input type="text" class="form-control" id="postalcode">
							</div>
							<div class="section-title">Gender</div>
							<div class="form-group">
								<div class="pretty p-icon p-curve p-rotate">
									<input type="radio" name="edit_jenis_kelamin" id="edit_jenis_kelamin_l" value="L" checked>
									<div class="state p-success-o">
										<i class="icon material-icons">done</i>
										<label> Male</label>
									</div>
								</div>
								<div class="pretty p-icon p-curve p-rotate">
									<input type="radio" name="edit_jenis_kelamin" id="edit_jenis_kelamin_p" value="P">
									<div class="state p-success-o">
										<i class="icon material-icons">done</i>
										<label> Female</label>
									</div>
								</div>
							</div>

							<div class="section-title">Marital Status</div>
							<div class="form-group">
								<div class="pretty p-icon p-curve p-rotate">
									<input type="radio" name="maritalstatus" id="maritalstatus_s" value="Single" checked>
									<div class="state p-success-o">
										<i class="icon material-icons">done</i>
										<label> Single</label>
									</div>
								</div>
								<div class="pretty p-icon p-curve p-rotate">
									<input type="radio" name="maritalstatus" id="maritalstatus_m" value="Married">
									<div class="state p-success-o">
										<i class="icon material-icons">done</i>
										<label> Married </label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<div class="section-title">Birth Place</div>
								<input type="text" class="form-control" id="birthplace">
							</div>
							<div class="form-group">
								<div class="section-title">Birthday</div>
								<input type="date" class="form-control" id="birthday">
							</div>
							<div class="form-group">
								<div class="section-title">Shift</div>
								<select id="shift_id" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Designation</div>
								<select id="designation_id" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Position</div>
								<select id="position_id" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Departement</div>
								<select id="departement_id" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Date of Joining</div>
								<input type="date" class="form-control" id="dateofjoining">
							</div>
							<div class="form-group">
								<div class="section-title">Date of Leaving</div>
								<input type="date" class="form-control" id="dateofleaving">
							</div>
							<div class="form-group">
								<div class="section-title">Instansi</div>
								<select id="instansi_id" onchange="onChangeInstansi()" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="form-group">
								<div class="section-title">Branch</div>
								<select id="branch_id" class="form-control select2" style="width:100%"></select>
							</div>
							<div class="section-title">Set Aktif</div>
							<div class="form-group">
								<label class="custom-switch">
									<input type="checkbox" onclick="changeAktif()" checked onchange="changeAktif()" name="custom-switch-checkbox" id="edit_is_active" class="custom-switch-input">
									<span class="custom-switch-indicator"></span>
									<span class="custom-switch-description" id="label_is_active"></span>
								</label>
							</div>
						</div>

					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnSave" onclick="return save()">
							SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
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
				getData();

			});

			function getData() {
				$("#table-menu").dataTable({
					"processing": true,
					"serverSide": true,
					"order": [],
					"ajax": {
						"url": '<?php echo base_url("hrm/staffmanagement/staffprofile/getStaffProfile") ?>',
						"type": "POST",
					},
					"columnDefs": [{
							"targets": [0],
							"orderable": false,
							"className": "text-center",
						},
						{
							"targets": 8,
							"className": "text-center",
						},
					],
				});

				$("#prov_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getProvinces") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.name
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#kab_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getRegencies") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
								prov_id: $('#prov_id').val()
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.name
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#kec_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getDistricts") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
								kab_id: $('#kab_id').val()
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.name
								};
							});
							return {
								results: result
							};
						}
					},
				});
				$("#desa_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getVillages") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
								kec_id: $('#kec_id').val()
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.name
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#instansi_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getInstansi") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.instansi_id,
									text: item.nama_instansi
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#branch_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getBranch") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
								instansi_id: $('#instansi_id').val()
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.branch_id,
									text: item.nama_branch
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#shift_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getShift") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.shift
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#designation_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getDesignation") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.designation
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#position_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getPosition") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.position
								};
							});
							return {
								results: result
							};
						}
					},
				});

				$("#departement_id").select2({
					language: {
						searching: function() {
							return "Mohon tunggu ...";
						}
					},
					ajax: {
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/getDepartement") ?>',
						dataType: 'json',
						type: "GET",
						delay: 250,
						data: function(params) {
							return {
								search: params.term,
							};
						},
						processResults: function(res, params) {
							var result = res.data.map(function(item) {
								return {
									id: item.id,
									text: item.departement
								};
							});
							return {
								results: result
							};
						}
					},
				});



			};
			var table;

			function onChangeProvinces() {
				$("#kab_id").empty().trigger('change')
			}

			function onChangeRegencies() {
				$("#kec_id").empty().trigger('change')
			}

			function onChangeDisctricts() {
				$("#desa_id").empty().trigger('change')
			}

			function onChangeInstansi() {
				$("#branch_id").empty().trigger('change')
			}

			function changeAktif() {
				if (document.getElementById('edit_is_active').checked) {
					document.getElementById("label_is_active").innerHTML = "Aktif";
				} else {
					document.getElementById("label_is_active").innerHTML = "Tidak Aktif";
				}
			}

			function add() {
				document.getElementById('statusdata').value = "tambah"
				document.getElementById('code').value = ""
				document.getElementById('firstname').value = ""
				document.getElementById('lastname').value = ""
				document.getElementById('email').value = ""
				document.getElementById('phone').value = ""
				document.getElementById('address').value = ""
				document.getElementById('postalcode').value = ""
				document.getElementById('birthplace').value = ""
				document.getElementById('birthday').value = ""
				document.getElementById('birthplace').value = ""
				document.getElementById('dateofjoining').value = ""
				document.getElementById('dateofleaving').value = ""
				document.getElementById('edit_is_active').value = ""
				document.getElementById('edit_jenis_kelamin_l').checked = true;
				document.getElementById('maritalstatus_s').checked = true;
				document.getElementById("headermodaltambah").innerHTML = 'ADD STAFF PROFILE';
				$("#prov_id").empty().trigger('change')
				$("#kab_id").empty().trigger('change')
				$("#kec_id").empty().trigger('change')
				$("#desa_id").empty().trigger('change')
				$("#shift_id").empty().trigger('change')
				$("#designation_id").empty().trigger('change')
				$("#position_id").empty().trigger('change')
				$("#departement_id").empty().trigger('change')
				$("#tambahModal").modal();
			}


			function save() {
				var statusdata = $('#statusdata').val();
				var code = $('#code').val();
				var firstname = $('#firstname').val();
				var lastname = $('#lastname').val();
				if (document.getElementById('edit_is_active').checked) {
					var is_active = 1;
				} else {
					var is_active = 0;
				}
				var email = $('#email').val();
				var phone = $('#phone').val();
				var address = $('#address').val();
				var birthplace = $('#birthplace').val();
				var birthday = $('#birthday').val();
				if (document.getElementById('edit_jenis_kelamin_l').checked) {
					var gender = "L";
				} else {
					var gender = "P";
				}
				if (document.getElementById('maritalstatus_s').checked) {
					var maritalstatus = "Single";
				} else {
					var maritalstatus = "Married";
				}
				var prov_id = $('#prov_id').val();
				var kab_id = $('#kab_id').val();
				var kec_id = $('#kec_id').val();
				var desa_id = $('#desa_id').val();
				var postalcode = $('#postalcode').val();
				var shift_id = $('#shift_id').val();
				var designation_id = $('#designation_id').val();
				var position_id = $('#position_id').val();
				var departement_id = $('#departement_id').val();
				var dateofjoining = $('#dateofjoining').val();
				var dateofleaving = $('#dateofleaving').val();
				var instansi_id = $('#instansi_id').val();
				var branch_id = $('#branch_id').val();

				if (firstname == "" || firstname == null) {
					showSnackError("Harap isi FirstName");
				} else {
					showLoading();
					var btn = document.getElementById("btnSave");
					btn.value = 'Loading...';
					btn.innerHTML = 'Loading...';
					btn.disabled = true;
					dataPost = {
						code: code,
						firstname: firstname,
						lastname: lastname,
						email: email,
						address: address,
						phone: phone,
						is_active: is_active,
						prov_id: prov_id,
						kab_id: kab_id,
						kec_id: kec_id,
						desa_id: desa_id,
						postalcode: postalcode,
						gender: gender,
						maritalstatus: maritalstatus,
						birthplace: birthplace,
						birthday: birthday,
						prov_id: prov_id,
						kab_id: kab_id,
						kec_id: kec_id,
						desa_id: desa_id,
						shift_id: shift_id,
						designation_id: designation_id,
						position_id: position_id,
						departement_id: departement_id,
						dateofjoining: dateofjoining,
						dateofleaving: dateofleaving,
						instansi_id: instansi_id,
						branch_id: branch_id,
						statusdata: statusdata
					}

					$.ajax({
						url: '<?php echo base_url("hrm/staffmanagement/staffprofile/saveStaffProfile") ?>',
						type: 'POST',
						dataType: 'json',
						data: dataPost,
						success: function(res) {
							console.log(res)
							if (res.status_json) {
								success(res.remarks);
							} else {
								btn.value = 'Save';
								btn.innerHTML = 'Save';
								btn.disabled = false;
								showSnackError(res.remarks);
								dismisLoading();
							}
						},
						error: function(XMLHttpRequest, textStatus, errorThrown) {
							dismisLoading();
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
