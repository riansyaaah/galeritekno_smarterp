<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $title; ?></title>
	<link rel='shortcut icon' type='image/x-icon' href="<?= base_url('assets/template/img/favicon.ico'); ?>" />
	<link rel="stylesheet" href="<?= base_url('assets/template/css/app.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/datatables.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/pretty-checkbox/pretty-checkbox.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/select2/dist/css/select2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/components.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/custom.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/sweetalert2.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/bundles/izitoast/css/iziToast.min.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/template/css/snackbar.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
	<style>
		.hidetd {
            display: none !important;
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
						<div class="card">
							<div class="card-header">
								<h4><?= $title; ?></h4><hr>
								<h4 id="PeriodeActive">Periode Active : <?= $PeriodeActive; ?></h4>
							</div>
							<div class="card-body row">
								<div class="col-lg-5">
									<div class="form-group row">
										<div class="col-md-6">
											<label for="exampleInputPassword1">Supplier</label>
											<div class="input-group">
												<input type="text" id="noSupplier" name="example-input2-group2" class="form-control form-control-sm" readonly>
												<span class="input-group-append">
													<button id="btnCariSupplier" class="edit_record btn btn-primary btn-sm"><i class="fas fa-list-ul"></i></button>
												</span>
											</div>
										</div>
									</div>
									<label for="exampleInputPassword1">Detail Supplier</label>
									<div class="form-group" style="margin-top:0px">
										<input type="hidden" id="idSupplier">
										<input type="hidden" id="typeSupplier">
										<input type="text" class="form-control form-control-sm mb-1" id="kodeSupplier" readonly>
										<input type="text" class="form-control form-control-sm mb-1" id="namaSupplier" readonly>
									</div>
								</div>
								<div class="col-lg-7">
									<div class="form-group row">
										<label for="noPO" class="col-sm-3 col-form-label text-right">No. Purchase Order</label>
										<div class="col-sm-9 mb-1">
											<div class="input-group">
												<input type="hidden" id="idPO">
												<input class="form-control form-control-sm" id="noPO" type="text" readonly>
												<input class="form-control form-control-sm" id="StatusPY" type="hidden">
												<span class="input-group-append">
													<button type="button" class="btn btn-primary btn-sm" id="btnCariPO" disabled><i class="fas fa-list-ul"></i></button>
												</span>
											</div>
										</div>
										<label for="noTransaction" class="col-sm-3 col-form-label text-right">No. Transaksi</label>
										<div class="col-sm-9 mb-1">
											<input class="form-control form-control-sm" id="noTransaction" type="text" readonly>
										</div>
										<label for="tglTransaction" class="col-sm-3 col-form-label text-right">Tanggal Masuk</label>
										<div class="col-sm-9 mb-1">
											<input class="form-control form-control-sm" id="tglTransaction" type="date" readonly>
										</div>
										<label for="suratJalan" class="col-sm-3 col-form-label text-right">No. Surat Jalan</label>
										<div class="col-sm-9 mb-1">
											<input class="form-control form-control-sm" id="suratJalan" type="text" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<button type="button" class="btn btn-primary btn-sm my-2 text-left" id="btnSaveTransaction" disabled><i class="fa fa-save px-2"></i> Save Transaction</button>
								<input type="hidden" id="printVoucherNo">
								<input type="hidden" id="printSumAmount">
								<button class="btn btn-primary btn-sm my-2 text-left" id="btnPrintTransaction" disabled><i class="fa fa-print px-2"></i>Print Transaction</button>
								<button class="btn btn-primary btn-sm my-2 text-left" id="btnSelesai" disabled><i class="fa fa-check px-2"></i>Selesai</button>
								<div id="tombolPrint"></div>
								<div class="table-responsive">
									<table class="table table-striped" id="tablePODetail" style="width: 100%;">
										<thead>
											<tr class="text-center">
												<th style="width: 30%">Item</th>
												<th style="width: 15%">Harga Satuan</th>
												<th style="width: 10%">Jumlah</th>
												<th style="width: 15%">Jumlah Aktual</th>
												<th style="width: 15%">Kondisi</th>
												<th class="hidetd">Input Jumlah</th>
												<th class="hidetd">Input Harga Satuan</th>
												<th style="width: 15%">Kadaluwarsa</th>
											</tr>
										</thead>
										<tfoot>
											<tr style="font-size: 18px; background-color: #eaeaea;">
												<th colspan="2" id="totalAmountLable">TOTAL AMOUNT</th>
												<th id="totalAmount"></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</tfoot>
									</table>
								</div>
							</div>
						</div>
				</section>
			</div>
			<?php $this->load->view('layout/v_footer'); ?>
		</div>
	</div>
	<div class="modal fade" id="modalCariPO" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Purchase Order</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-pycashbank" style="width:100%;">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">#</th>
								<th class="text-center hidetd">id</th>
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
	<div class="modal fade" id="modalCariSupplier" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Supplier</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-hover" id="table-menu" style="width:100%;">
						<thead>
							<tr class="text-center">
								<th style="width: 10%;">Kode</th>
								<th>Supplier</th>
								<th style="width: 5%;"></th>
								<th class="hidetd">id</th>
								<th class="hidetd">type</th>
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
	<script src="<?= base_url('assets/template/js/app.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/datatables.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js'); ?>">
	</script>
	<script src="<?= base_url('assets/template/bundles/jquery-ui/jquery-ui.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/datatables.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/sweetalert/sweetalert.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/select2/dist/js/select2.full.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/sweetalert2.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/scripts.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/custom.js'); ?>"></script>
	<script src="<?= base_url('assets/template/bundles/izitoast/js/iziToast.min.js'); ?>"></script>
	<script src="<?= base_url('assets/template/js/page/toastr.js'); ?>"></script>
	<script>
		document.querySelector('#btnPrintTransaction').addEventListener('click', e => {
			const noTransaction = document.querySelector('#noTransaction').value;
			document.querySelector('#tombolPrint').innerHTML = `<a href="<?= base_url('inventory/transaction/stockin/cetak') ?>?noTransaction=${noTransaction}" id="btnPrint" target="_blank"></a>`;
			document.querySelector('#btnPrint').click();
		});
		document.querySelector('#tglTransaction').addEventListener('change', e => {
			e.target.classList.remove('is-invalid');
		});
		document.querySelector('#noTransaction').addEventListener('change', e => {
			e.target.classList.remove('is-invalid');
		});
		document.querySelector('#suratJalan').addEventListener('change', e => {
			e.target.classList.remove('is-invalid');
		});
		$(document).ready(function() {
			$('#totalAmount').text('');
			$('#totalAmountLable').text('');
			let csfrData = {};
			csfrData['<?= $this->security->get_csrf_token_name(); ?>'] = '<?= $this->security->get_csrf_hash(); ?>';
			$.ajaxSetup({
				data: csfrData
			});
		});
		document.querySelector('#btnCariSupplier').addEventListener('click', e => {
			showLoading();
			$('#table-menu').dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url('inventory/transaction/stockin/getallsupplier') ?>',
					dataSrc: 'data'
				},
				columns: [
					{"data": 'kode'},
					{"data": 'nama'},
					{"data": 'option'},
					{"data": 'id'},
					{"data": 'type'}
				],
				"columnDefs": [
					{
						"sortable": false,
						"targets": [2]
					}
				],
                "createdRow": (row, data, index) => {
                	$('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(2).addClass('text-center');
                    $('td', row).eq(3).addClass('hidetd');
                    $('td', row).eq(4).addClass('hidetd');
                }
			});
			dismisLoading();
			$("#modalCariSupplier").modal();
			$('#table-menu tbody').on('click', 'tr', function() {
				event.preventDefault();
				const $td = $(this).closest('tr').children('td');
				const kode = $td.eq(0).text();
				const nama = $td.eq(1).text();
				const id = $td.eq(3).text();
				const type = $td.eq(4).text();
				document.querySelector('#noSupplier').value = kode;
				document.querySelector('#kodeSupplier').value = kode;
				document.querySelector('#namaSupplier').value = nama;
				document.querySelector('#idSupplier').value = id;
				document.querySelector('#typeSupplier').value = type;
				document.querySelector('#noPO').value = `/PO/<?= $PeriodeActive; ?>`;
				document.querySelector('#btnCariPO').disabled = false;
				document.querySelector('#btnSaveTransaction').disabled = true;
				document.querySelector('#btnPrintTransaction').disabled = true;
				document.querySelector('#kodeSupplier').readOnly = true;
				document.querySelector('#namaSupplier').readOnly = true;
				document.querySelector('#btnSelesai').disabled = true;
				document.querySelector('#tglTransaction').classList.remove('is-invalid');
				$('#tablePODetail').DataTable().clear().draw();
				$('#tablePODetail').DataTable().destroy();
				document.querySelector('#totalAmount').textContent = '';
				document.querySelector('#totalAmountLable').textContent = '';
				$('#modalCariSupplier').modal('hide');
			});
		});
		document.querySelector('#btnSelesai').addEventListener('click', e => {
			location.reload(true);
		});
		document.querySelector('#btnCariPO').addEventListener('click', e => {
			showLoading();
			dataPost = {
				idSupplier: document.querySelector('#idSupplier').value,
				typeSupplier: document.querySelector('#typeSupplier').value
			}
			$('#table-pycashbank').dataTable({
				destroy: true,
				ajax: {
					url: '<?= base_url('inventory/transaction/stockin/getallpo') ?>',
					dataSrc: 'data',
					type: 'POST',
					dataType: 'json',
					data: dataPost
				},
				columns: [
					{"data": 'noPO'},
					{"data": 'tglPO'},
					{"data": 'option'},
					{"data": 'id'}
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [2]
				}],
                "createdRow": (row, data, index) => {
                	$('td', row).eq(0).addClass('text-center');
                	$('td', row).eq(1).addClass('text-center');
                	$('td', row).eq(2).addClass('text-center');
                    $('td', row).eq(3).addClass('hidetd');
                }
			});
			dismisLoading();
			$("#modalCariPO").modal();
			$('#table-pycashbank tbody').on('click', 'tr', function() {
				event.preventDefault();
				const $td = $(this).closest('tr').children('td');
				const noPO = $td.eq(0).text();
				const id = $td.eq(3).text();
				document.querySelector('#noPO').value = noPO;
				document.querySelector('#idPO').value = id;
				generateNoTransaction();
				document.querySelector('#tglTransaction').disabled = false;
				document.querySelector('#suratJalan').disabled = false;
				document.querySelector('#tglTransaction').removeAttribute('readonly');
				document.querySelector('#tglTransaction').value = '<?= date('Y-m-d'); ?>';
				document.querySelector('#suratJalan').removeAttribute('readonly');
				ReceiptvoucherCari();
				$('#modalCariPO').modal('hide');
			});
		});

		function generateNoTransaction() {
			fetch('<?= base_url('inventory/transaction/stockin/generatenotransaction'); ?>')
				.then(res => res.json())
				.then(res => {
					document.querySelector('#noTransaction').value = res.data;
				})
				.catch(e => console.log(e));
		}

		function newReceipt() {
			showLoading();
			const idSupplier = document.querySelector('#idSupplier').value;
			dataPost = {
				idSupplier: idSupplier
			}
			$.ajax({
				type: 'POST',
				url: '<?= base_url('inventory/purchasing/purchaseorder/caripono'); ?>',
				dataType: 'json',
				data: dataPost,
				success: function(result) {
					dismisLoading();
					document.querySelector('#noPO').value = result['noPO'];
					document.getElementById("printVoucherNo").value = result['noPO'];
					document.getElementById("btn_new_Receipt").disabled = true;
					document.getElementById("btnSaveTransaction").disabled = false;
					document.getElementById("btn_edit_Receipt").disabled = true;
					document.getElementById("StatusPY").value = 'New';
					document.getElementById("tglTransaction").readOnly = false;
					document.getElementById("tglTransaction").value = '';
				}
			})
		}

		document.querySelector('#btnSaveTransaction').addEventListener('click', e => {
			const btn = document.getElementById("btnSaveTransaction");
			let table = $('#tablePODetail').DataTable();
			const dataPost = {
				noTransaction: document.querySelector('#noTransaction').value,
				tglTransaction: document.querySelector('#tglTransaction').value,
				idSupplier: document.querySelector('#idSupplier').value,
				typeSupplier: document.querySelector('#typeSupplier').value,
				noPO: document.querySelector('#noPO').value,
				suratJalan: document.querySelector('#suratJalan').value
			}
			let form = `${new URLSearchParams(dataPost).toString()}&${table.$('input, select').serialize()}`;
			if(!dataPost.noPO) {
				document.querySelector('#noPO').classList.add('is-invalid');
				showSnackError('Harap isi');
			} else if(!dataPost.noTransaction) {
				document.querySelector('#noTransaction').classList.add('is-invalid');
				showSnackError('Harap isi');
			} else if (!dataPost.tglTransaction) {
				$('#tglTransaction').addClass('is-invalid');
				document.querySelector('#tglTransaction').classList.add('is-invalid');
				showSnackError('Harap isi');
			} else {
				btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
				btn.disabled = true;
				console.log(`<?= base_url('inventory/transaction/stockin/savetransaction') ?>?${form}`);
				fetch(`<?= base_url('inventory/transaction/stockin/savetransaction') ?>?${form}`)
					.then(response => response.json())
					.then(res => {
						if(res.status_json) {
							successReceipt(res.remarks);
							btn.innerHTML = '<i class="fa fa-save px-2"></i> Save Transaction';
						} else {
							showSnackError(res.remarks);
						}
					})
					.catch(e => {
						console.log(e);
						btn.innerHTML = 'Gagal, Coba lagi';
						btn.disabled = false;
					});
				document.querySelector('#btnPrintTransaction').disabled = false;
				document.querySelector('#btnSelesai').disabled = false;
			}
		});

		function editReceipt() {

			showLoading();
			dismisLoading();
			document.getElementById("btn_new_Receipt").disabled = true;
			document.getElementById("btnSaveTransaction").disabled = false;
			document.getElementById("btn_edit_Receipt").disabled = false;
			document.getElementById("btn_delete_Receipt").disabled = true;
			document.getElementById("btnPrintTransaction").disabled = true;
			document.getElementById("btnSaveTransaction").disabled = false;
			document.getElementById("StatusPY").value = 'Edit';
			document.getElementById("tglTransaction").readOnly = false;
		};

		function HapusReceipt() {
			var btn = document.getElementById("btnReceiptHapus");
			var idPOHapus = document.querySelector('#idPOHapus').value;
			btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
			btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
			btn.disabled = true;
			dataPost = {id: idPOHapus}
			$.ajax({
				url: '<?= base_url('inventory/purchasing/purchaseorder/hapuspo') ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						btn.value = 'HAPUS';
						btn.innerHTML = 'HAPUS';
						btn.disabled = false;
						$('#ReceiptHapus').modal('hide');
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
					url: '<?= base_url('inventory/purchasing/purchaseorder/getallitem') ?>',
					dataSrc: 'data'
				},
				columns: [
					{"data": 'itemmaster'},
					{"data": 'unit'},
					{"data": 'hargabeli'},
					{"data": 'hargajual'},
					{"data": 'stock'},
					{"data": 'button'},
					{"data": 'id'},
				],
				"columnDefs": [{
					"sortable": false,
					"targets": [5]
				}],
                "createdRow": (row, data, index ) => {
                    $('td', row).eq(6).addClass("hidetd");
                }
			});

			dismisLoading();
			$("#cariAccountNo").modal();
			$('#table-account tbody').on('click', 'tr', function() {
				event.preventDefault();
				var $td = $(this).closest('tr').children('td');
				var item = $td.eq(0).text();
				var id = $td.eq(6).text();

				document.querySelector('#idItemMaster').value = id;
				document.getElementById("itemAccountNo").value = item;
				document.getElementById("itemAccountName").value = item;
				$('#cariAccountNo').modal('hide');
			});

		}

		function ReceiptvoucherCari() {
			showLoading();
			noPO = document.querySelector('#noPO').value;
			dataPost = {noPO: noPO}
			$.ajax({
				url: '<?= base_url('inventory/transaction/stockin/getpobyno') ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					if (res.status_json) {
						data = res.data;
						total = res.total;
						$('#noPO').val(data['noPO']);
						$('#totalAmount').text(total);
						$('#totalAmountLable').text('TOTAL AMOUNT');
						postData = {idPO: data['id']}
						console.log('<?= base_url('inventory/transaction/stockin/getpodetailbyidpo') ?>?idPO='+data['id']);
						$("#tablePODetail").dataTable({
							info: false,
							searching: false,
							destroy: true,
							ajax: {
								url: '<?= base_url('inventory/transaction/stockin/getpodetailbyidpo') ?>',
								dataSrc: 'data',
								type: 'POST',
								dataType: 'json',
								data: postData
							},
							columns: [
								{"data": 'itemmaster'},
								{
									"data": 'hargaSatuan',
									render: $.fn.dataTable.render.number('.', ',', 0)
								},
								{"data": 'jumlah'},
								{"data": 'formJumlahAktual'},
								{"data": 'formKondisi'},
								{"data": 'formJumlah'},
								{"data": 'formHargaSatuan'},
								{"data": 'formTglExpired'}
							],
							"columnDefs": [
								{
									"sortable": false,
									"targets": [3,4]
								}
							],
			                "createdRow": (row, data, index) => {
			                    $('td', row).eq(5).addClass('hidetd');
			                    $('td', row).eq(6).addClass('hidetd');
			                    // $('td', row).eq(7).addClass('hidetd');
			                }
						});
						dismisLoading();
						document.querySelector('#btnSaveTransaction').disabled = false;
					} else {
						showSnackError(res.remarks);
						dismisLoading();
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					console.log(XMLHttpRequest, textStatus, errorThrown);
					showSnackError(XMLHttpRequest);
					dismisLoading();
				},
				timeout: 60000
			});
		}

		function selesai() {
			location.reload(true);
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
				ReceiptvoucherCari();
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

		function successReceipt(text) {
			Swal.fire({
				title: 'Info',
				html: text,
				type: "success",
				confirmButtonText: 'Ok',
				confirmButtonColor: "#46b654",
			}).then((result) => {
				ReceiptvoucherCari();
			})
		}

		function addItem() {
			showLoading();
			dismisLoading();
			document.querySelector('#status').value = 'Tambah';
			$("#addItem").modal();
		}

		function itemBaru() {
			const btn = document.querySelector('#btnItemBaru');
			const dataPost = {
				noPO: document.querySelector('#noPO').value,
				idPO: document.querySelector('#idPO').value,
				hargaSatuan: document.querySelector('#hargaSatuan').value,
				itemJumlah: document.querySelector('#itemJumlah').value,
				status: document.querySelector('#status').value,
				itemAccountNo: document.querySelector('#itemAccountNo').value,
				idPOD: document.querySelector('#idPOD').value
			}
			if (!dataPost.hargaSatuan) {
				$('#hargaSatuan').addClass('is-invalid');
				showSnackError('Harap Isi');
			} else if(!dataPost.itemJumlah) {
				$('#itemJumlah').addClass('is-invalid');
				showSnackError('Harap Isi');
			} else if(!dataPost.itemAccountNo) {
				$('#itemAccountNo').addClass('is-invalid');
				showSnackError('Harap Isi');
			} else {
				$('#hargaSatuan').removeClass('is-invalid');
				$('#itemJumlah').removeClass('is-invalid');
				$('#itemAccountNo').removeClass('is-invalid');
				btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
				btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
				btn.disabled = true;
				console.log(dataPost);
				$.ajax({
					url: '<?= base_url('inventory/purchasing/purchaseorder/additem') ?>',
					type: 'POST',
					dataType: 'json',
					data: dataPost,
					success: function(res) {
						console.log(res)
						if (res.status_json) {
							document.getElementById("hargaSatuan").value = "";
							document.getElementById("itemJumlah").value = "";
							document.getElementById("itemAccountNo").value = "";
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
						console.log(XMLHttpRequest, textStatus, errorThrown);
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
				id: itemidRow
			}
			showLoading();
			$.ajax({
				url: '<?= base_url('inventory/purchasing/purchaseorder/getpodbyid') ?>',
				type: 'POST',
				dataType: 'json',
				data: dataPost,
				success: function(res) {
					console.log(res)
					if (res.status_json) {
						data = res.data;
						document.querySelector('#itemidRow_hapus').value = data.id;
						document.getElementById("headermodalhapus").innerHTML = "Delete Item : " + data.itemmaster;
						document.getElementById("infohapus").innerHTML = "Are you sure to delete this data : " + data.itemmaster + " ?";

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
			var itemidRow_hapus = document.querySelector('#itemidRow_hapus').value;
			btn.value = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
			btn.innerHTML = '<div class="text-center"><i class="fas fa-hourglass-half"></i> Loading... </div>';
			btn.disabled = true;
			dataPost = {itemidRow_hapus: itemidRow_hapus}
			$.ajax({
				url: '<?= base_url('inventory/purchasing/purchaseorder/hapusitempo') ?>',
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
