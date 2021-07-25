<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel="stylesheet" href="<?= base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
	<link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<style>
		.hidetd {display: none !important;}
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
								<div class="card-body " id="demo">
									<div class="row">
										<div class="col-sm-4">
											<div class="section-title">From</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<input type="date" id="fromDate" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="section-title">To</div>
											<div class="form-group">
												<div class="input-group mb-3 row">
													<div class="col-sm-12">
														<input type="date" id="toDate" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="container">
											<div class="form-check row">
												<div class="col-md-2">
													<div class="custom-control custom-radio">
														<input type="radio" id="all" name="searchBased" class="custom-control-input" value="all">
														<label class="custom-control-label" for="all">All</label>
													</div>
												</div>
												<div class="col-md-2">
													<div class="custom-control custom-radio mt-2">
														<input type="radio" id="account" name="searchBased" class="custom-control-input" value="account" checked>
														<label class="custom-control-label" for="account">Item</label>
													</div>
												</div>

											</div>
										</div>
									</div>
									<div class="row" id="accountBased">
										<div class="col-md-6">
											<?php $this->load->view('inventory/stock/part_movementlist/modal_selectaccount', ['ket' => 'From']); ?>
										</div>
										<div class="col-md-6">
											<?php $this->load->view('inventory/stock/part_movementlist/modal_selectaccount', ['ket' => 'To']); ?>
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-sm-8">
											<div class="buttons">
												<button type="button" class="btn btn-sm btn-primary" id="btnPreview"><i class="fa fa-search"></i> Preview</button>
												<button type="button" class="btn btn-sm btn-danger" id="btnCetak"><i class="fa fa-print"></i> Cetak</button>
												<div id="print"></div>
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
	</div>
	<?php $this->load->view('inventory/stock/part_movementlist/modal_preview'); ?>
	<?php $this->load->view('inventory/stock/part_movementlist/modal_cariaccount', ['ket' => 'From']); ?>
	<?php $this->load->view('inventory/stock/part_movementlist/modal_cariaccount', ['ket' => 'To']); ?>
	<script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
	<script>
		document.querySelector('#btnPreview').addEventListener('click', e => {
			const data = {
				fromDate: document.querySelector('#fromDate').value,
				toDate: document.querySelector('#toDate').value,
				fromItem: document.querySelector('#namaItemFrom').value,
				toItem: document.querySelector('#namaItemTo').value
			};
			if(document.querySelector('#account').checked == true) {
				if(!data.fromDate || !data.toDate || !data.fromItem || !data.toItem) {
					showSnackError('Harap diisi');
				} else {
					preview(data);
				}
			}
			if(document.querySelector('#all').checked == true) {
				if(!data.fromDate || !data.toDate) {
					showSnackError('Harap diisi');
				} else {
					data.fromItem = 'all';
					data.toItem = 'all';
					preview(data);
				}
			}
			
		});
		function preview(dataPost) {
			showLoading();
			$('#table_preview').dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url('inventory/stock/movementlist/getitem'); ?>',
					dataSrc: 'data',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
				},
				"paging": false,
				"ordering": false,
				"info": false,
				"filter": false,
				columns: [
					{"data": 'no'},
					{"data": 'tglTransaction'},
					{"data": 'noTransaction'},
					{"data": 'itemmaster'},
					{"data": 'jumlahIn'},
					{"data": 'jumlahOut'}
				],
                "createdRow": (row, data, index) => {
                    $('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(1).addClass('text-center');
                    $('td', row).eq(2).addClass('text-center');
                    $('td', row).eq(4).addClass('text-center');
                    $('td', row).eq(5).addClass('text-center');
                }
			});
			dismisLoading();
			$("#Preview").modal();
		}
		document.querySelector('#btnCetak').addEventListener('click', e => {
			const data = {
				fromDate: document.querySelector('#fromDate').value,
				toDate: document.querySelector('#toDate').value,
				fromItem: document.querySelector('#namaItemFrom').value,
				toItem: document.querySelector('#namaItemTo').value
			};
			if(document.querySelector('#account').checked == true) {
				if(!data.fromDate || !data.toDate || !data.fromItem || !data.toItem) {
					showSnackError('Harap diisi');
				} else {
					btnCetak(data);
				}
			}
			if(document.querySelector('#all').checked == true) {
				if(!data.fromDate || !data.toDate) {
					showSnackError('Harap diisi');
				} else {
					data.fromItem = 'all';
					data.toItem = 'all';
					btnCetak(data);
				}
			}
		});
		function btnCetak(data) {
			document.querySelector('#print').innerHTML = `<a id="btnPrint" href="<?= base_url('inventory/stock/movementlist/print'); ?>?fromDate=${data.fromDate}&toDate=${data.toDate}&fromItem=${data.fromItem}&toItem=${data.toItem}" target="_blank"></a>`;
			document.querySelector('#btnPrint').click();
		}
		document.querySelector('#btnCariItemFrom').addEventListener('click', e => {
			cariAccount('From');
		});
		document.querySelector('#btnCariItemTo').addEventListener('click', e => {
			cariAccount('To');
		});
		function cariAccount(ket) {
			showLoading();
			$(`#table-menu${ket}`).dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url('inventory/stock/movementlist/getallitem'); ?>',
					dataSrc: 'data'
				},
				columns: [
					{"data": 'itemmaster'},
					{"data": 'unit'},
					{"data": 'stock'},
					{"data": 'btn'},
					{"data": 'id'}
				],
				"columnDefs": [
					{
						"sortable": false,
						"targets": [2, 3]
					}
				],
                "createdRow": (row, data, index ) => {
                    $('td', row).eq(4).addClass('hidetd');
                    $('td', row).eq(3).addClass('text-center');
                    $('td', row).eq(1).addClass('text-center');
                    $('td', row).eq(2).addClass('text-center');
                }
			});
			dismisLoading();
			$(`#cariAccount${ket}`).modal();
			$(`#cariAccount${ket} tbody`).on('click', 'tr', function(e) {
				e.preventDefault();
				const td = $(this).closest('tr').children('td');
				const namaItem = document.querySelector(`#namaItem${ket}`);
				const stockItem = document.querySelector(`#stockItem${ket}`);
				const idItem = document.querySelector(`#idItem${ket}`);
				namaItem.value = td.eq(0).text();
				stockItem.value = `${td.eq(2).text()} ${td.eq(1).text()}`;
				idItem.value = td.eq(4).text();
				$(`#cariAccount${ket}`).modal('hide');
			});
		}
		$(document).ready(function() {
			var csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
			$("input[name=searchBased]").change(function() {
				if ($("#account").is(':checked')) {
					$("#accountBased").show();
				} else if ($("#all").is(':checked')) {
					document.querySelector('#namaItemFrom').value = '';
					document.querySelector('#stockItemFrom').value = '';
					document.querySelector('#namaItemTo').value = '';
					document.querySelector('#stockItemTo').value = '';
					$("#accountBased").hide();
				}
			});
		});

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