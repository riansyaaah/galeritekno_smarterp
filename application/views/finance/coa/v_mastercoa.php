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
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?php echo base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/template/css/jquery.treegrid.css'); ?>">
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
                                    <a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItemType()"><i class="fa fa-plus"></i> New Type</a>
									<a href="<?= base_url('finance/coa/mastercoa/print'); ?>" target="_blank" class="btn  btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
								</div>

								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped tree">
											<thead>
												<tr>
													<th class="text-center">Account No</th>
													<th class="text-center">Account Name</th>
													<th class="text-center">#</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($getcoa as $g) { ?>
													<tr class="<?php echo 'treegrid-' . str_replace('.', '', $g['AccountNo']);
																			if ($g['Level'] != 'TYPE') {
																				echo ' treegrid-parent-' . $g['AccountParrent'];
																			} ?>">
														<td>
															<font size="2"><?php if ($g['Level'] == 'TYPE') {echo $g['AccountNo']." (".$g['DrCr'].")";}else{echo $g['AccountNo'];} ?></font>
														</td>
														<td>
															<font size="2"><?php echo $g['AccountName']; ?></font>
														</td>
														<td>
															<?php if ($g['Level'] == 'TYPE') { ?>
																<a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?= $g['AccountNo']; ?>','GROUP')"><i class="fa fa-plus"></i> Group</a>
																<a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?= $g['AccountNo']; ?>','TYPE')"><i class="fa fa-edit"></i> Edit</a>
																<a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?= $g['AccountNo']; ?>')"><i class="fa fa-trash"></i> Delete</a>
															<?php } ?>
															<?php if ($g['Level'] == 'GROUP') { ?>
																<a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?= $g['AccountNo']; ?>','SGROUP')"><i class="fa fa-plus"></i> Sub group</a>
																<a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?= $g['AccountNo']; ?>','GROUP')"><i class="fa fa-edit"></i> Edit</a>
																<a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?= $g['AccountNo']; ?>')"><i class="fa fa-trash"></i> Delete</a>
															<?php } ?>
															<?php if ($g['Level'] == 'SGROUP') { ?>
																<a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?= $g['AccountNo']; ?>','CODE')"><i class="fa fa-plus"></i> Code</a>
																<a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?= $g['AccountNo']; ?>','SGROUP')"><i class="fa fa-edit"></i> Edit</a>
																<a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?= $g['AccountNo']; ?>')"><i class="fa fa-trash"></i> Delete</a>
															<?php } ?>
															<?php if ($g['Level'] == 'CODE') { ?>
																<a href="#" class="edit_record btn btn-warning btn-sm" onclick="tambahItem('<?= $g['AccountNo']; ?>','MASTER')"><i class="fa fa-plus"></i> Master</a>
																<a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?= $g['AccountNo']; ?>','CODE')"><i class="fa fa-edit"></i> Edit</a>
																<a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?= $g['AccountNo']; ?>')"><i class="fa fa-trash"></i> Delete</a>
															<?php } ?>
															<?php if ($g['Level'] == 'MASTER') { ?>
																<a href="#" class="edit_record btn btn-info btn-sm" onclick="editItem('<?= $g['AccountNo']; ?>','MASTER')"><i class="fa fa-edit"></i> Edit</a>
																<a href="#" class="edit_record btn btn-danger btn-sm" onclick="deleteItem('<?= $g['AccountNo']; ?>')"><i class="fa fa-trash"></i> Delete</a>
															<?php } ?>

														</td>
													</tr>
												<?php } ?>
											</tbody>
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
                <div class="modal fade" id="tambahItemType" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">New Type</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="section-title">Type Name</div>
						<div class="form-group">
							<input type="text" id="AccountNameType" class="form-control">
						</div>
                         <div class="section-title">Type Dr / Cr</div>
                        <div class="form-group mb-0 row">
                       
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="Dr" name="customRadio" class="custom-control-input" value="Dr">
									<label class="custom-control-label" for="Dr">Dr</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="Cr" name="customRadio" class="custom-control-input" value="Cr">
									<label class="custom-control-label" for="Cr">Cr</label>
								</div>
                                                </div>
                                            </div> <!--end row--> 
                        <div class="section-title">In Balance Sheet</div>
                        <div class="form-group mb-0 row">
                       
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="No" name="customRadio2" class="custom-control-input" value="No">
									<label class="custom-control-label" for="No">No</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="YesLeft" name="customRadio2" class="custom-control-input" value="YesLeft">
									<label class="custom-control-label" for="YesLeft">Yes - Left</label>
								</div>
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="YesRight" name="customRadio2" class="custom-control-input" value="YesRight">
									<label class="custom-control-label" for="YesRight">Yes - Right</label>
								</div>
                                                </div>
                                            </div> <!--end row--> 
					</div>
                    
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemAddType" onclick="return itemAddType()">
							SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
                
		<div class="modal fade" id="tambahItem" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headermodalitem"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="AccountParrent" class="form-control">
						<input type="hidden" id="Level" class="form-control">
						<div class="section-title" id="title_parrent"></div>
						<div class="form-group">
							<input type="text" id="AccountNameParrent" class="form-control" readonly>
						</div>

						<div class="section-title" id='title_child'></div>
						<div class="form-group">
							<input type="text" id="AccountName" class="form-control">
						</div>
                        <div class="section-title">Type Dr / Cr</div>
                        <div class="form-group mb-0 row">
                       
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="Dr_tambah" name="customRadio" class="custom-control-input" value="Dr" disabled>
									<label class="custom-control-label" for="Dr_tambah">Dr</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="Cr_tambah" name="customRadio" class="custom-control-input" value="Cr" disabled>
									<label class="custom-control-label" for="Cr_tambah">Cr</label>
								</div>
                                                </div>
                                            </div>
                        <div class="section-title">In Balance Sheet</div>
                        <div class="form-group mb-0 row">
                       
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="No_tambah" name="customRadio2" class="custom-control-input" value="No" disabled>
									<label class="custom-control-label" for="No_tambah">No</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="YesLeft_tambah" name="customRadio2" class="custom-control-input" value="YesLeft" disabled>
									<label class="custom-control-label" for="YesLeft_tambah">Yes - Left</label>
								</div>
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="YesRight_tambah" name="customRadio2" class="custom-control-input" value="YesRight" disabled>
									<label class="custom-control-label" for="YesRight_tambah">Yes - Right</label>
								</div>
                                                </div>
                                            </div> <!--end row--> 
                        
                        <div class="form-group" id="input_leaf">
							<div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="leaf" value="true">
                            <label class="custom-control-label" for="leaf">Set as Leaf</label>
                          </div>
						</div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemAdd" onclick="return itemAdd()">
							SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="editItem" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="headermodalitem_edit"></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="section-title" id="title_No"></div>
						<div class="form-group">
							<input type="text" id="AccountNo_edit" class="form-control" readonly>
						</div>

						<div class="section-title" id='title_Name'></div>
						<div class="form-group">
							<input type="text" id="AccountName_edit" class="form-control">
						</div>
                        <div class="section-title">Type Dr / Cr</div>
                        <div class="form-group mb-0 row">
                       
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="Dr_edit" name="customRadio" class="custom-control-input" value="Dr" disabled>
									<label class="custom-control-label" for="Dr_edit">Dr</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="Cr_edit" name="customRadio" class="custom-control-input" value="Cr" disabled>
									<label class="custom-control-label" for="Cr_edit">Cr</label>
								</div>
                                                </div>
                                            </div> <!--end row--> 
                        <div class="section-title">In Balance Sheet</div>
                        <div class="form-group mb-0 row">
                       
                                                <div class="col-md-9">
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="No_edit" name="customRadio2" class="custom-control-input" value="No" disabled>
									<label class="custom-control-label" for="No_edit">No</label>
								</div>
								<div class="custom-control custom-radio">
									<input type="radio" id="YesLeft_edit" name="customRadio2" class="custom-control-input" value="YesLeft" disabled>
									<label class="custom-control-label" for="YesLeft_edit">Yes - Left</label>
								</div>
                                                    <div class="custom-control custom-radio">
									<input type="radio" id="YesRight_edit" name="customRadio2" class="custom-control-input" value="YesRight" disabled>
									<label class="custom-control-label" for="YesRight_edit">Yes - Right</label>
								</div>
                                                </div>
                                            </div> <!--end row--> 
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnItemEdit" onclick="return itemEdit()">
							SAVE
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="deleteItem" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id='headermodaldelete'></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="AccountNo_delete" class="form-control">
						<div class="section-title" id='infodelete'></div>
					</div>
					<div class="modal-footer bg-whitesmoke br">
						<button class="btn btn-primary" type="button" id="btnitemDelete" onclick="return itemDelete()"> Delete </button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/js/jquery.treegrid.js'); ?>"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});

			$('.tree').treegrid({
				expanderExpandedClass: 'fa fa-minus',
				expanderCollapsedClass: 'fa fa-plus'
			});


		});
        function tambahItemType() {
			
			showLoading();
            dismisLoading();
            $("#tambahItemType").modal();
		}
        function itemAddType() {
			var btn = document.getElementById("btnItemAddType");
			var AccountName = $('#AccountNameType').val();
            if(document.getElementById('Dr').checked) DrCr = document.getElementById('Dr').value;
			if (document.getElementById('Cr').checked) DrCr = document.getElementById('Cr').value;
            
            if(document.getElementById('No').checked) InBS = document.getElementById('No').value;
			if (document.getElementById('YesLeft').checked) InBS = document.getElementById('YesLeft').value;
			if (document.getElementById('YesRight').checked) InBS = document.getElementById('YesRight').value;
            
			if (AccountName == "" || AccountName == null) {
				$("#AccountNameType").addClass("is-invalid");
				showSnackError("Harap isi");
			} else {
				$("#AccountNameType").removeClass("is-invalid");
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					AccountParrent: '0',
					AccountName: AccountName,
					DrCr: DrCr,
					InBS: InBS,
					Level: 'TYPE',
				}
				$.ajax({
					url: '<?php echo base_url("finance/coa/mastercoa/Additem") ?>',
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
		function tambahItem(AccountParrent, level) {
			dataPost = {
				AccountNo: AccountParrent
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/coa/mastercoa/getMasterCoa") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#AccountParrent').val(data[0]['AccountNo']);
						$('#AccountNameParrent').val(data[0]['AccountName']);
						$('#Level').val(level);
                        if (data[0]['DrCr'] == 'Dr') {
							radiobtn = document.getElementById("Dr_tambah");

						} else {
							radiobtn = document.getElementById("Cr_tambah");
						}
                        if (data[0]['InBS'] == 'No') {
							radiobtn2 = document.getElementById("No_tambah");

						} else if (data[0]['InBS'] == 'YesLeft') {
							radiobtn2 = document.getElementById("YesLeft_tambah");

						} else {
							radiobtn2 = document.getElementById("YesRight_tambah");
						}
                        
						radiobtn.checked = true;
						radiobtn2.checked = true;
						if (level == 'GROUP') {
							document.getElementById("headermodalitem").innerHTML = "TAMBAH GROUP";
							document.getElementById("title_parrent").innerHTML = "NAMA TYPE";
							document.getElementById("title_child").innerHTML = "NAMA GROUP";
                            var x = document.getElementById("input_leaf");
                                x.style.display = "none";
  						}
						if (level == 'SGROUP') {
							document.getElementById("headermodalitem").innerHTML = "TAMBAH SUB GROUP";
							document.getElementById("title_parrent").innerHTML = "NAMA GROUP";
							document.getElementById("title_child").innerHTML = "NAMA SUB GROUP";
                            var x = document.getElementById("input_leaf");
                                x.style.display = "block";
						}
						if (level == 'CODE') {
							document.getElementById("headermodalitem").innerHTML = "TAMBAH CODE";
							document.getElementById("title_parrent").innerHTML = "NAMA SUB GROUP";
							document.getElementById("title_child").innerHTML = "NAMA CODE";
                            var x = document.getElementById("input_leaf");
                                x.style.display = "block";
						}
						if (level == 'MASTER') {
							document.getElementById("headermodalitem").innerHTML = "TAMBAH MASTER";
							document.getElementById("title_parrent").innerHTML = "NAMA CODE";
							document.getElementById("title_child").innerHTML = "NAMA MASTER";
                            var x = document.getElementById("input_leaf");
                                x.style.display = "none";
                            
						}
						dismisLoading();
						$("#tambahItem").modal();
						$("#AccountName").removeClass("is-invalid");
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

        
        
		function itemAdd() {
			var btn = document.getElementById("btnItemAdd");
			var AccountParrent = $('#AccountParrent').val();
			var AccountName = $('#AccountName').val();
			var Level = $('#Level').val();
            if(document.getElementById('Dr_tambah').checked) DrCr = document.getElementById('Dr_tambah').value;
			if (document.getElementById('Cr_tambah').checked) DrCr = document.getElementById('Cr_tambah').value;
			if (document.getElementById('leaf').checked) Level = "MASTER";
            
            if(document.getElementById('No_tambah').checked) InBS = document.getElementById('No_tambah').value;
			if (document.getElementById('YesLeft_tambah').checked) InBS = document.getElementById('YesLeft_tambah').value;
			if (document.getElementById('YesRight_tambah').checked) InBS = document.getElementById('YesRight_tambah').value;
            
            
			if (AccountName == "" || AccountName == null) {
				$("#AccountName").addClass("is-invalid");
				showSnackError("Harap isi");
			} else {
				$("#AccountName").removeClass("is-invalid");
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					AccountParrent: AccountParrent,
					AccountName: AccountName,
					Level: Level,
					DrCr: DrCr,
					InBS: InBS,
				}
				$.ajax({
					url: '<?php echo base_url("finance/coa/mastercoa/Additem") ?>',
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


		function editItem(AccountNo, level) {
			dataPost = {
				AccountNo: AccountNo
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/coa/mastercoa/getMasterCoa") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#AccountNo_edit').val(data[0]['AccountNo']);
						$('#AccountName_edit').val(data[0]['AccountName']);
                        if (data[0]['DrCr'] == 'Dr') {
							radiobtn = document.getElementById("Dr_edit");

						} else {
							radiobtn = document.getElementById("Cr_edit");
						}
                        
                        if (data[0]['InBS'] == 'No') {
							radiobtn2 = document.getElementById("No_edit");

						} else if (data[0]['InBS'] == 'YesLeft') {
							radiobtn2 = document.getElementById("YesLeft_edit");

						} else {
							radiobtn2 = document.getElementById("YesRight_edit");
						}
						radiobtn.checked = true;
						radiobtn2.checked = true;
                        
						if (level == 'TYPE') {
							document.getElementById("headermodalitem_edit").innerHTML = "EDIT TYPE";
							document.getElementById("title_No").innerHTML = "KODE TYPE";
							document.getElementById("title_Name").innerHTML = "NAMA TYPE";
						}
                        if (level == 'GROUP') {
							document.getElementById("headermodalitem_edit").innerHTML = "EDIT GROUP";
							document.getElementById("title_No").innerHTML = "KODE GROUP";
							document.getElementById("title_Name").innerHTML = "NAMA GROUP";
						}
						if (level == 'SGROUP') {
							document.getElementById("headermodalitem_edit").innerHTML = "EDIT SUB GROUP";
							document.getElementById("title_No").innerHTML = "KODE SUB GROUP";
							document.getElementById("title_Name").innerHTML = "NAMA SUB GROUP";
						}
						if (level == 'CODE') {
							document.getElementById("headermodalitem_edit").innerHTML = "EDIT CODE";
							document.getElementById("title_No").innerHTML = "KODE CODE";
							document.getElementById("title_Name").innerHTML = "NAMA CODE";
						}
						if (level == 'MASTER') {
							document.getElementById("headermodalitem_edit").innerHTML = "EDIT MASTER";
							document.getElementById("title_No").innerHTML = "KODE MASTER";
							document.getElementById("title_Name").innerHTML = "NAMA MASTER";
						}
						dismisLoading();
						$("#editItem").modal();
						$("#AccountName_edit").removeClass("is-invalid");
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

		function itemEdit() {
			var btn = document.getElementById("btnItemEdit");
			var AccountNo = $('#AccountNo_edit').val();
			var AccountName = $('#AccountName_edit').val();
			$("#AccountName_edit").removeClass("is-invalid");
            if(document.getElementById('Dr_edit').checked) DrCr = document.getElementById('Dr_edit').value;
			if (document.getElementById('Cr_edit').checked) DrCr = document.getElementById('Cr_edit').value;
            
            if(document.getElementById('No_edit').checked) InBS = document.getElementById('No_edit').value;
			if (document.getElementById('YesLeft_edit').checked) InBS = document.getElementById('YesLeft_edit').value;
			if (document.getElementById('YesRight_edit').checked) InBS = document.getElementById('YesRight_edit').value;
            
			if (AccountName == "" || AccountName == null) {
				$("#AccountName_edit").addClass("is-invalid");
				showSnackError("Harap izi");
			} else {
				$("#AccountName_edit").removeClass("is-invalid");
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					AccountNo: AccountNo,
					AccountName: AccountName,
					DrCr: DrCr,
					InBS: InBS,
				}
				$.ajax({
					url: '<?php echo base_url("finance/coa/mastercoa/Edititem") ?>',
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

		function deleteItem(AccountNo) {
			dataPost = {
				AccountNo: AccountNo
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/coa/mastercoa/getMasterCoa") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#AccountNo_delete').val(data[0]['AccountNo']);

						document.getElementById("headermodaldelete").innerHTML = "Delete Master of COA  No. : " + data[0]['AccountNo'];
						document.getElementById("infodelete").innerHTML = "Are you sure to delete this data : " + data[0]['AccountName'] + " ?";

						dismisLoading();
						$("#deleteItem").modal();
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

		function itemDelete() {
			var btn = document.getElementById("btnitemDelete");
			var AccountNo = $('#AccountNo_delete').val();
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			dataPost = {
				AccountNo: AccountNo,
			}
			$.ajax({
				url: '<?php echo base_url("finance/coa/mastercoa/Deleteitem") ?>',
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


		function showSnackSuccess(text) {
			iziToast.success({
				title: 'Info',
				message: text,
				position: 'topRight'
			});
		}

		function showSnackError(text) {
			iziToast.error({
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
