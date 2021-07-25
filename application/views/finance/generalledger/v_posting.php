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
	<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.17.1/dist/bootstrap-table.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<style>
		.dataTables_wrapper .dataTables_filter {
			float: right;
			text-align: right;
			visibility: hidden;
		}
	</style>
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
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped" id="table-detail-payment" style="width: 100%;">
											<thead>
												<tr>
													<th>Transaction No</th>
													<th>Transaction Date</th>
													<th>Transaction Type</th>
													<th>Account No</th>
													<th>Account</th>
													<th>Description</th>
													<th>Amount</th>
													<th></th>
													<th></th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
	</div>
	<div class="modal fade" id="voucherPosting" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id='headerposting'></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="VoucherNo_hapus" class="form-control">
					<div class="section-title" id='infoposting'></div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button class="btn btn-primary" type="button" id="btnPosting" onclick="return PostingVoucher()"> Posting </button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="voucherUnposting" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id='headerUnposting'></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="VoucherNo_hapus" class="form-control">
					<div class="section-title" id='infoUnposting'></div>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button class="btn btn-primary" type="button" id="btnUnposting" onclick="return UnpostingVoucher()"> Unposting </button>
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
				<input type="hidden" id="infoPost">
				<div class="modal-footer bg-whitesmoke br">
					<button class="btn btn-primary" type="button" id="btnDelete" onclick="return itemHapus()"> Delete </button>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.17.1/bootstrap-table.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script>
		// $.fn.dataTableExt.afnFiltering.push(
		//     function( oSettings, aData, iDataIndex ) {
		//         // let iFini = document.getElementById('min').value;
		//         // let iFfin = document.getElementById('max').value;
		//         let tgl = document.getElementById('kolomTgl').value;
		//         let kolomTgl = tgl.split(' - ');
		//         let iFini = kolomTgl[0];
		//         let iFfin = kolomTgl[1];
		//         let iStartDateCol = 1;
		//         let iEndDateCol = 1;
		//         iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
		//         iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
		//         let datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
		//         let datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
		//         if( iFini === "" && iFfin === "" ) {
		//             return true;
		//         } else if( iFini <= datofini && iFfin === "") {
		//             return true;
		//         } else if( iFfin >= datoffin && iFini === "") {
		//             return true;
		//         } else if(iFini <= datofini && iFfin >= datoffin) {
		//             return true;
		//         }
		//         return false;
		//     }
		// );
		$(document).ready(function() {
			var csfrData = {};
			csfrData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
			$("#table-detail-payment").dataTable({
				"ordering": false,
				destroy: true,
				ajax: {
					url: '<?= base_url("finance/generalledger/posting/getAllDataPosting") ?>',
					dataSrc: 'data',
				},
				columns: [{
						"data": 'VoucherNo',
					},
					{
						"data": 'VoucherDate',
					},
					{
						"data": 'transactype',
					},
					{
						"data": 'AccountNo'
					},
					{
						"data": 'Account'
					},
					{
						"data": 'Description'
					},
					{
						"data": 'Amount'
					},
					{
						"data": 'post'
					},
					{
						"data": 'hapus'
					}
				],
				"columnDefs": [{
					"sClass": 'text-right',
					"targets": [6]
				}]
			});
			$('#table-detail-payment thead tr').clone(true).appendTo('#table-detail-payment thead');
			$('#table-detail-payment thead tr:eq(1) th').each(function(i) {
				var title = $(this).text();
				if (i == 2) {
					$(this).html(`<select class="form-control-sm">
                            <option value=""></option>
                            <?php foreach ($voucherType as $type) : ?>
                                <option value="<?= $type; ?>"><?= $type; ?></option>
                            <?php endforeach; ?>
                        </select>`);
					$('select', this).on('change', function() {
						if (table.column(i).search() !== this.value) {
							table
								.column(i)
								.search(this.value)
								.draw();
						}
					});
				} else if (i == 7 || i == 8) {
					$(this).html('');
				} else if (i == 1) {
					// $(this).html(`<input id="min" class="form-control-sm datepicker" type="date" /><input id="max" class="form-control-sm datepicker" type="date" />`);
					$(this).html(`<input id="kolomTgl" class="form-control-sm" type="text" />`);
					$('input', this).on('change', function() {
						table.column(i).draw();
					});
				} else if (i == 6) {
					$(this).html('');
				} else {
					$(this).html(`<input type="text" placeholder="Search '${title}'" />`);
					$('input', this).on('keyup change', function() {
						if (table.column(i).search() !== this.value) {
							table
								.column(i)
								.search(this.value)
								.draw();
						}
					});
				}
			});
			var table = $('#table-detail-payment').DataTable();

		});
		$(function() {
			$('input#kolomTgl').daterangepicker({
				startDate: moment().startOf('hour'),
				endDate: moment().startOf('hour').add(32, 'hour'),
				locale: {
					format: 'YYYY-MM-DD'
				}
			});
		});


		function Filter() {
			showLoading();
			mulai_tanggal = document.getElementById("mulai_tanggal").value;
			sampai_tanggal = document.getElementById("sampai_tanggal").value;
			kode_bank = document.getElementById('kode_bank').value;
			dataPost = {
				mulai_tanggal: mulai_tanggal,
				sampai_tanggal: sampai_tanggal,
				kode_bank: kode_bank
			}
			$("#table-detail-payment").dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url("finance/generalledger/posting/getDataPosting") ?>',
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
						"data": 'transactype',
					},
					{
						"data": 'Account'
					},
					{
						"data": 'Description'
					},
					{
						"data": 'Amount'
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
		}

		function PostingItem(VoucherNo) {
			dataPost = {
				VoucherNo: VoucherNo
			}
			console.log(VoucherNo);
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/generalledger/Posting/getDatavoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#VoucherNo_hapus').val(data[0]['VoucherNo']);
						let voucherNo = (data[0]['VoucherNo'] == undefined) ? data[0]['VoucherMemoNo'] : data[0]['VoucherNo'];
						document.getElementById("headerposting").innerHTML = `Posting Voucher No :  ${voucherNo}`;
						document.getElementById("infoposting").innerHTML = `Are you sure to Posting this data : ${voucherNo}?`;

						dismisLoading();
						$("#voucherPosting").modal();
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

		function UnpostingVoucher() {
			var btn = document.getElementById("btnUnposting");
			var VoucherNo_hapus = $('#VoucherNo_hapus').val();
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			dataPost = {
				VoucherNo: VoucherNo_hapus,
			}
			$.ajax({
				url: '<?php echo base_url("finance/generalledger/Posting/UnpostingVoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						btn.value = 'Unposting';
						btn.innerHTML = 'Unposting';
						btn.disabled = false;
						$('#voucherUnposting').modal('hide');
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

		function PostingVoucher() {
			var btn = document.getElementById("btnPosting");
			var VoucherNo_hapus = $('#VoucherNo_hapus').val();
			console.log(VoucherNo_hapus);
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			dataPost = {
				VoucherNo: VoucherNo_hapus,
			}
			$.ajax({
				url: '<?php echo base_url("finance/generalledger/Posting/postingVoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						btn.value = 'POSTING';
						btn.innerHTML = 'POSTING';
						btn.disabled = false;
						$('#voucherPosting').modal('hide');
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

		function UnpostingItem(VoucherNo) {
			dataPost = {
				VoucherNo: VoucherNo
			}
			showLoading();
			$.ajax({
				url: '<?php echo base_url("finance/generalledger/Posting/getDatavoucher") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#VoucherNo_hapus').val(data[0]['VoucherNo']);
						document.getElementById('headerUnposting').innerHTML = `Unposting Voucher No : ${data[0]['VoucherNo']}`;
						document.getElementById('infoUnposting').innerHTML = `Are you sure to Unposting this data : ${data[0]['VoucherNo']}?`;
						dismisLoading();
						$("#voucherUnposting").modal();
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

		function hapus(VoucherNo_hapus, Posting) {
			dataPost = {
				VoucherNo_hapus: VoucherNo_hapus
			}
			showLoading();
			$.ajax({
				url: '<?= base_url("finance/generalledger/posting/getVoucherbyid") ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						$('#VoucherNo_hapus').val(data[0]['VoucherNo']);
						let voucherNo = (data[0]['VoucherNo'] == undefined) ? data[0]['VoucherMemoNo'] : data[0]['VoucherNo'];
						document.getElementById('headermodalhapus').innerHTML = `Delete Posting ${voucherNo}`;
						document.getElementById('infohapus').innerHTML = `Are you sure to delete this data : ${voucherNo} ?`;
						document.querySelector('#infoPost').value = Posting;
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
			const btn = document.getElementById("btnDelete");
			var code_hapus = $('#VoucherNo_hapus').val();
			let infoPost = document.querySelector('#infoPost').value;
			btn.value = 'Loading...';
			btn.innerHTML = 'Loading...';
			btn.disabled = true;
			dataPost = {
				code_hapus: code_hapus,
			}
			if (infoPost == 1) {
				showSnackError('Data terposting tidak dapat dihapus');
			} else {
				$.ajax({
					url: '<?= base_url("finance/generalledger/posting/deletePosting") ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: res => {
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
					error: (XMLHttpRequest, textStatus, errorThrown) => {
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

		function successposting(text) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				Filter();
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
	</script>
</body>

</html>
