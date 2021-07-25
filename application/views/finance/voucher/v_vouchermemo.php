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
	<div id="app">
		<div class="main-wrapper main-wrapper-1">
			<?php $this->load->view('layout/v_header'); ?>
			<?php $this->load->view('layout/v_menu'); ?>
			<div class="main-content">
				<section class="section">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4><?= $title; ?></h4>
								</div>
								<div class="card-body row">
									<div class="col-lg-12">
										<div class="form-group row">
											<div class="col-md-4">
												<label for="example-text-input">Voucher Memo Date:</label>
												<div class="input-group">
													<input class="form-control form-control-sm" id="VoucherMemoDate" type="date">
												</div><br>
												<label for="VoucherMemoNo">Voucher Memo No</label>
												<div class="input-group mb-3">
													<input type="text" id="VoucherMemoNo" name="example-input2-group2" class="form-control form-control-sm" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm" id="btnCariVoucherMemo"><i class="fas fa-list-ul"></i></a>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<button type="button" class="btn  btn-primary btn-sm" id="btnReset" onclick="reset()" hidden><i class="fa fa-undo"></i> Reset</button>
										<button type="button" class="btn  btn-primary btn-sm" id="btnNewVoucherMemo"><i class="fa fa-file"></i> New Memo</button>&nbsp;
										<button type="button" class="btn  btn-primary btn-sm" id="btn_edit_payment"><i class="fa fa-edit"></i> Edit Memo</button>&nbsp;
										<button type="button" class="btn  btn-primary btn-sm" id="btn_delete_payment" onclick="memoHapus()"><i class="fa fa-trash"></i> Delete Memo</button>&nbsp;
										<button type="button" class="btn  btn-primary btn-sm" id="btnPrintPayment"><i class="fa fa-print"></i> Print</button>&nbsp;
										<button type="button" class="btn  btn-primary btn-sm" id="btn_addItem"><i class="fa fa-plus"></i> Add Items</button>&nbsp;
										<div class="mt-2">
											<table class="table table-striped" id="table-detail-payment">
												<thead>
													<tr>
														<th>NO</th>
														<th>DESCRIPTION</th>
														<th>ACCOUNT</th>
														<th>DEBIT</th>
														<th>CREDIT</th>
														<th width="125px">#</th>
													</tr>
												</thead>
											</table>
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

	<div class="modal fade" id="cariVoucherMemo" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Voucher Memo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">Voucher Memo Date</th>
								<th class="text-center">Voucher Memo No</th>
								<th class="text-center">Debit</th>
								<th class="text-center">Credit</th>
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

	<div class="modal fade" id="memoHapus" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id='headervoucherhapus'></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="section-title" id='infovoucherhapus'></div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button class="btn btn-primary" type="button" id="btnmemoHapus" onclick="return Hapuspayment()"> Hapus </button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="addItem" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Input Item Voucher Memo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control form-control-sm" id="itemidRow" required="">
					<input type="hidden" class="form-control form-control-sm" id="status" required="">
					<div class="form-group">
						<label for="itemDescription">Description</label>
						<input type="text" class="form-control form-control-sm" id="itemDescription" required="">
					</div>
					<div class="form-group">
						<label for="itemAmount">Amount</label>
						<input type="text" class="form-control form-control-sm" id="itemAmount" required="">
					</div>
					<div class="form-group">
						<div class="col-md-9">
							<div class="custom-control custom-radio">
								<input type="radio" id="Debit" name="customRadio" class="custom-control-input" value="Debit">
								<label class="custom-control-label" for="Debit">DEBIT</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" id="Credit" name="customRadio" class="custom-control-input" value="Credit">
								<label class="custom-control-label" for="Credit">CREDIT</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="exampleInputPassword1">Account</label>
							<div class="input-group">
								<input type="text" id="itemAccountNo" name="example-input2-group2" class="form-control form-control-sm" readonly>
								<span class="input-group-append">
									<a href="#" class="edit_record btn btn-primary btn-sm" id="btnCariAccountNo">...</a>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<textarea class="form-control form-control-sm" id="itemAccountName" readonly></textarea>
					</div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button class="btn btn-primary" type="button" id="btnItemBaru" onclick="return itemBaru()">
						SIMPAN
					</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="cariAccountNo" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Cash Bank</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-account" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Account</th>
								<th class="text-center">Account Name</th>
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

	<div class="modal fade" id="hapusItem" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id='headermodalhapus'></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="itemidRow_hapus" class="form-control">
					<div class="section-title" id='infohapus'></div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button class="btn btn-primary" type="button" id="btnitemHapus" onclick="return itemHapus()"> Hapus </button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>">
	</script>
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
		const rupiah = document.querySelector('#itemAmount');
		rupiah.addEventListener('keyup', function(e){
			rupiah.value = formatRupiah(this.value);
		});
		function formatRupiah(angka){
			let number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
			if(ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return rupiah;
		}
		// Ketika pertama halaman dimuat
		$(document).ready(function() {
			$("#VoucherMemoDate").change(function() {
				$("#VoucherMemoDate").removeClass("is-invalid");
			});

			// Efek Terhadapt Tombol					
			document.getElementById("btnNewVoucherMemo").disabled = false;
			document.getElementById("btn_edit_payment").disabled = true;
			document.getElementById("btn_delete_payment").disabled = true;
			document.getElementById("btnPrintPayment").disabled = true;
			document.getElementById("btn_addItem").disabled = true;
		});

		// Tombol reset ditekan
		function reset() {
			showLoading();
			dismisLoading();

			// Efek Terhadap Form
			document.getElementById("VoucherMemoDate").readOnly = false;
			document.getElementById("VoucherMemoDate").value = '';
			document.getElementById("VoucherMemoNo").value = '';

			// Efek Terhadapt Tombol					
			document.getElementById("btnReset").hidden = true;
			document.getElementById("btnNewVoucherMemo").hidden = false;
			document.getElementById("btnNewVoucherMemo").disabled = false;
			document.getElementById("btn_edit_payment").disabled = true;
			document.getElementById("btn_delete_payment").disabled = true;
			document.getElementById("btnPrintPayment").disabled = true;
			document.getElementById("btn_addItem").disabled = true;

			// flash Table item
			$('#table-detail-payment').DataTable().clear().draw();
			$('#table-detail-payment').DataTable().destroy();
			// $('#totalAmount').text('');
			// $('#totalAmountLable').text('');
		}

		// Ketika tombol cari voucher memo ditekan
		document.querySelector('#btnCariVoucherMemo').addEventListener('click', e => {
			showLoading();
			$("#table-menu").dataTable({
				destroy: true,
				ajax: {
					url: "<?= base_url('finance/voucher/vouchermemo/getVoucherMemo') ?>",
					dataSrc: 'data'
				},
				columns: [{
						"data": 'VoucherMemoDate',
					},
					{
						"data": 'VoucherMemoNo'
					},
					{
						"data": 'Debit'
					},
					{
						"data": 'Credit'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [4]
				}]
			});
			dismisLoading();
			$("#cariVoucherMemo").modal();
			$('#table-menu tbody').on('click', 'tr', function() {
				event.preventDefault();
				let $td = $(this).closest('tr').children('td');
				let VoucherMemoDate = $td.eq(0).text();
				let VoucherMemoNo = $td.eq(1).text();
				document.getElementById("VoucherMemoDate").value = VoucherMemoDate;
				document.getElementById("VoucherMemoNo").value = VoucherMemoNo;
				VoucherMemoCari();
				$('#cariVoucherMemo').modal('hide');

				// Efek terhadap Form

				document.getElementById("VoucherMemoDate").readOnly = true;
				document.getElementById("VoucherMemoNo").readOnly = true;

				// Efek Terhadapt Tombol					
				document.getElementById("btnNewVoucherMemo").hidden = true;
				document.getElementById("btnReset").hidden = false;
				document.getElementById("btn_edit_payment").disabled = false;
				document.getElementById("btn_delete_payment").disabled = false;
				document.getElementById("btnPrintPayment").disabled = false;
				document.getElementById("btn_addItem").disabled = false;
			});
		});

		function cariVoucherMemo() {
			showLoading();
			$("#table-menu").dataTable({
				destroy: true,
				ajax: {
					url: "<?= base_url('finance/voucher/vouchermemo/getVoucherMemo') ?>",
					dataSrc: 'data'
				},
				columns: [{
						"data": 'VoucherMemoDate',
					},
					{
						"data": 'VoucherMemoNo'
					},
					{
						"data": 'Debit'
					},
					{
						"data": 'Credit'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [4]
				}]
			});
			dismisLoading();
			$("#cariVoucherMemo").modal();
			$('#table-menu tbody').on('click', 'tr', function() {
				event.preventDefault();
				let $td = $(this).closest('tr').children('td');
				let VoucherMemoDate = $td.eq(0).text();
				let VoucherMemoNo = $td.eq(1).text();
				document.getElementById("VoucherMemoDate").value = VoucherMemoDate;
				document.getElementById("VoucherMemoNo").value = VoucherMemoNo;
				VoucherMemoCari();
				$('#cariVoucherMemo').modal('hide');


			});
		}
		$(document).ready(function() {
			var csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});

		document.querySelector('#btnNewVoucherMemo').addEventListener('click', e => {
			const VoucherMemoDate = $('#VoucherMemoDate').val();
			if (VoucherMemoDate == '' || VoucherMemoDate == null) {
				showSnackError("Harap isi Tanggal Terlebih Dahulu");
				$("#VoucherMemoDate").addClass("is-invalid");
			} else {
				$.ajax({
					type: 'POST',
					url: '<?= base_url("finance/voucher/vouchermemo/cariVoucherMemoNo"); ?>',
					dataType: 'json',
					success: result => {
						dismisLoading();
						document.querySelector('#VoucherMemoNo').value = `${result['VoucherMemoNo']}/VM/<?= $tahunaktif; ?>`;
						document.querySelector('#VoucherMemoDate').readOnly = true;

						// Efek Terhadapt Form	

						// Efek Terhadapt Tombol					
						document.getElementById("btnNewVoucherMemo").hidden = true;
						document.getElementById("btnReset").hidden = false;
						document.getElementById("btn_edit_payment").disabled = false;
						document.getElementById("btn_delete_payment").disabled = false;
						document.getElementById("btnPrintPayment").disabled = false;
						document.getElementById("btn_addItem").disabled = false;

						// flash Table item
						$('#table-detail-payment').DataTable().clear().draw();
						$('#table-detail-payment').DataTable().destroy();
					}
				})
			}
		});

		document.querySelector('#btn_addItem').addEventListener('click', e => {
			showLoading();
			dismisLoading();
			const VoucherMemoNo = $('#VoucherMemoNo').val();
			const VoucherMemoDate = $('#VoucherMemoDate').val();
			if (VoucherMemoDate == '' || VoucherMemoDate == null) {
				showSnackError("Harap isi Voucher Memo Date");
			} else if (VoucherMemoNo == '' || VoucherMemoNo == null) {
				showSnackError("Harap isi Voucher Memo No");
			} else {
				$("#addItem").modal();
				document.querySelector('#status').value = 'Tambah';
			}
		});

		document.querySelector('#btnCariAccountNo').addEventListener('click', e => {
			showLoading();
			$("#table-account").dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url("finance/voucher/vouchermemo/getAccountNo") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'no',
					},
					{
						"data": 'AccountNo',
					},
					{
						"data": 'AccountName'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [2, 3]
				}]
			});
			dismisLoading();
			$("#cariAccountNo").modal();
			$('#table-account tbody').on('click', 'tr', function() {
				event.preventDefault();
				const $td = $(this).closest('tr').children('td');
				const AccountNo = $td.eq(1).text();
				const AccountName = $td.eq(2).text();
				document.getElementById("itemAccountNo").value = AccountNo;
				document.getElementById("itemAccountName").value = AccountName;
				$('#cariAccountNo').modal('hide');
			});
		});

		// Hapus Voucher Memo
		function memoHapus() {
			var VoucherMemoNo = $('#VoucherMemoNo').val();
			dataPost = {
				VoucherMemoNo: VoucherMemoNo
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/voucher/VoucherMemo/getVoucherMemoById") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						document.getElementById("headervoucherhapus").innerHTML = "Delete Item : " + data[0]['VoucherMemoNo'];
						document.getElementById("infovoucherhapus").innerHTML = "Are you sure to delete this data : " + data[0]['VoucherMemoNo'] + " ?";

						dismisLoading();
						$("#memoHapus").modal();
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

		function Hapuspayment() {
			var btn = document.getElementById("btnmemoHapus");
			var VoucherMemoNo = $('#VoucherMemoNo').val();
			btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
			btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
			btn.disabled = true;
			dataPost = {
				VoucherMemoNo: VoucherMemoNo,
			}
			$.ajax({
				url: '<?php echo base_url("finance/voucher/VoucherMemo/hapusPayment") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						btn.value = 'HAPUS';
						btn.innerHTML = 'HAPUS';
						btn.disabled = false;
						$('#memoHapus').modal('hide');
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


		function itemBaru() {
			const btn = document.getElementById("btnItemBaru");
			const VoucherMemoNo = $('#VoucherMemoNo').val();
			const VoucherMemoDate = $('#VoucherMemoDate').val();
			const itemDescription = $('#itemDescription').val();
			const itemAmount = $('#itemAmount').val();
			const itemAccountNo = $('#itemAccountNo').val();
			if (document.getElementById('Debit').checked) DebitCredit = document.getElementById('Debit').value;
			if (document.getElementById('Credit').checked) DebitCredit = document.getElementById('Credit').value;
			const itemidRow = $('#itemidRow').val();
			const status = $('#status').val();
			if (itemDescription == '' || itemDescription == null) {
				showSnackError("Harap isi");
				$("#itemDescription").addClass("is-invalid");
			} else {
				btn.value = 'Loading...';
				btn.innerHTML = 'Loading...';
				btn.disabled = true;
				dataPost = {
					VoucherMemoNo: VoucherMemoNo,
					VoucherMemoDate: VoucherMemoDate,
					itemDescription: itemDescription,
					itemAmount: itemAmount,
					itemAccountNo: itemAccountNo,
					DebitCredit: DebitCredit,
					itemidRow: itemidRow,
					status: status,
				}
				$.ajax({
					url: '<?= base_url("finance/voucher/vouchermemo/addItem") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							const btn = document.getElementById("btnItemBaru");
							btn.value = 'SIMPAN';
							btn.innerHTML = 'SIMPAN';
							btn.disabled = false;
							$('#addItem').modal('hide');
							successitem(res.remarks)
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

		function editItem(idrow) {
			dataPost = {
				idrow: idrow
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/voucher/vouchermemo/getItemvoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						if (parseInt(data[0]['Debit']) > parseInt(data[0]['Credit'])) {
							$('#itemAmount').val(data[0]['Debit']);
							radiobtn = document.getElementById("Debit");

						} else {
							$('#itemAmount').val(data[0]['Credit']);
							radiobtn = document.getElementById("Credit");
						}
						radiobtn.checked = true;

						$('#itemDescription').val(data[0]['Description']);
						$('#itemAccountNo').val(data[0]['AccountNo']);
						$('#itemAccountName').val(data[0]['AccountName']);
						$('#itemidRow').val(data[0]['id']);
						$('#status').val("Edit");

						dismisLoading();
						$("#addItem").modal();
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

		function hapusItem(itemidRow) {
			dataPost = {
				idrow: itemidRow
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/voucher/vouchermemo/getItemvoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#itemidRow_hapus').val(data[0]['id']);
						document.getElementById("headermodalhapus").innerHTML = "Delete Item : " + data[0]['Description'];
						document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data[0]['Description'] + " ?";
						dismisLoading();
						$("#hapusItem").modal();
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
			var btn = document.getElementById("btnitemHapus");
			var itemidRow_hapus = $('#itemidRow_hapus').val();
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			dataPost = {
				itemidRow_hapus: itemidRow_hapus,
			}
			$.ajax({
				url: '<?php echo base_url("finance/voucher/vouchermemo/hapusItemvoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						btn.value = 'HAPUS';
						btn.innerHTML = 'HAPUS';
						btn.disabled = false;
						$('#hapusItem').modal('hide');
						successitem(res.remarks)
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

		function successitem(text) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				VoucherMemoCari();
			})
		}

		function VoucherMemoCari() {
			showLoading();
			VoucherMemoNo = document.querySelector('#VoucherMemoNo').value;
			dataPost = {
				VoucherMemoNo: VoucherMemoNo,
			}
			$("#table-detail-payment").dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url("finance/voucher/vouchermemo/caridetailVoucherMemo") ?>',
					dataSrc: 'data',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
				},
				columns: [{
						"data": 'NoUrut',
					},
					{
						"data": 'Description'
					},
					{
						"data": 'AccountNo'
					},
					{
						"data": 'Debit'
					},
					{
						"data": 'Credit'
					},
					{
						"data": 'option'
					}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [5]
				}]
			});
			dismisLoading();
		}

		document.querySelector('#btnPrintPayment').addEventListener('click', e => {
			showLoading();
			dismisLoading();
			const VoucherMemoNo = $('#VoucherMemoNo').val();
			if (VoucherMemoNo == '' || VoucherMemoNo == null) {
				showSnackError("Harap isi Voucher Memo No");
			} else {
				fetch(`<?= base_url('finance/voucher/vouchermemo/cekPrint') ?>?VoucherMemoNo=${VoucherMemoNo}`)
					.then(status)
					.then(response => response.json())
					.then(response => {
						if (response.response < 1) {
							showSnackError('Data Voucher Memo Kosong');
						} else {
							window.location.replace(`<?= base_url('finance/voucher/vouchermemo/cetak') ?>?VoucherMemoNo=${VoucherMemoNo}`);
						}
					});
			}
		});
	</script>
</body>

</html>
