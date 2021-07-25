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
									<hr>
									<h4 id="PeriodeActive">Periode Active : <?php echo $PeriodeActive; ?></h4>
								</div>
								<div class="card-body row">
									<div class="col-lg-4">

										<div class="form-group row">
											<div class="col-md-6">
												<label for="exampleInputPassword1">Cash Bank</label>
												<div class="input-group">
													<input type="text" id="BankCode" name="example-input2-group2" class="form-control form-control-sm" readonly>
													<span class="input-group-append">
														<a href="#" class="edit_record btn btn-primary btn-sm" onclick="cariCashbank()"><i class="fas fa-list-ul"></i></a>
													</span>
												</div>
											</div>
										</div>
										<!-- <div class="form-group row">
											<div class="col-md-6">
												<label for="exampleInputPassword1">Available Saldo</label>
												<div class="input-group">
													<input type="text" id="Saldo" name="example-input2-group2" class="form-control form-control-sm" readonly>
												</div>
											</div>
										</div> -->

										<label for="exampleInputPassword1">Detail Bank</label>
										<div class="form-group" style="margin-top:0px">
											<input type="text" class="form-control form-control-sm mb-1" id="BankName" readonly>
											<input type="text" class="form-control form-control-sm mb-1" id="AccountNo" readonly>
											<input type="text" class="form-control form-control-sm mb-1" id="Valuta" readonly>
										</div>

									</div>
									<!--end col-->
									<div class="col-lg-6">
										<div class="form-group row">
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Payment No:</label>
											<div class="col-sm-9 mb-1">
												<div class="input-group">
													<input class="form-control form-control-sm" id="VoucherNo" type="text" readonly>
													<input class="form-control form-control-sm" id="StatusPY" type="hidden" readonly>
													<span class="input-group-append">
														<button type="button" class="btn  btn-primary btn-sm" id="btncariPYCashbank" onclick="cariPYCashbank()" disabled><i class="fas fa-list-ul"></i></button>
													</span>
												</div>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Payment Date:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="VoucherDate" type="date" readonly>
											</div>
											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Cheque No:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="ChequeNo" type="text" readonly>
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Rate:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="Rate" type="text" readonly>
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Memo:</label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="Description" type="text" readonly>
											</div>

											<label for="example-text-input" class="col-sm-3 col-form-label text-right">Saldo: </label>
											<div class="col-sm-9 mb-1">
												<input class="form-control form-control-sm" id="Saldo" type="text" readonly>
											</div>

										</div>

									</div>
									<!--end col-->
									<div class="col-lg-2">
										<div class="form-group">
											<button type="button" class="btn btn-primary btn-sm btn-block my-1 text-left" id="btn_new_payment" disabled onclick="newPayment()"><i class="fa fa-file px-2"></i> New Payment</button>
											<button type="button" class="btn  btn-primary btn-sm btn-block my-1 text-left" id="btn_edit_payment" disabled onclick="editPayment()"><i class="fa fa-edit px-2"></i> Edit Payment</button>
											<button type="button" class="btn  btn-primary btn-sm btn-block my-1 text-left" id="btn_delete_payment" onclick="paymentHapus()" disabled><i class="fa fa-trash px-2"></i> Delete Payment</button>
											<button type="button" class="btn  btn-primary btn-sm btn-block my-1 text-left" id="btn_save_payment" onclick="paymentBaru()" disabled><i class="fa fa-save px-2"></i> Save Payment</button>
											<!-- Print -->
											<?php $attributes = array('target' => '_blank');; ?>
											<?=
											// form_open('finance/voucher/paymentvoucher/print', $attributes);
											form_open('finance/voucher/paymentvoucher/cetak', $attributes);
											?>
											<input type="hidden" id="printVoucherNo" name="printVoucherNo">
											<input type="hidden" id="printSumAmount" name="printSumAmount">
											<button type="submit" class="btn  btn-primary btn-sm btn-block my-1 text-left" id="btn_print_payment" disabled><span class="text-left"><i class="fa fa-print px-2"></i></span> Print Payment</button>
											<?php echo form_close() ?>
											<!-- End Print -->
											<button type="button" class="btn  btn-primary btn-sm btn-block my-1 text-left" id="btn_selesai_payment" onclick="selesai()" disabled><span class="text-left"><i class="fa fa-check px-2"></i></span> Selesai</button>

										</div>

									</div>
									<!--end col-->
								</div>
								<div class=" card-body">
									<div class="table-responsive">
										<button type="button" class="btn  btn-primary btn-sm" id="btn_get_outstanding" hidden disabled>Get Outstanding</button>
										<button type="button" class="btn  btn-primary btn-sm" id="btn_get_reimbursment" hidden disabled>Get Reimbursment</button>
										<button type="button" class="btn  btn-primary btn-sm mb-2" id="btn_add_item" onclick="addItem()" disabled><i class="fa fa-plus"></i> Add Items</button>
										<table class="table table-striped" id="table-detail-payment">
											<thead>
												<tr>
													<th>NO</th>
													<th>DESCRIPTION</th>
													<th>ACCOUNT</th>
													<th>AMOUNT</th>
													<th width="150px">#</th>
												</tr>
											</thead>
											<tfoot>
												<tr style="font-size: 18px; background-color: #eaeaea;">
													<th colspan="2" id="totalAmountLable">TOTAL AMOUNT</th>
													<th></th>
													<th id="totalAmount"></th>
													<th width="150px">&nbsp;</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</section>

			</div>
			<!-- basic modal -->
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
	</div>
	<div class="modal fade" id="cariPYCashbank" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Payment Voucher</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-pycashbank" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">Payment Voucher NO</th>
								<th class="text-center">Payment Voucher Date</th>
								<th class="text-center">Bank Code</th>
								<th class="text-center">Bank Name</th>
								<th class="text-center">Description</th>
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
	<div class="modal fade" id="paymentHapus" role="dialog" aria-hidden="true">
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
					<button class="btn btn-primary" type="button" id="btnpaymentHapus" onclick="return Hapuspayment()"> Hapus </button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="cariCashbank" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Cash Bank</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">CODE</th>
								<th class="text-center">BANK/CASH</th>
								<th class="text-center">BANK ACCOUNT</th>
								<th class="text-center">ACCOUNT NO</th>
								<th class="text-center">CURRENCY</th>
								<th class="text-center">SALDO</th>
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
	<div class="modal fade" id="addItem" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Input Item Payment</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" class="form-control form-control-sm" id="itemidRow" required="">
					<input type="hidden" class="form-control form-control-sm" id="status" required="">
					<div class="form-group">
						<label for="useremail">Description</label>
						<input type="text" class="form-control form-control-sm" id="itemDescription" required="">
					</div>
					<div class="form-group">
						<label for="useremail">Amount</label>
						<input type="text" class="form-control form-control-sm" id="itemDebit" required="">
					</div>
					<div class="form-group row">
						<div class="col-md-6">
							<label for="exampleInputPassword1">Account</label>
							<div class="input-group">
								<input type="text" id="itemAccountNo" name="example-input2-group2" class="form-control form-control-sm" readonly>
								<span class="input-group-append">
									<a href="#" class="edit_record btn btn-primary btn-sm" onclick="cariAccountNo()"><i class="fas fa-list-ul"></i></a>
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
						<i class="fa fa-check"></i> SIMPAN
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
		const rupiah = document.querySelector('#itemDebit');
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
		$(document).ready(function() {
			$("#VoucherDate").change(function() {
				$("#VoucherDate").removeClass("is-invalid");
			});
			$("#Description").keyup(function() {
				$("#Description").removeClass("is-invalid");
			});
			$("#itemDescription").keyup(function() {
				$("#itemDescription").removeClass("is-invalid");
			});
			$("#Rate").keyup(function() {
				$("#Rate").removeClass("is-invalid");
			});

			$('#totalAmount').text('');
			$('#totalAmountLable').text('');

			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});

		function cariCashbank() {
			showLoading();
			$("#table-menu").dataTable({
				destroy: true,
				ajax: {
					url: '<?php echo base_url("finance/voucher/paymentvoucher/getCashbank") ?>',
					dataSrc: 'data'
				},
				columns: [{
						"data": 'BankCode',
					},
					{
						"data": 'BankName'
					},
					{
						"data": 'BankAccount'
					},
					{
						"data": 'AccountNo'
					},
					{
						"data": 'Valuta'
					},
					{
						"data": 'Saldo'
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

			dismisLoading();
			$("#cariCashbank").modal();

			$('#table-menu tbody').on('click', 'tr', function() {
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');

				var Kode_Bank = $td.eq(0).text();
				var Nama_Bank = $td.eq(1).text();
				var No_Rek = $td.eq(2).text();
				var AccountNo = $td.eq(3).text();
				var Valuta = $td.eq(4).text();
				var Saldo = $td.eq(5).text();

				document.getElementById("BankName").value = Nama_Bank;
				document.getElementById("BankCode").value = Kode_Bank;
				document.getElementById("AccountNo").value = AccountNo;
				document.getElementById("Valuta").value = Valuta;
				document.getElementById("Saldo").value = Saldo;
				document.getElementById("VoucherNo").value = '/' + Kode_Bank + "/K/<?= $PeriodeActive; ?>";
				document.getElementById("btn_new_payment").disabled = false;
				document.getElementById("btncariPYCashbank").disabled = false;

				// Efek Terhadapt Tombol
				document.getElementById("btn_edit_payment").disabled = true;
				document.getElementById("btn_save_payment").disabled = true;
				document.getElementById("btn_delete_payment").disabled = true;
				document.getElementById("btn_print_payment").disabled = true;
				document.getElementById("btn_selesai_payment").disabled = true;

				// Efek Terhadap Form
				document.getElementById("ChequeNo").readOnly = true;
				document.getElementById("VoucherDate").readOnly = true;
				document.getElementById("Rate").readOnly = true;
				document.getElementById("Description").readOnly = true;
				document.getElementById("ChequeNo").value = '';
				document.getElementById("VoucherDate").value = '';
				document.getElementById("Rate").value = '';
				document.getElementById("Description").value = '';
				if (Valuta == "IDR") {
					document.getElementById("Rate").value = '1';
					document.getElementById("Rate").readOnly = true;
				}

				$("#VoucherDate").removeClass("is-invalid");
				$("#Description").removeClass("is-invalid");
				$("#Rate").removeClass("is-invalid");

				// flash Table item
				$('#table-detail-payment').DataTable().clear().draw();
				$('#table-detail-payment').DataTable().destroy();
				$('#totalAmount').text('');
				$('#totalAmountLable').text('');

				$('#cariCashbank').modal('hide');
			});

		}

		function cariPYCashbank() {

			showLoading();
			BankCode = document.getElementById("BankCode").value;
			dataPost = {
				BankCode: BankCode
			}

			$("#table-pycashbank").dataTable({
				destroy: true,
				ajax: {
					url: '<?php echo base_url("finance/voucher/paymentvoucher/getPYCashbank") ?>',
					dataSrc: 'data',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
				},
				columns: [{
						"data": 'VoucherNo',
					},
					{
						"data": 'VoucherDate',
					},
					{
						"data": 'BankCode'
					},
					{
						"data": 'BankName'
					},
					{
						"data": 'Description'
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
			$("#cariPYCashbank").modal();

			$('#table-pycashbank tbody').on('click', 'tr', function() {
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');

				var VoucherNo = $td.eq(0).text();
				var BankCode = $td.eq(2).text();
				var BankName = $td.eq(3).text();

				document.getElementById("VoucherNo").value = VoucherNo;
				document.getElementById("BankCode").value = BankCode;
				document.getElementById("BankName").value = BankName;


				document.getElementById("btn_edit_payment").disabled = false;
				document.getElementById("btn_selesai_payment").disabled = false;
				PaymentvoucherCari();

				$('#cariPYCashbank').modal('hide');
			});

		}

		function newPayment() {
			BankCode = document.getElementById("BankCode").value;
			dataPost = {
				BankCode: BankCode
			}
			$.ajax({
				type: 'POST',
				url: '<?= base_url("finance/voucher/paymentvoucher/cariVoucherNo"); ?>',
				dataType: 'json',
				data: dataPost,
				success: function(result) {
					dismisLoading();
					document.getElementById("VoucherNo").value = result['VoucherNo'] + '/' + BankCode + "/K/<?= $PeriodeActive; ?>";
					document.getElementById("printVoucherNo").value = result['VoucherNo'] + '/' + BankCode + "/K/<?= $PeriodeActive; ?>";

					document.getElementById("btn_new_payment").disabled = true;
					document.getElementById("btn_save_payment").disabled = false;
					document.getElementById("btn_edit_payment").disabled = true;
					document.getElementById("StatusPY").value = 'New';
					document.getElementById("ChequeNo").readOnly = false;
					document.getElementById("VoucherDate").readOnly = false;
					document.getElementById("Rate").readOnly = false;
					document.getElementById("Description").readOnly = false;
					document.getElementById("ChequeNo").value = '';
					document.getElementById("VoucherDate").value = '';
					document.getElementById("Rate").value = '';
					document.getElementById("Description").value = '';
					if ($('#Valuta').val() == "IDR") {
						document.getElementById("Rate").value = '1';
						document.getElementById("Rate").readOnly = true;
					}
				}
			})
		}


		function paymentBaru() {
			var btn = document.getElementById("btn_save_payment");
			var BankCode = $('#BankCode').val();
			var VoucherNo = $('#VoucherNo').val();
			var VoucherDate = $('#VoucherDate').val();
			var ChequeNo = $('#ChequeNo').val();
			var Rate = $('#Rate').val();
			var Description = $('#Description').val();
			var StatusPY = $('#StatusPY').val();
			var Valuta = $('#Valuta').val();

			if (VoucherDate == "" || VoucherDate == null) {
				$("#VoucherDate").addClass("is-invalid");
				showSnackError("Harap isi");
			} else if (Valuta != "IDR" && Rate == "" || Rate == null) {
				$("#Rate").addClass("is-invalid");
				showSnackError("Harap isi");
			} else if (Description == "" || Description == null) {
				$("#Description").addClass("is-invalid");
				showSnackError("Harap isi");
			} else {
				$("#VoucherDate").removeClass("is-invalid");
				$("#Description").removeClass("is-invalid");
				$("#Rate").removeClass("is-invalid");
				btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
				btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
				btn.disabled = true;
				dataPost = {
					BankCode: BankCode,
					VoucherNo: VoucherNo,
					VoucherDate: VoucherDate,
					ChequeNo: ChequeNo,
					Rate: Rate,
					Description: Description,
					StatusPY: StatusPY,
				}
				$.ajax({
					url: '<?php echo base_url("finance/voucher/paymentvoucher/addPayment") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							successpayment(res.remarks);
							btn.value = '<i class="fa fa-save px-2"></i> Save Payment';
							btn.innerHTML = '<i class="fa fa-save px-2"></i> Save Payment';
							document.getElementById("btn_selesai_payment").disabled = false;
							document.getElementById("btn_edit_payment").disabled = false;
							btn.disabled = false;
						} else {
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

		function editPayment() {
			document.getElementById("btn_new_payment").disabled = true;
			document.getElementById("btn_save_payment").disabled = false;
			document.getElementById("btn_edit_payment").disabled = false;
			document.getElementById("btn_delete_payment").disabled = true;
			document.getElementById("btn_print_payment").disabled = true;
			document.getElementById("btn_save_payment").disabled = false;
			document.getElementById("StatusPY").value = 'Edit';
			document.getElementById("ChequeNo").readOnly = false;
			document.getElementById("VoucherDate").readOnly = false;
			document.getElementById("Rate").readOnly = false;
			document.getElementById("Description").readOnly = false;
			if ($('#Valuta').val() == "IDR") {
				document.getElementById("Rate").value = '1';
				document.getElementById("Rate").readOnly = true;
			}
		};

		function paymentHapus() {
			var VoucherNo = $('#VoucherNo').val();
			dataPost = {
				VoucherNo: VoucherNo
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/voucher/paymentvoucher/getPaymentvoucherbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						document.getElementById("headervoucherhapus").innerHTML = "Delete Item : " + data[0]['VoucherNo'];
						document.getElementById("infovoucherhapus").innerHTML = "Are you sure to delete this data : " + data[0]['VoucherNo'] + " ?";

						dismisLoading();
						$("#paymentHapus").modal();
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
			var btn = document.getElementById("btnpaymentHapus");
			var VoucherNo = $('#VoucherNo').val();
			btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
			btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
			btn.disabled = true;
			dataPost = {
				VoucherNo: VoucherNo,
			}
			$.ajax({
				url: '<?php echo base_url("finance/voucher/paymentvoucher/hapusPayment") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						btn.value = 'HAPUS';
						btn.innerHTML = 'HAPUS';
						btn.disabled = false;
						$('#paymentHapus').modal('hide');
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


		function cariAccountNo() {

			showLoading();
			$("#table-account").dataTable({
				destroy: true,
				ajax: {
					url: '<?php echo base_url("finance/voucher/paymentvoucher/getAccountNo") ?>',
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
					"targets": [3]
				}]
			});

			dismisLoading();
			$("#cariAccountNo").modal();

			$('#table-account tbody').on('click', 'tr', function() {
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');

				var AccountNo = $td.eq(1).text();
				var AccountName = $td.eq(2).text();

				document.getElementById("itemAccountNo").value = AccountNo;
				document.getElementById("itemAccountName").value = AccountName;
				$('#cariAccountNo').modal('hide');
			});

		}

		function PaymentvoucherCari() {
			showLoading();
			VoucherNo = document.getElementById("VoucherNo").value;
			dataPost = {
				VoucherNo: VoucherNo,
			}
			$.ajax({
				url: '<?php echo base_url("finance/voucher/paymentvoucher/getPaymentvoucherbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						total = res.total;
						$('#VoucherNo').val(data[0]['VoucherNo']);
						$('#VoucherDate').val(data[0]['VoucherDate']);
						$('#ChequeNo').val(data[0]['ChequeNo']);
						$('#Rate').val(data[0]['Rate']);
						$('#Description').val(data[0]['Description']);
						$('#Amount').val(data[0]['Amount']);

						// For Print
						$('#printVoucherNo').val(data[0]['VoucherNo']);
						$('#printSumAmount').val(data[0]['Amount']);
						// End Print
						// total 
						$('#totalAmount').text(total);
						$('#totalAmountLable').text('TOTAL AMOUNT');

						$("#table-detail-payment").dataTable({
							paging: false,
							ordering: false,
							info: false,
							searching: false,
							destroy: true,
							ajax: {
								url: '<?php echo base_url("finance/voucher/paymentvoucher/caridetailPaymentvoucher") ?>',
								dataSrc: 'data',
								type: 'POST',
								dataType: 'json',
								data: dataPost,
							},
							columns: [{
									"data": 'DetailNo',
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
									"data": 'option'
								}
							],
							"columnDefs": [{
								"sortable": false,
								"targets": [3]
							}]
						});
						dismisLoading();
						document.getElementById("btn_new_payment").disabled = true;
						document.getElementById("btn_save_payment").disabled = true;
						// document.getElementById("btn_edit_payment").disabled = false;
						document.getElementById("btn_delete_payment").disabled = false;
						document.getElementById("btn_print_payment").disabled = false;
						document.getElementById("btn_add_item").disabled = false;
						document.getElementById("ChequeNo").readOnly = true;
						document.getElementById("VoucherDate").readOnly = true;
						document.getElementById("Rate").readOnly = true;
						document.getElementById("Description").readOnly = true;
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

		function successitem(text) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				PaymentvoucherCari();
			})
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

		function selesai() {
			location.reload(true);
		}

		function successpayment(text) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				PaymentvoucherCari();
			})
		}

		function addItem() {

			showLoading();
			dismisLoading();
			$("#addItem").modal();
			document.getElementById("status").value = "Tambah";
		}

		function editItem(idrow) {
			dataPost = {
				idrow: idrow
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/voucher/paymentvoucher/getItemvoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#itemDescription').val(data[0]['Description']);
						$('#itemDebit').val(data[0]['Debit']);
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

		function itemBaru() {
			var btn = document.getElementById("btnItemBaru");
			var VoucherNo = $('#VoucherNo').val();
			var itemDescription = $('#itemDescription').val();
			var itemDebit = $('#itemDebit').val();
			var itemAccountNo = $('#itemAccountNo').val();
			var itemidRow = $('#itemidRow').val();
			var status = $('#status').val();

			if (itemDescription == "" || itemDescription == null) {
				$("#itemDescription").addClass("is-invalid");
				showSnackError("Harap isi");
			} else {
				$("#itemDescription").removeClass("is-invalid");
				btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
				btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
				btn.disabled = true;
				dataPost = {
					VoucherNo: VoucherNo,
					itemDescription: itemDescription,
					itemDebit: itemDebit,
					itemAccountNo: itemAccountNo,
					itemidRow: itemidRow,
					status: status,
				}
				$.ajax({
					url: '<?php echo base_url("finance/voucher/paymentvoucher/addItem") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							document.getElementById("itemDescription").value = "";
							document.getElementById("itemDebit").value = "";
							document.getElementById("itemAccountNo").value = "";
							document.getElementById("itemidRow").value = "";


							var btn = document.getElementById("btnItemBaru");
							btn.value = '<i class="fa fa-check"></i> SIMPAN';
							btn.innerHTML = '<i class="fa fa-check"></i> SIMPAN';
							btn.disabled = false;
							$('#addItem').modal('hide');
							successitem(res.remarks)
						} else {
							btn.value = '<i class="fa fa-check"></i> SIMPAN';
							btn.innerHTML = '<i class="fa fa-check"></i> SIMPAN';
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

		function hapusItem(itemidRow) {
			dataPost = {
				idrow: itemidRow
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/voucher/paymentvoucher/getItemvoucher") ?>',
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
			btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
			btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading...</div>';
			btn.disabled = true;
			dataPost = {
				itemidRow_hapus: itemidRow_hapus,
			}
			$.ajax({
				url: '<?php echo base_url("finance/voucher/paymentvoucher/hapusItemvoucher") ?>',
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
	</script>

</body>

</html>
